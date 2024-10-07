<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<body class="hold-transition login-page">
  <script>
    function start_loader() {
      // Your loader start code here
    }

    function end_loader() {
      // Your loader end code here
    }

    start_loader();
  </script>
  <style>
    body {
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size: cover;
      background-repeat: no-repeat;
      backdrop-filter: contrast(1);
    }

    #page-title {
      text-shadow: 6px 4px 7px black;
      font-size: 3.5em;
      color: #fff4f4 !important;
      background: #8080801c;
    }

    .custom-alert {
      width: 300px;
      /* Set your desired width */
      padding: 20px;
      /* Add some padding */
      border-radius: 10px;
      /* Optional: round the corners */
    }

    .custom-alert h2 {
      font-size: 18px;
      /* Adjust the title font size */
    }

    .custom-alert p {
      font-size: 14px;
      /* Adjust the text font size */
    }
  </style>
  <h1 class="text-center text-white px-4 py-5" id="page-title"><b><?php echo $_settings->info('name') ?></b></h1>
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-primary my-2">
      <div class="card-body">
        <p class="login-box-msg">Staff - Login</p>
        <form id="login-frm-staff" action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" autofocus placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <a href="#" id="signup-link">Sign Up</a>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!-- /.social-auth-links -->

        <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- Sign Up Modal -->
  <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="signup-frm" action="" method="post">
            <!-- Staff Details -->
            <div class="form-group">
              <label for="staff-firstname">Staff Firstname</label>
              <input type="text" class="form-control" id="staff-firstname" name="firstname" placeholder="Enter your firstname">
            </div>
            <div class="form-group">
              <label for="staff-lastname">Staff Lastname</label>
              <input type="text" class="form-control" id="staff-lastname" name="lastname" placeholder="Enter your lastname">
            </div>
            <div class="form-group">
              <label for="staff-username">Staff Username</label>
              <input type="text" class="form-control" id="staff-username" name="username" placeholder="Enter your username">
            </div>
            <div class="form-group">
              <label for="staff-password">Staff Password</label>
              <input type="password" class="form-control" id="staff-password" name="password" placeholder="Enter your password">
            </div>


            <div class="form-group">
              <label for="email-address">Email Address</label>
              <input type="email" class="form-control" id="email-address" name="email_address" placeholder="Enter your email address">
            </div>
            <div class="form-group">
              <label for="mobile-number">Mobile Number</label>
              <input type="text" class="form-control" id="mobile-number" name="mobile_number" placeholder="Enter your mobile number">
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <!-- Include SweetAlert2 Library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script>
    $(document).ready(function() {
      end_loader();

      // jQuery for showing the modal
      $('#signup-link').on('click', function(e) {
        e.preventDefault(); // Prevent default link behavior
        $('#signupModal').modal('show'); // Show the modal
      });

      $('#signup-frm').submit(function(e) {
        e.preventDefault();
        start_loader();

        if ($('.err-msg').length > 0)
          $('.err-msg').remove();

        $.ajax({
          url: _base_url_ + "classes/Master.php?f=staff_register",
          method: "POST",
          data: $(this).serialize(),
          dataType: "json",
          error: err => {
            console.log(err);
            alert_toast("An error occurred", 'error');
            end_loader();
          },
          success: function(resp) {
            end_loader(); // End loader here to ensure it's called in all cases

            if (typeof resp === 'object' && resp.status === 'success') {
              Swal.fire({
                icon: 'success',
                title: 'Registration Successful',
                text: resp.msg,
                customClass: {
                  popup: 'custom-alert' // Add a custom class
                },
              }).then(() => {
                location.reload(); // Reload the page after closing the alert
              });
            } else if (resp.status === 'failed' && !!resp.msg) {
              var _err_el = $('<div>')
                .addClass("alert alert-danger err-msg")
                .text(resp.msg);
              $('[name="password"]').after(_err_el);
            } else {
              console.log(resp);
              alert_toast("An error occurred", 'error');
            }
          }
        });
      });
    });
  </script>
</body>

</html>