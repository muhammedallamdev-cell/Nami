<!doctype html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Login</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    
    body { 
      background: linear-gradient(180deg,#f8fafc 0%, #eef2f6 100%);
       min-height: 100vh; 
      }
    .card-login {
       max-width: 480px;
       margin: 6vh auto;
        border-radius: 12px;
       }
    .brand {
       font-weight: 700;
        letter-spacing: 0.2px; 
      }
    .form-control:focus {
       box-shadow: none;
    }
  </style>
</head>
<body>
  <main class="container">
    <div class="card card-login shadow-sm p-0">
      <div class="row g-0">
        <div class="col-12 p-4">
          <div class="d-flex align-items-center mb-3">
            <div class="me-3 display-6 text-primary"><i class="bi bi-gear-fill"></i></div>
            <div>
              <div class="brand h5 mb-0">Nami Soft</div>
              <small class="text-muted">Project Management — Admin</small>
            </div>
          </div>

          <h5 class="mb-3">Admin Login</h5>

          <!-- Alert placeholder -->
          <div id="alertPlaceholder" class="mb-3"></div>

          <form id="loginForm" novalidate>
            <div class="mb-3">
              <label for="email" class="form-label small">Email address</label>
              <input id="email" name="email" type="email" required class="form-control" placeholder="name@example.com" aria-describedby="emailHelp">
              <div class="invalid-feedback" id="emailError">Please enter a valid email.</div>
            </div>

            <div class="mb-3 position-relative">
              <label for="password" class="form-label small">Password</label>
              <div class="input-group">
                <input id="password" name="password" type="password" required class="form-control" placeholder="Your password" aria-describedby="passwordToggle">
                <button class="btn btn-outline-secondary" type="button" id="passwordToggle" aria-label="Toggle password">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              <div class="invalid-feedback" id="passwordError">Password is required.</div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="remember">
                <label class="form-check-label small" for="remember">Remember me</label>
              </div>
              <a href="#" class="small">Forgot password?</a>
            </div>

            <div class="d-grid">
              <button id="loginBtn" class="btn btn-primary btn-lg" type="submit">
                <span id="btnText">Login</span>
                <span id="btnSpinner" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true" style="display:none"></span>
              </button>
            </div>
          </form>

          <div class="text-center mt-3 small text-muted">© <span id="year"></span> Nami Soft</div>
        </div>
      </div>
    </div>
  </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
  document.getElementById('year').textContent = new Date().getFullYear();

  $(function(){
    $('#passwordToggle').on('click', function(){
      const input = $('#password');
      const icon = $(this).find('i');
      if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        icon.removeClass('bi-eye').addClass('bi-eye-slash');
      } else {
        input.attr('type', 'password');
        icon.removeClass('bi-eye-slash').addClass('bi-eye');
      }
    });

    $('#loginForm').on('submit', function(e){
      e.preventDefault();

      $('#email').removeClass('is-invalid');
      $('#password').removeClass('is-invalid');
      $('#alertPlaceholder').html('');

      $('#btnText').hide();
      $('#btnSpinner').show();
      $('#loginBtn').prop('disabled', true);

      $.ajax({
        url: "{{ route('admin.auth.login') }}",
        type: "POST",
        dataType: 'json',
        data: {
          _token: "{{ csrf_token() }}",
          email: $('#email').val(),
          password: $('#password').val()
        },
        success: function(resp) {
          if (resp.status === true && resp.data && resp.data.length) {
            const token = resp.data[0].token;

            // set token via another ajax request
            $.ajax({
              url: "{{ route('admin.auth.setToken') }}",
              type: "POST",
              dataType: 'json',
              data: {
                _token: "{{ csrf_token() }}",
                token: token
              },
              success: function(setRes) {
                if (setRes.status === true) {
                  // redirect to dashboard
                  window.location.href = "{{ route('admin.dashboard') }}";
                } else {
                  $('#alertPlaceholder').html(`<div class="alert alert-danger">${setRes.message || 'Failed to set token'}</div>`);
                  $('#btnText').show();
                  $('#btnSpinner').hide();
                  $('#loginBtn').prop('disabled', false);
                }
              },
              error: function(xhr) {
                let msg = 'Failed to set token';
                if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                $('#alertPlaceholder').html(`<div class="alert alert-danger">${msg}</div>`);
                $('#btnText').show();
                $('#btnSpinner').hide();
                $('#loginBtn').prop('disabled', false);
              }
            });

          } else {
            $('#alertPlaceholder').html(`<div class="alert alert-danger">${resp.message || 'Login failed'}</div>`);
            $('#btnText').show();
            $('#btnSpinner').hide();
            $('#loginBtn').prop('disabled', false);
          }
        },
        error: function(xhr) {
          if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
            const errors = xhr.responseJSON.errors;
            if (errors.email) {
              $('#email').addClass('is-invalid');
              $('#emailError').text(errors.email[0]);
            }
            if (errors.password) {
              $('#password').addClass('is-invalid');
              $('#passwordError').text(errors.password[0]);
            }
          } else {
            let msg = 'Login failed';
            if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
            $('#alertPlaceholder').html(`<div class="alert alert-danger">${msg}</div>`);
          }
          $('#btnText').show();
          $('#btnSpinner').hide();
          $('#loginBtn').prop('disabled', false);
        }
      });

    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
