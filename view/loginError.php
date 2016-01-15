<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Go get rich Admin Panel - Login Page</title>

        <!-- Bootstrap framework -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assetsbootstrap/css/bootstrap-responsive.min.css" />
        <!-- theme color-->
        <link rel="stylesheet" href="assets/css/blue.css" />
        <!-- tooltip -->    
        <link rel="stylesheet" href="assets/lib/qtip2/jquery.qtip.min.css" />
        <!-- main styles -->
        <link rel="stylesheet" href="assets/css/style.css" />

        <!-- Favicons and the like (avoid using transparent .png) -->
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="apple-touch-icon-precomposed" href="icon.png" />

        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>

        <!--[if lte IE 8]>
            <script src="js/ie/html5.js"></script>
                        <script src="js/ie/respond.min.js"></script>
        <![endif]-->

        <!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>
    <body class="login_page">

        <div class="login_box">

            <form action="../model/com.gogetrich.function/LoginSubmit.php" method="post" id="login_form">
                <div class="top_b">Sign in to Go get rich Admin</div>    
                <div class="alert alert-danger alert-login">
                    <?php
                    switch ($_GET['rc']) {
                        case md5(401):
                            echo 'Invalid username or password, Please try again or contact administrator';
                            break;
                        case md5(503):
                            echo 'Service unavailable, Please try again or contact administrator';
                            break;
                        case md5(409):
                            unset($_SESSION['expire']);
                            unset($_SESSION['token']);
                            echo 'The session has been time out, Please re-login again';
                            break;
                        default:
                            echo 'Unknown error,Please try again or contact administrator';
                    }
                    ?>
                </div>
                <div class="cnt_b">
                    <div class="formRow">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" id="username" name="username" placeholder="Username" />
                        </div>
                    </div>
                    <div class="formRow">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" id="password" name="password" placeholder="Password" />
                        </div>
                    </div>
                    <div class="formRow clearfix">
                        <label class="checkbox"><input type="checkbox" /> Remember me</label>
                    </div>
                </div>
                <div class="btm_b clearfix">
                    <button class="btn btn-inverse pull-right" type="submit">Sign In</button>
                </div>  
            </form>

            <form action="dashboard.html" method="post" id="pass_form" style="display:none">
                <div class="top_b">Can't sign in?</div>    
                <div class="alert alert-info alert-login">
                    Please enter your email address. You will receive a link to create a new password via email.
                </div>
                <div class="cnt_b">
                    <div class="formRow clearfix">
                        <div class="input-prepend">
                            <span class="add-on">@</span><input type="text" placeholder="Your email address" />
                        </div>
                    </div>
                </div>
                <div class="btm_b tac">
                    <button class="btn btn-inverse" type="submit">Request New Password</button>
                </div>  
            </form>            

        </div>

        <div class="links_b links_btm clearfix">
            <span class="linkform"><a href="#pass_form">Forgot password?</a></span>
            <span class="linkform" style="display:none">Never mind, <a href="#login_form">send me back to the sign-in screen</a></span>
        </div>  

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.actual.min.js"></script>
        <script src="assets/lib/validation/jquery.validate.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {

                //* boxes animation
                form_wrapper = $('.login_box');
                $('.linkform a,.link_reg a').on('click', function (e) {
                    var target = $(this).attr('href'),
                            target_height = $(target).actual('height');
                    $(form_wrapper).css({
                        'height': form_wrapper.height()
                    });
                    $(form_wrapper.find('form:visible')).fadeOut(400, function () {
                        form_wrapper.stop().animate({
                            height: target_height
                        }, 500, function () {
                            $(target).fadeIn(400);
                            $('.links_btm .linkform').toggle();
                            $(form_wrapper).css({
                                'height': ''
                            });
                        });
                    });
                    e.preventDefault();
                });

                //* validation
                $('#login_form').validate({
                    onkeyup: false,
                    errorClass: 'error',
                    validClass: 'valid',
                    rules: {
                        username: {required: true, minlength: 3},
                        password: {required: true, minlength: 3}
                    },
                    highlight: function (element) {
                        $(element).closest('div').addClass("f_error");
                    },
                    unhighlight: function (element) {
                        $(element).closest('div').removeClass("f_error");
                    },
                    errorPlacement: function (error, element) {
                        $(element).closest('div').append(error);
                    }
                });
            });
        </script>
    </body>
</html>
