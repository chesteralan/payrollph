<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (isset($page_title)) ? $page_title : APP_NAME; ?></title>
    <link href="<?php echo base_url('assets/themes/yeti/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    <!--
      body {
            padding-top: 70px;
        }
      @media (min-width: 1200px) {
        body {
            padding-top: 170px;
        }
      }
      #divBody {
        position: relative;
      }
      #divBody .login-wait {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,.1);
        z-index: 1;
      }
      #divBody .login-wait > img {
        margin: 25% auto;
        display: block;
      }
    -->  
    </style>
  </head>
  <body>
    
<div class="container">

<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading">Login</div>
          <div class="panel-body" id="divBody">
              <div class="form-group">
                <label>Username</label>
                <input id="txtUsername" type="text" class="form-control enter-submit" placeholder="Username" name="username" required="required" autofocus="autofocus">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input id="txtPassword" type="password" class="form-control enter-submit" placeholder="Password" name="password" required="required">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-success btn-block" value="Login" id="btnLogin">
              </div>
          </div>
        </div>
    </div>
</div>
    
<div class="container hide-print">
  <div class="row">
    <div class="col-md-12">
      <center><small>
        <p><a href="http://www.trokis.com/" target="footer_credits">Trokis Philippines</a> 
        &copy; 2016 
        <br>Developed by: 
        <a href="http://www.chesteralan.com/" target="footer_credits">Chester Alan Tagudin</a> 
        </p>
      </small></center>
    </div>
  </div> 
</div>
    
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script>
      <!--
        var ajax_login_url = '<?php echo site_url("account/login/ajax") . (($this->input->get('next'))?'?next='.$this->input->get('next'):''); ?>';
      -->
    </script>
    <script src="<?php echo base_url('assets/js/login.js'); ?>"></script>
  </body>
</html>
