<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url() ?>assets/img/favicon.ico" type="image/x-icon">
        <title>Login</title>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/login.css">
    </head>
    <body>
        <div class="container">
            <div class="text-center">
                <img src="<?php echo base_url() ?>assets/img/ppl.png" alt="Metis Logo">
            </div>
            <div class="tab-content">
                <div id="login" class="tab-pane active">
                    <form id="loginform" action="<?php echo site_url("_login"); ?>" class="form-signin">
                        <p class="text-center">
                            Masukkan username dan password
                        </p>
                        <input id="usr_admin" name="usr_admin" type="text" placeholder="Username" class="input-block-level username-field">
                        <input id="pwd_admin" name="pwd_admin" type="password" placeholder="Password" class="input-block-level password-field">
						<div class="loading_ajax" style="display: none;">&nbsp;</div>
						<div id="alert_login" class="alert alert-danger" style="display: none;"></div>
                        <button id="btnLogin" name="btnLogin" class="btn btn-large btn-primary btn-block" type="button">Sign in</button>
                    </form>
                </div>
            </div>
        </div> <!-- /container -->

        <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/vendor/bootstrap.min.js"></script>
		<script src="<?php echo base_url() ?>assets/js/login.js"></script>

        <script>
            $('.inline li > a').click(function() {
                var activeForm = $(this).attr('href') + ' > form';
                //console.log(activeForm);
                $(activeForm).addClass('magictime swap');
                //set timer to 1 seconds, after that, unload the magic animation
                setTimeout(function() {
                    $(activeForm).removeClass('magictime swap');
                }, 1000);
            });

        </script>
    </body>
</html>