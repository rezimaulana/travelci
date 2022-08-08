<!DOCTYPE html>
<html lang="en">

<head>
    <!-- URL Theme Color untuk Chrome, Firefox OS, Opera dan Vivaldi -->
    <meta name="theme-color" content="#FDCA49" />
    <!-- URL Theme Color untuk Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#FDCA49" />
    <!-- URL Theme Color untuk iOS Safari -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#FDCA49" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <title>Login &rsaquo; Adeeva Tour</title>
    <link rel="icon" href="<?= base_url('assets/img/adeeva-circle.png') ?>" type="image/gif" sizes="16x16">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style-login.css') ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <center>
        <div class="wrapper">
            <div class="imgHMIF">
                <center>
                    <img src="<?= base_url('assets/img/adeeva-circle.png') ?>" alt="Adeeva Tour" class="img-responsive">
                </center>
            </div>
            <form method="POST" action="<?= base_url('login_admin/index') ?>" class="form-signin" id="form_login">
                <h1 class="clr-white"> Login Direktur </h1>
                <?= $this->session->flashdata('message') ?>
                <div class="form-group">
                    <input type="text" class="form-control form-login" name="username" placeholder="User Name">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-login" name="password" placeholder="Password">
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="login">Login</button>
                <!-- <a href="<?= base_url('home') ?>" class="btn btn-lg btn-primary btn-block">Login</a> -->
            </form>
            <center>
                <font color="#fff" class="fontRegular">
                    <p><br> All Rights Reserved &copy; 2019<br>
                        Powered by Developer <a href="#" target="_blank"><b>Adeeva Tour 2017/2018</b></a>
                    </p>
                </font>
            </center>
        </div>
    </center>
    <script src="<?= base_url('assets/js/jquery-2.2.3.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrapvalidator.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#form_login').bootstrapValidator({
                    // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        username: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Silahkan isi kolom username!'
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9_]+$/,
                                    message: 'Username hanya boleh alphabet, number dan underscore.'
                                }
                            }
                        },
                        password: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Silahkan isi kolom password!'
                                }
                            }
                        }
                    }
                })
                .on('success.form.bv', function(e) {
                    $('#success_message').slideDown({
                        opacity: "show"
                    }, "slow") // Do something ...
                    $('#contact_form').data('bootstrapValidator').resetForm();

                    // Prevent form submission
                    e.preventDefault();

                    // Get the form instance
                    var $form = $(e.target);

                    // Get the BootstrapValidator instance
                    var bv = $form.data('bootstrapValidator');

                    // Use Ajax to submit form data
                    $.post($form.attr('action'), $form.serialize(), function(result) {
                        console.log(result);
                    }, 'json');
                });
        });
    </script>
</body>

</html>