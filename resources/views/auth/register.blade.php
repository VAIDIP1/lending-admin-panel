<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <!-- [Favicon] icon -->
  <link rel="icon" href="../assets/images/favicon.svg" type="image/x-icon"> <!-- [Google Font] Family -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="../assets/auth/fonts/tabler-icons.min.css" >
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="../assets/auth/fonts/feather.css" >
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="../assets/auth/fonts/fontawesome.css" >
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="../assets/auth/fonts/material.css" >
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="../assets/auth/css/style.css" id="main-style-link" >
  <link rel="stylesheet" href="../assets/auth/css/style-preset.css" >
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header">
          {{-- <a href="#"><img src="../assets/images/logo-dark.svg" alt="img"></a> --}}
        </div>
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-center align-items-center mb-4">
              <h3 class="mb-0"><b>Register</b></h3>
            </div>
            <form action="{{ route('register.post') }}" method="POST" class="js-validation-material" id="registration_form" enctype="multipart/form-data" autocomplete="off">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="form-label">First Name<span class="is_required"> *</span></label>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="form-label">Last Name<span class="is_required"> *</span></label>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Company<span class="is_required"> *</span></label>
                <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company">
                @error('company_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group mb-3">
                  <label class="form-label">Mobile Number<span class="is_required"> *</span></label>
                  <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Mobile Number" maxlength="10" pattern="\d{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                  @error('mobile_number')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Email Address<span class="is_required"> *</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="form-label">Password<span class="is_required"> *</span></label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="form-label">Confirm Password<span class="is_required"> *</span></label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                    @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="d-flex mt-1 justify-content-end login-details">
                  <h5 class="text-secondary f-w-400"><a href="{{ route('login') }}">Log in here</a></h5>
              </div>
              <p class="mt-4 text-sm text-muted">By Signing up, you agree to our <a href="#" class="text-primary"> Terms of Service </a> and <a href="#" class="text-primary"> Privacy Policy</a></p>
              <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary register-btn">Create Account</button>
              </div>
            </form>
          </div>
        </div>
        <div class="auth-footer row">
            <div class="col my-1">
              <p class="m-0">Copyright © <a href="#">Codedthemes</a></p>
            </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>

<!-- jQuery -->
<script src="{{ asset('assets/auth/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/auth/js/bootstrap.bundle.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('assets/auth/js/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.min.js"></script>

<script>

  $(document).ready(function () {

    $(document).on('input', '#company_name', function () {
    let start = this.selectionStart; // Store caret position
    let value = $(this).val().toLowerCase().replace(/\b\w/g, function (char) {
        return char.toUpperCase();
    });
    $(this).val(value);
    this.setSelectionRange(start, start); // Restore caret position
});
    
    jQuery("#registration_form").validate({
                  onfocusout: false,
                  onkeyup: false,
                  onclick: false,
                  errorElement: "span",
                  errorPlacement: function(error, element) {
                      error.addClass("invalid-feedback");
                      element.closest(".form-group, .input-group").append(error);
                  },
                  highlight: function(element, errorClass, validClass) {
                      $(element).addClass("is-invalid");
                  },
                  unhighlight: function(element, errorClass, validClass) {
                      $(element).removeClass("is-invalid");
                  },
                  invalidHandler: function(event, validator) {
                  },
                  rules: {
                      first_name: {
                          required: true
                      },
                      last_name: {
                          required: true
                      },
                      email: {
                          required: true,
                          email: true,
                      },
                      company_name: {
                          required: true
                      },
                      mobile_number: {
                          required: true,
                          minlength: 10,
                          maxlength: 10,
                          digits: true
                      },
                      password: {
                          required: true,
                          minlength: 9,
                      },
                      confirm_password: {
                          required: true,
                          minlength: 9,
                          equalTo: "#password"
                      },
                  },
                  messages: {
                      first_name: {
                          required: "Please enter a first name"
                      },
                      last_name: {
                          required: "Please enter a last name"
                      },
                      email: {
                          required: "Please enter an email address",
                          email: "Please enter a vaild email address"
                      },
                      company_name: {
                          required: "Please enter a company name"
                      },
                      mobile_number: {
                          required: "Please enter a contact number",
                          minlength: "Please enter a valid 10-digit phone number (no spaces or special characters)",
                          maxlength: "Your contact number must be no more than 10 characters long"
                      },
                      password: {
                          required: "Please provide a password",
                          minlength: "Your password must be at least 9 characters long"
                      },
                      confirm_password: {
                          required: "Please provide a confirm password",
                          minlength: "Your confirm password must be at least 9 characters long",
                          equalTo: "Your password and confirmation password do not match."
                      },
                  },
                  submitHandler: function(form, event) {
                      event.preventDefault();

                      var formData = new FormData(form);
                      // if($('#profile_photo')[0].files.length > 0){
                      //     formData.append('profile_photo', $('#profile_photo')[0].files[0]);
                      // }
                      formData.append('_token', "{{csrf_token()}}");

                      $.ajax({
                          url: form.action,
                          type: form.method,
                          beforeSend: function() {
                              $("body").addClass("loading");
                          },
                          processData: false,
                          contentType: false,
                          data: formData,
                          success: function(response) {
                              $("body").removeClass("loading");
                              Swal.fire({
                                  ...swalSuccessMixin,
                                  title: 'Great! You have successfully registered. Please verify your email and mobile number.',
                              }).then(function(t) {
                                  if (response.redirect_url) {
                                      window.location.href = response.redirect_url;
                                  }
                              });
                          },
                          error: function(response) {
                              $("body").removeClass("loading");
                              let errorMessage = "Something went wrong. Please try again.";

                              if(response.responseJSON.message){
                                  Swal.fire({
                                      ...swalErrorMixin,
                                      title: 'Error',
                                      text: response.responseJSON.message,
                                  });
                              } else {
                                  Swal.fire({
                                      ...swalErrorMixin,
                                      title: 'Error',
                                      text: response.message,
                                  });
                              }
                          }
                      });
                  }
              });

      $(document).on("keyup focusout", "#email", function() {
          var email = $(this).val();
          $('.email_validation_message').html('');
          $('.button-register').attr("disabled", "disabled");

          if (email == '' || email == undefined) {
              $('.email_validation_message').html('');
          }

          $.ajax({
              type: 'GET',
              url: '{{ route("validate-email") }}',
              invalidHandler: function(event, validator) {
              },
              data: {
                  email: email,
                  role: '{{ base64_encode(5) }}',
                  _token: '{{ csrf_token() }}'
              },
              success: function(data) {
                  if (data.success == false) {
                      $('.button-register').attr("disabled", "disabled");
                      $('.email_validation_message').html(data.message);
                      $('#email').addClass('is-invalid');
                  } else {
                      $('.email_validation_message').html();
                      $('.button-register').attr("disabled", false);
                      $('#email').removeClass('is-invalid');
                  }
              }
          });
      });
  });
</script>