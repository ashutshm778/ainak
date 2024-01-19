@extends('frontend.layouts.app')
@section('content')

<style>
@media only screen and (max-width: 767px){
.ec-register-wrapper .ec-register-container .ec-register-form .btn {
    font-size: 14px;
    width: auto;
    margin-top: 0px;
    height: 42px;
    min-width: unset;
}
}
.input-group > :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
    margin-left: -1px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.ec-register-wrapper .ec-register-container .ec-register-form .btn {
    margin-top: 0;
    height:50px;
}
.invalid-feedback {
    color:red;
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

    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            {{-- <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Register</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Register</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="image-contain">
                        <img src="{{asset('public/frontend/assets/images/reset-password.jpg')}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="ec-register-wrapper col-md-7">
                    <div class="ec-register-container">
                        <div class="ec-register-form">
                            <form id="valid_form" action="{{ route('customer.forgotpassword') }}" method="POST" autocomplete="off" >
                                @csrf
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
                                        <span class="error invalid-feedback" id="phone_error" style="display:none;color:red;">Phone
                                            Number Not Exists</span>
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </span>
                                    <p style="text-align:center;display:none;" id="edit_number"><a href="#" onclick="reset_number()"><span class="badge badge-success">Edit</span></a></p>
                                </div>
                                <span class="ec-register-wrap ec-register-half" id="otp_div" style="display: none;">
                                    <label>OTP<span style="color:red">*<span></label> <br>
                                    <input type="number" class="form-control" id="otp" name="otp"
                                        value="{{ old('otp') }}" onchange="verifyOtp()" placeholder="Enter Your OTP..."
                                        required  style="margin-bottom:5px;">
                                        <p id="otp_countdown" style="text-align:center">Resend OTP in <span class="js-timeout">2:00</span></p>
                                        <p id="re_send_otp_button"  style="display:none;text-align:center;"> <a href="javascript:void(0)"
                                            onclick="getOtp()"><span class="badge badge-success">Resend OTP</span></a>  </p>
                                    <span class="error invalid-feedback" id="otp_error" style="display:none;color:red;">Wrong
                                        OTP</span>
                                    <span class="text-success" id="otp_success" style="display:none">Match OTP</span>
                                    @if ($errors->has('otp'))
                                        <span class="text-danger">{{ $errors->first('otp') }}</span>
                                    @endif
                                </span>

                                <span class="ec-register-wrap ec-register-half">
                                    <label>New Password<span style="color:red">*<span></label> <br>
                                    <div class="input-group" id="show_hide_password">
                                    <input type="password" id="pasword" class="form-control" minlength="6" name="password"
                                        placeholder="Enter your new password..." required />
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
                                    <label>Confirm New Password<span style="color:red">*<span></label> <br>
                                    <div class="input-group" id="confirm_show_hide_password">
                                    <input type="password" id="confirm_password" class="form-control"
                                        name="confirm_password" minlength="6" placeholder="Confirm your new password..." required />
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                    </div>
                                    <span class="text-danger error" id="confirm_password_error" style="display:none;color:red;">Your
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
                                <span class="ec-register-wrap ec-register-btn">
                                    <button class="btn btn-primary" type="button" onclick="verifyOtp()">Submit</button>
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
        $('#edit_number').hide();
        clearInterval(interval);
    } 

    function getOtp() {

        var phone = $('#phone').val();
        var otp = $('#otp').val('');

        if (phone.length == 10) {
            $.get("{{ route('send.forgot_otp', '') }}" + "/" + phone, function(data) {
                if (data != 1) {
                    $('#phone').addClass('is-invalid');
                    $('#phone').removeClass('is-valid');
                    $('#phone_error').css('display', 'block');
                } else {
                    $('#phone').removeClass('is-invalid');
                    $('#phone').addClass('is-valid');
                    $('#phone_error').css('display', 'none');
                    $('#otp_div').show();
                    $('#edit_number').show();
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
