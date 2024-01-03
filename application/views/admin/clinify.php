<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#424242" />
    
    <title></title>
    <!--favican-->
    <link href="<?php echo base_url(); ?>uploads/hospital_content/logo/1mini_logo.png" rel="shortcut icon" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/form-elements.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/jquery.mCustomScrollbar.min.css">
    <style type="text/css">
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-content {
            flex: 1;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-bottom: 33vh; /* Ajusta el margen inferior según sea necesario */
        }

        .col-md-12 img {
            margin: 10px;
            max-width: 225px;
            max-height: 100px;
            display: flex;
            justify-content: center;
        }

        .loginbg {
            background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #cbcaca;
            background-blend-mode: multiply,multiply;
            max-height: 480px;
            box-shadow: 0 10px 18px 0 rgba(rgba(71, 160, 255));
            border-radius: 14px ;
        }

        a.forgot {
            padding-top: 0px;
            color: #fff;
        }

        a:hover.forgot {
            padding-top: 0px;
            color: #fff;
            text-decoration: underline;
        }

        button.btn {
            margin: 0;
            padding: 0 20px;
            vertical-align: middle;
            background: #1f1f1f;
            border: 0;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 400;
            color: #fff;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
            text-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
            box-shadow: none;
            -o-transition: all .3s;
            -moz-transition: all .3s;
            -webkit-transition: all .3s;
            -ms-transition: all .3s;
            transition: all .3s;
        }

        button.btn:hover {
            opacity: 100 !important;
            color: #fff;
            background: #1563b0;
        }

        @media (max-width: 767px) {
            .col-md-offset-3 {
                margin-left: 0;
            }
        }
      
     
      
        .hover_logo img {
        transition: transform 0.3s ease-in-out;
          }

          .hover_logo:hover img {
              transform: scale(1.1);
          }
      
    </style>
</head>
<body>
    <!-- Top content -->
    <div class="top-content">
        <div class="">
            <div class="container">
                <div class="col-md-12 justify-content-center" style="display: flex;justify-content: center;">
                    <div class="col-md-6" >
                        <div class="col-md-12" style="margin-bottom: -94px;display: flex;margin-left: -49px;">
                            <div class="col-md-4">
                                <a class="hover_logo" href="#"><img src="<?php echo base_url(); ?>uploads/own_cliniverso/imgs/incodol_2.png" alt="Incodol" class="" style="height:150%;width:auto"></a>
                            </div>
                            <div class="col-md-4">
                                <a class="hover_logo" href="#"><img src="<?php echo base_url(); ?>uploads/own_cliniverso/imgs/neuromedica_1.png" alt="neuromedica" class="" style="height:150%;width:auto"></a>
                            </div>
                            <div class="col-md-4">
                                <a class="hover_logo" href="<?php echo base_url(); ?>site/login"><img src="<?php echo base_url(); ?>uploads/own_cliniverso/imgs/cliniverso_3.png" alt="cliniverso" class="" style="height:150%;width:auto"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mousewheel.min.js"></script>        
</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = '<?php echo base_url(); ?>';
        $.backstretch([
            base_url +  "uploads/own_cliniverso/imgs/landing_clinify_2.webp"
        ], {duration: 1000, fade: 50});
        $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function () {
            $(this).removeClass('input-error');
        });
        $('.login-form').on('submit', function (e) {
            $(this).find('input[type="text"], input[type="password"], textarea').each(function () {
                if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
        });
    });
</script>
<script type="text/javascript">
    function refreshCaptcha(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('site/refreshCaptcha'); ?>",
            data: {},
            success: function(captcha){
                $("#captcha_image").html(captcha);
            }
        });
    }    
</script>