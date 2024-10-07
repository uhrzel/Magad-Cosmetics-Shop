function start_loader() {
  $("body").append(
    '<div id="preloader"><div class="loader-holder"><div></div><div></div><div></div><div></div>'
  );
}

function end_loader() {
  $("#preloader").fadeOut("fast", function () {
    $("#preloader").remove();
  });
}
// function
window.alert_toast = function ($msg = "TEST", $bg = "success", $pos = "") {
  var Toast = Swal.mixin({
    toast: true,
    position: $pos || "top-end",
    showConfirmButton: false,
    timer: 5000,
  });
  Toast.fire({
    icon: $bg,
    title: $msg,
  });
};

$(document).ready(function () {
  $("#login-frm-admin").submit(function (e) {
    e.preventDefault();
    start_loader();
    if ($(".err_msg").length > 0) $(".err_msg").remove();
    $.ajax({
      url: _base_url_ + "classes/Login.php?f=login_admin",
      method: "POST",
      data: $(this).serialize(),
      error: (err) => {
        console.log(err);
      },
      success: function (resp) {
        if (resp) {
          resp = JSON.parse(resp);
          if (resp.status == "success") {
            location.replace(_base_url_ + "admin");
          } else if (resp.status == "incorrect") {
            var _frm = $("#login-frm-admin");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Incorrect username or password</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="username"]').focus();
          } else if (resp.status == "incorrect_role") {
            var _frm = $("#login-frm-admin");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Access Denied! Admin Role</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="username"]').focus();
          }
          end_loader();
        }
      },
    });
  });

  $("#login-frm-superadmin").submit(function (e) {
    //superadmin
    e.preventDefault();
    start_loader();
    if ($(".err_msg").length > 0) $(".err_msg").remove();
    $.ajax({
      url: _base_url_ + "classes/Login.php?f=login_superadmin",
      method: "POST",
      data: $(this).serialize(),
      error: (err) => {
        console.log(err);
      },
      success: function (resp) {
        if (resp) {
          resp = JSON.parse(resp);
          if (resp.status == "success") {
            location.replace(_base_url_ + "superadmin");
          } else if (resp.status == "incorrect") {
            var _frm = $("#login-frm-superadmin");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Incorrect username or password</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="username"]').focus();
          } else if (resp.status == "incorrect_role") {
            var _frm = $("#login-frm-superadmin");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Access Denied! Superadmin Role</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="username"]').focus();
          }
          end_loader();
        }
      },
    });
  });
  // Login
  $("#login-frm-staff").submit(function (e) {
    e.preventDefault();
    start_loader();
    if ($(".err_msg").length > 0) $(".err_msg").remove();
    $.ajax({
      url: _base_url_ + "classes/Login.php?f=login_staff",
      method: "POST",
      data: $(this).serialize(),
      error: (err) => {
        console.log(err);
      },
      success: function (resp) {
        console.log(resp); // Log the raw response
        if (resp) {
          resp = JSON.parse(resp);
          console.log(resp); // Log the parsed response
          if (resp.status == "success") {
            location.replace(_base_url_ + "staff");
          } else if (resp.status == "incorrect") {
            var _frm = $("#login-frm-staff");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Incorrect username or password</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="username"]').focus();
          } else if (resp.status == "incorrect_role") {
            var _frm = $("#login-frm-staff");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Access Denied! Staff Role</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="username"]').focus();
          }
          end_loader();
        }
      },
    });
  });

  //Establishment Login
  $("#flogin-frm").submit(function (e) {
    e.preventDefault();
    start_loader();
    if ($(".err_msg").length > 0) $(".err_msg").remove();
    $.ajax({
      url: _base_url_ + "classes/Login.php?f=flogin",
      method: "POST",
      data: $(this).serialize(),
      error: (err) => {
        console.log(err);
      },
      success: function (resp) {
        if (resp) {
          resp = JSON.parse(resp);
          if (resp.status == "success") {
            location.replace(_base_url_ + "faculty");
          } else if (resp.status == "incorrect") {
            var _frm = $("#flogin-frm");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Incorrect username or password</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="username"]').focus();
          }
          end_loader();
        }
      },
    });
  });

  //user login
  $("#slogin-frm").submit(function (e) {
    e.preventDefault();
    start_loader();
    if ($(".err_msg").length > 0) $(".err_msg").remove();
    $.ajax({
      url: _base_url_ + "classes/Login.php?f=slogin",
      method: "POST",
      data: $(this).serialize(),
      error: (err) => {
        console.log(err);
      },
      success: function (resp) {
        if (resp) {
          resp = JSON.parse(resp);
          if (resp.status == "success") {
            location.replace(_base_url_ + "student");
          } else if (resp.status == "incorrect") {
            var _frm = $("#slogin-frm");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Incorrect username or password</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="username"]').focus();
          }
          end_loader();
        }
      },
    });
  });
  // System Info
  $("#system-frm").submit(function (e) {
    e.preventDefault();
    start_loader();
    if ($(".err_msg").length > 0) $(".err_msg").remove();
    $.ajax({
      url: _base_url_ + "classes/SystemSettings.php?f=update_settings",
      data: new FormData($(this)[0]),
      cache: false,
      contentType: false,
      processData: false,
      method: "POST",
      type: "POST",
      dataType: "json",
      success: function (resp) {
        if (resp.status == "success") {
          // alert_toast("Data successfully saved",'success')
          location.reload();
        } else if (resp.status == "failed" && !!resp.msg) {
          $("#msg").html(
            '<div class="alert alert-danger err_msg">' + resp.msg + "</div>"
          );
          $("html, body").animate({ scrollTop: 0 }, "fast");
        } else {
          $("#msg").html(
            '<div class="alert alert-danger err_msg">An Error occured</div>'
          );
        }
        end_loader();
      },
    });
  });
});
