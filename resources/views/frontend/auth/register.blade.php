@extends('frontend.layouts.app')
@section('content')
    <style>
        @media only screen and (max-width: 575px) {
            .ec-register-wrapper .ec-register-container .ec-register-form .btn {
                height: 42px !important;
            }
        }

        .error {
            color: red !important;
            margin-top: -12px;
        }

        .ec-register-wrapper .ec-register-container .ec-register-form .btn {
            margin-top: 0;
            height: 50px;
        }

        .form-control.is-valid,
        .was-validated .form-control:valid {
            border-color: #198754 !important;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e);
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        .input-group-text {
    padding: 16px 15px;
    background-color: #E9ECEF;
    border: 1px solid #ededed;
    border-radius: 0px;
}

@media only screen and (max-width: 575px) {
    .input-group-text { padding: 12px 15px!important; }
}
    </style>

    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb"></div>
    <div class="breadcrumb">
    <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row ec_breadcrumb_inner">
                            <div class="col-md-6 col-sm-12">
                                <ul class="ec-breadcrumb-list">
                                    <li class="ec-breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                    <li class="ec-breadcrumb-item active">Register</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="image-contain">
                        <img src="{{ asset('public/frontend/assets/images/login.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="ec-register-wrapper col-md-7">
                    <div class="ec-register-container">
                        <div class="ec-register-form">
                            <form id="valid_form" action="{{ route('customer.register') }}" method="post">
                                @csrf
                                <span class="ec-register-wrap ec-register-half">
                                    <label>First Name<span style="color:red">*<span></label> <br>
                                    <input type="text" class="form-control" name="first_name"
                                        value="{{ old('first_name') }}" placeholder="Enter your First Name..." required />
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </span>

                                <span class="ec-register-wrap ec-register-half">
                                    <label>Last Name<span style="color:red">*<span></label> <br>
                                    <input type="text" class="form-control" name="last_name"
                                        value="{{ old('last_name') }}" placeholder="Enter Your Last Name..." required />
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </span>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Password<span style="color:red">*<span></label> <br>
                                    <div class="input-group" id="show_hide_password">
                                    <input type="password" id="pasword" minlength="6" class="form-control" name="password"
                                        placeholder="Enter Your Password..." required />
                                        <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </span>

                                <span class="ec-register-wrap ec-register-half">
                                    <label>Confirm Password<span style="color:red">*<span></label> <br>
                                    <div class="input-group" id="confirm_show_hide_password">
                                    <input type="password" id="confirm_password" minlength="6" class="form-control"
                                        name="confirm_password" placeholder="Enter Your Confirm Password..." required />
                                        <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                    </div>
                                    <span class="text-danger error" id="confirm_password_error" style="display:none">Your
                                        Password Does Not Match</span>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </span>
                                <script>
                                    $(document).ready(function() {
                                        $("#show_hide_password a").on('click', function(event) {
                                            event.preventDefault();
                                            if ($('#show_hide_password input').attr("type") == "text") {
                                                $('#show_hide_password input').attr('type', 'password');
                                                $('#show_hide_password i').addClass("fa-eye-slash");
                                                $('#show_hide_password i').removeClass("fa-eye");
                                            } else if ($('#show_hide_password input').attr("type") == "password") {
                                                $('#show_hide_password input').attr('type', 'text');
                                                $('#show_hide_password i').removeClass("fa-eye-slash");
                                                $('#show_hide_password i').addClass("fa-eye");
                                            }
                                        });
                                    });
                                    $(document).ready(function() {
                                        $("#confirm_show_hide_password a").on('click', function(event) {
                                            event.preventDefault();
                                            if ($('#confirm_show_hide_password input').attr("type") == "text") {
                                                $('#confirm_show_hide_password input').attr('type', 'password');
                                                $('#confirm_show_hide_password i').addClass("fa-eye-slash");
                                                $('#confirm_show_hide_password i').removeClass("fa-eye");
                                            } else if ($('#confirm_show_hide_password input').attr("type") == "password") {
                                                $('#confirm_show_hide_password input').attr('type', 'text');
                                                $('#confirm_show_hide_password i').removeClass("fa-eye-slash");
                                                $('#confirm_show_hide_password i').addClass("fa-eye");
                                            }
                                        });
                                    });
                                </script>
                                <div class="ec-register-wrap ec-register-half">
                                    <label>Phone Number<span style="color:red">*<span></label>
                                    <span class="input-group">
                                        <input type="number" class="form-control mb-2" id="phone" name="phone"
                                            value="{{ old('phone') }}"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            onKeyPress="if(this.value.length==10) return false;" minlength="10"
                                            placeholder="Enter Your Phone No..." required>
                                        <button class="btn btn-primary" type="button" id="button_addon2"
                                            style="text-transform: capitalize;" onclick="getOtp()">Send OTP</button>
                                        <span class="error invalid-feedback" id="phone_error" style="display:none">Phone
                                            Number Already Exists</span>
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </span>
                                    <p style="text-align:center"><a href="#" onclick="reset_number()"><span class="badge badge-success">Edit</span></a></p>
                                </div>

                                <span class="ec-register-wrap ec-register-half" id="otp_div" style="display: none;">
                                    <label>OTP<span style="color:red">*<span></label> <br>
                                    <input type="number" class="form-control" id="otp" name="otp"
                                        value="{{ old('otp') }}" onchange="verifyOtp()" placeholder="Enter Your OTP..."
                                        required / style="margin-bottom:5px;">
                                        <p id="otp_countdown" style="text-align:center">Resend OTP in <span class="js-timeout">2:00</span></p>
                                        <p id="re_send_otp_button"  style="display:none;text-align:center;"> <a href="javascript:void(0)"
                                            onclick="getOtp()"><span class="badge badge-success">Resend OTP</span></a>  </p>
                                    <span class="error invalid-feedback" id="otp_error" style="display:none">Wrong
                                        OTP</span>
                                    <span class="text-success" id="otp_success" style="display:none">Match OTP</span>
                                    @if ($errors->has('otp'))
                                        <span class="text-danger">{{ $errors->first('otp') }}</span>
                                    @endif

                                </span>


                                <span class="ec-register-wrap ec-register-btn">
                                    <button class="btn btn-primary" type="button" onclick="verifyOtp()">Register</button>
                                    <div class="text-center">
                                        <p class="mt-2">Already have an account? <a href="{{ route('user.login') }}"
                                                style="color: #ff5a47;"> Login</a></p>
                                    </div>
                                </span>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


<script>
    var interval;

    function countdown() {
        clearInterval(interval);
        interval = setInterval(function() {
            var timer = $('.js-timeout').html();
            timer = timer.split(':');
            var minutes = timer[0];
            var seconds = timer[1];
            seconds -= 1;
            if (minutes < 0) return;
            else if (seconds < 0 && minutes != 0) {
                minutes -= 1;
                seconds = 59;
            } else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;

            $('.js-timeout').html(minutes + ':' + seconds);

            if (minutes == 0 && seconds == 0) {
                clearInterval(interval);
                $('#re_send_otp_button').show();
                $('#otp_countdown').hide();
            }
        }, 1000);
    }

    $('#js-startTimer').click(function() {
        $('.js-timeout').text("2:00");
        countdown();
    });

    $('#js-resetTimer').click(function() {
        $('.js-timeout').text("2:00");
        clearInterval(interval);
    });
</script>

<script>

    function reset_number(){
        $('#phone').val('');
        $('#phone').attr('readonly', false);
        $('#button_addon2').attr('disabled', false);
        $('#otp_div').hide();
        clearInterval(interval);
    }

    function getOtp() {

        var phone = $('#phone').val();
        var otp = $('#otp').val('');

        if (phone.length == 10) {
            $.get("{{ route('send.otp', '') }}" + "/" + phone, function(data) {
                if (data != 1) {
                    $('#phone').addClass('is-invalid');
                    $('#phone').removeClass('is-valid');
                    $('#phone_error').css('display', 'block');
                } else {
                    $('#phone').removeClass('is-invalid');
                    $('#phone').addClass('is-valid');
                    $('#phone_error').css('display', 'none');
                    $('#otp_div').show();
                    $('#button_addon2').attr('disabled', 'disabled');
                    $('#phone').attr('readonly', 'true');
                    $('#otp_countdown').show();
                    $('#re_send_otp_button').hide();
                    $('.js-timeout').text("0:60");
                    countdown();
                }
            });
        }
    }

    function verifyOtp() {
        var validation = $("#valid_form").valid();
        if (validation) {
            var password = $('#pasword').val();
            var confirm_password = $('#confirm_password').val();
            if (password != confirm_password) {
                $('#confirm_password').addClass('is-invalid');
                $('#confirm_password').removeClass('is-valid');
                $('#confirm_password_error').css('display', 'block')
                $('#confirm_password_error').text('Your Password Does Not Match')
                return false;
            }
            $('#confirm_password').removeClass('is-invalid');
            $('#confirm_password').addClass('is-valid');
            $('#confirm_password_error').text('Your Password Matched')
            $('#confirm_password_error').css('display', 'none')
            var phone = $('#phone').val();
            var otp = $('#otp').val();
            $.get("{{ route('verify.otp', ['', '']) }}" + "/" + phone + "/" + otp, function(data) {
                $('#otp').removeClass('is-invalid');
                $('#otp').addClass('is-valid');
                $('#otp_success').css('display', 'block');
                $('#otp_success').text('Match OTP');
                $('#otp_error').css('display', 'none');
                $('#valid_form').submit();
            }).fail(function() {
                $('#otp').addClass('is-invalid');
                $('#otp').removeClass('is-valid');
                $('#otp_success').css('display', 'none');
                $('#otp_error').css('display', 'block');
                $('#otp_error').text('Wrong OTP');
            });
        } else {
            return false;
        }

    }
</script>
