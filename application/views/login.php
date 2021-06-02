<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap Template</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="<?= base_url() ?>public/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="<?= base_url() ?>public/css/mdb.min.css" rel="stylesheet">

  <style>
    html,
    body,
    header,
    .view {
      height: 100vh;
    }

    @media (max-width: 740px) {

      html,
      body,
      header,
      .view {
        height: 815px;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .view {
        height: 650px;
      }
    }

    .intro-2 {
      background: url("<?= base_url() ?>public/img/img%20(11).jpg")no-repeat center center;
      background-size: cover;
    }

    .top-nav-collapse {
      background-color: #3f51b5 !important;
    }

    .navbar:not(.top-nav-collapse) {
      background: transparent !important;
    }

    @media (max-width: 768px) {
      .navbar:not(.top-nav-collapse) {
        background: #3f51b5 !important;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      .navbar:not(.top-nav-collapse) {
        background: #3f51b5 !important;
      }
    }

    .card {
      background-color: rgba(229, 228, 255, 0.2);
    }

    .md-form label {
      color: #ffffff;
    }

    h6 {
      line-height: 1.7;
    }


    .card {
      margin-top: 30px;
      /*margin-bottom: -45px;*/

    }

    .md-form input[type=text]:focus:not([readonly]),
    .md-form input[type=password]:focus:not([readonly]) {
      border-bottom: 1px solid #8EDEF8;
      box-shadow: 0 1px 0 0 #8EDEF8;
    }

    .md-form input[type=text]:focus:not([readonly])+label,
    .md-form input[type=password]:focus:not([readonly])+label {
      color: #8EDEF8;
    }

    .md-form .form-control {
      color: #fff;
    }
  </style>

</head>

<body>


  <!--Main Navigation-->
  <header>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
      <div class="container">
        <a class="navbar-brand" href="#"><strong>Chương trình quản lý công việc</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <!--Intro Section-->
    <section class="view intro-2">
      <div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5">
              <!-- Hiển thị thông tin validation form -->
              <?= validation_errors('<div class="alert alert-warning">', '</div>'); ?>
              <!--/.Hiển thị thông tin validation form -->

              <?php echo form_open('login/dologin'); ?>
              <!--Form with header-->
              <div class="card wow fadeIn" data-wow-delay="0.3s">
                <div class="card-body">

                  <!--Header-->
                  <div class="form-header purple-gradient">
                    <h3><i class="fas fa-user mt-2 mb-2"></i> Đăng nhập</h3>
                  </div>
                  <?= $this->session->flashdata('invalidAuthenInfo'); ?>
                  <!--Body-->
                  <div class="md-form">
                    <i class="fas fa-envelope prefix white-text"></i>
                    <input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control">
                    <label for="orangeForm-email">Email:</label>
                  </div>

                  <div class="md-form">
                    <i class="fas fa-lock prefix white-text"></i>
                    <input type="password" name="password" class="form-control">
                    <label for="orangeForm-pass">Mật khẩu</label>
                  </div>

                  <div class="text-center">
                    <button class="btn purple-gradient btn-lg">Đăng nhập</button>
                    <hr>
                    <a class="btn purple-gradient btn-sm" href="<?= base_url() ?>register">Đăng ký</a>
                    <div class="inline-ul text-center d-flex justify-content-center">
                      <a class="p-2 m-2 fa-lg tw-ic"><i class="fab fa-twitter white-text"></i></a>
                      <a class="p-2 m-2 fa-lg li-ic"><i class="fab fa-linkedin-in white-text"> </i></a>
                      <a class="p-2 m-2 fa-lg ins-ic"><i class="fab fa-instagram white-text"> </i></a>
                    </div>
                  </div>

                </div>
              </div>
              <!--/Form with header-->
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </header>
  <!--Main Navigation-->


  <!--  SCRIPTS  -->
  <!-- JQuery -->
  <script type="text/javascript" src="<?= base_url() ?>public/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?= base_url() ?>public/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?= base_url() ?>public/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?= base_url() ?>public/js/mdb.min.js"></script>
  <script>
    new WOW().init();
  </script>
</body>

</html>