<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PangenPangan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php blink('assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php blink('assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php blink('assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php blink('assets/AdminLTE/dist/css/AdminLTE.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php blink('assets/AdminLTE/plugins/iCheck/square/blue.css')?>">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-color: #b3b3b3">
<div class="login-box">
  <div class="login-logo">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">
      <a href="<?php blink('Home') ?>">
        <img alt="" src="<?php blink('assets/img/img/panen.png')?>" width="50%">
      </a>
    </p>

<?php if(isset($username)) { ?>

    <form action="<?php blink('LupaPassword/update') ?>" method="post">
      <div class="form-group has-feedback">
        <?php foreach($username as $data) { ?>
        <input type="hidden" value="<?php echo $data->username ?>" class="form-control" name="username" placeholder="Masukkan Password baru">
        <?php } ?>
        <input type="password" class="form-control" name="password" placeholder="Masukkan Password baru">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password2" placeholder="Masukkan kembali password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <!-- <label>
              <input type="checkbox"> Remember Me
            </label> -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-success btn-block btn-flat">Reset Password</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>

<!-- /.login-box -->
<?php } else { ?>
<script type='text/javascript'>
               alert ('Gagal Memuat Halaman');
               window.location.replace('Login');
            </script>
        <?php }?>



<!-- jQuery 3 -->
<script src="<?php blink('assets/AdminLTE/bower_components/jquery/dist/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php blink('assets/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- iCheck -->
<script src="<?php blink('assets/AdminLTE/plugins/iCheck/icheck.min.js')?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
