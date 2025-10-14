
  <!-- jQuery (required for the AJAX below) -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    (function(){
      // elements
      const tableSelect = document.getElementById('tableSelect');
      const applyBtn = document.getElementById('applyBtn');
      const resetBtn = document.getElementById('resetBtn');
      const tablesContainer = $('#tablesContainer');

      // CSRF token
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // helper: show loading spinner
      function showLoading() {
        tablesContainer.html('<div class="p-4 text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
      }

      // helper: render fallback JSON -> simple table
      function renderFallback(data) {
        if (!data || !data.rows || data.rows.length === 0) {
          tablesContainer.html('<div class="alert alert-info">No data found.</div>');
          return;
        }

        const rows = data.rows;
        const keys = Object.keys(rows[0]);

        let html = '<div class="table-card active">';
        html += '<div class="card-header"><i class="bi bi-table"></i> ' + (data.table || 'Table') + '</div>';
        html += '<div class="table-responsive p-3"><table class="table table-striped mb-0"><thead><tr>';
        keys.forEach(k => { html += `<th>${k}</th>`; });
        html += '</tr></thead><tbody>';
        rows.forEach(r => {
          html += '<tr>';
          keys.forEach(k => {
            html += `<td>${r[k] ?? ''}</td>`;
          });
          html += '</tr>';
        });
        html += '</tbody></table></div></div>';

        tablesContainer.html(html);
      }

      // Apply button - AJAX request to fetch table partial
      $(applyBtn).on('click', function(e) {
        e.preventDefault();
        const key = tableSelect.value;

        // if empty -> show no data
        if (!key) {
          $('#noData').show();
          return;
        }

        // show spinner
        showLoading();

        $.ajax({
          url: "{{ route('admin.tables.fetch') }}",
          method: 'POST',
          dataType: 'json',
          data: { table_key: key },
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          xhrFields: {
            withCredentials: true // ensure cookies sent (if required)
          },
          success: function(res) {
            // expected: { html: '...' } or { data: ... } or { rows: [...] }
            if (res.html) {
              tablesContainer.html(res.html);
            } else if (res.data) {
              // if service returns ['table'=>..., 'rows'=>...]
              renderFallback(res.data);
            } else if (res.rows || res.length) {
              // maybe returns array directly
              renderFallback({ table: key, rows: res.rows || res });
            } else {
              tablesContainer.html('<div class="alert alert-warning">No content returned.</div>');
            }
          },
          error: function(xhr) {
            console.error(xhr);
            let msg = 'Error fetching data';
            if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
            tablesContainer.html(`<div class="alert alert-danger">${msg}</div>`);
          }
        });
      });

      // Reset button
      $(resetBtn).on('click', function(e) {
        e.preventDefault();
        tableSelect.value = '';
        tablesContainer.html('');
        $('#noData').show();
      });

      $(document).ready(function() {
        $('#noData').hide(); // hide default noData, content will be empty until user clicks
      });

    })();
  </script>
</body>
</html>
