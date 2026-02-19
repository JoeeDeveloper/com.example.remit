import flatpickr from 'flatpickr';

document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('remit-table-container');
  if (!container) return;

  const searchInput = document.getElementById('search');
  const assetSelect = document.getElementById('asset');
  const statusSelect = document.getElementById('status');
  const startFromInput = document.getElementById('start_from');
  const endBeforeInput = document.getElementById('end_before');
  const perPageSelect = document.getElementById('per_page');
  const baseUrl = container.dataset.url;

  const flatpickrOpts = {
    dateFormat: 'Y-m-d',
    allowInput: false,
    onChange: () => applyFilters(),
  };

  let startFromFp = startFromInput ? flatpickr(startFromInput, flatpickrOpts) : null;
  let endBeforeFp = endBeforeInput ? flatpickr(endBeforeInput, flatpickrOpts) : null;

  function getFilterParams(overrides = {}) {
    const params = new URLSearchParams(window.location.search);
    params.delete('page');
    if (searchInput?.value) params.set('search', searchInput.value);
    else params.delete('search');
    if (assetSelect?.value) params.set('asset', assetSelect.value);
    else params.delete('asset');
    if (statusSelect?.value) params.set('status', statusSelect.value);
    else params.delete('status');
    if (startFromInput?.value) params.set('start_from', startFromInput.value);
    else params.delete('start_from');
    if (endBeforeInput?.value) params.set('end_before', endBeforeInput.value);
    else params.delete('end_before');
    if (perPageSelect?.value) params.set('per_page', perPageSelect.value);
    else params.delete('per_page');
    Object.entries(overrides).forEach(([k, v]) => { if (v) params.set(k, v); else params.delete(k); });
    return params.toString();
  }

  function fetchTable(url) {
    const content = container.querySelector('#remit-table-content');
    if (!content) return;

    content.style.opacity = '0.5';
    content.style.pointerEvents = 'none';

    fetch(url, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
    })
      .then((res) => {
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        return res.text();
      })
      .then((html) => {
        content.outerHTML = html;
        history.replaceState({}, '', url);
      })
      .catch(() => {
        const c = container.querySelector('#remit-table-content');
        if (c) {
          c.style.opacity = '1';
          c.style.pointerEvents = '';
        }
      })
      .finally(() => {
        const newContent = container.querySelector('#remit-table-content');
        if (newContent) {
          newContent.style.opacity = '1';
          newContent.style.pointerEvents = '';
        }
      });
  }

  function applyFilters() {
    const params = getFilterParams({ page: '1' });
    const url = params ? `${baseUrl}?${params}` : baseUrl;
    fetchTable(url);
  }

  let searchDebounce;
  searchInput?.addEventListener('input', () => {
    clearTimeout(searchDebounce);
    searchDebounce = setTimeout(applyFilters, 300);
  });

  assetSelect?.addEventListener('change', applyFilters);
  statusSelect?.addEventListener('change', applyFilters);
  perPageSelect?.addEventListener('change', applyFilters);

  const resetFilters = (e) => {
    e.preventDefault();
    e.stopPropagation();
    if (startFromFp) {
      startFromFp.close();
      startFromFp.clear();
    }
    if (endBeforeFp) {
      endBeforeFp.close();
      endBeforeFp.clear();
    }
    if (searchInput) searchInput.value = '';
    if (assetSelect) assetSelect.value = '';
    if (statusSelect) statusSelect.value = '';
    if (perPageSelect) perPageSelect.value = '20';
    fetchTable(baseUrl);
  };

  const resetBtn = document.getElementById('reset-filters');
  if (resetBtn) {
    resetBtn.addEventListener('click', resetFilters);
  }

  container.addEventListener('click', (e) => {
    const link = e.target.closest('a[href]');
    if (!link) return;
    if (link.target === '_blank') return;
    if (!link.href.startsWith(window.location.origin)) return;

    e.preventDefault();
    fetchTable(link.href);
  });
});
