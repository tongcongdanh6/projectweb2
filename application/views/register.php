
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap Template</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>public/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="<?=base_url();?>public/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="<?=base_url();?>public/css/mdb.min.css" rel="stylesheet">

  <style>

    html,
    body,
    header,
    .view {
      height: 100%;
    }

    @media (min-width: 851px) and (max-width: 1440px) {
      html,
      body,
      header,
      .view {
        height: 850px;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      html,
      body,
      header,
      .view {
        height: 1000px;
      }
    }

    @media (min-width: 451px) and (max-width: 740px) {
      html,
      body,
      header,
      .view {
        height: 1200px;
      }
    }

    @media (max-width: 450px) {
      html,
      body,
      header,
      .view {
        height: 1400px;
      }
    }

    .intro-2 {
      background: url("<?=base_url()?>public/img/forest1.jpg") no-repeat center center;
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
            background: #3f51b5!important;
        }
    }

    .rgba-gradient {
      background: -webkit-linear-gradient(98deg, rgba(22, 91, 231, 0.5), rgba(255, 32, 32, 0.5) 100%);
      background: -webkit-gradient(linear, 98deg, from(rgba(22, 91, 231, 0.5)), to(rgba(255, 32, 32, 0.5)));
      background: linear-gradient(to 98deg, rgba(22, 91, 231, 0.5), rgba(255, 32, 32, 0.5) 100%);
    }

    .card {
      background-color: rgba(255, 255, 255, 0.85);
    }

    h6 {
      line-height: 1.7;
    }
  </style>

</head>

<body>

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
      <div class="container">
        <a class="navbar-brand" href="#">
          <strong>Ch????ng tr??nh qu???n l?? c??ng vi???c</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
          aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
    <!-- Navbar -->

    <!--Intro Section-->
    <section class="view intro-2">
      <div class="mask rgba-gradient">
        <div class="container h-100 d-flex justify-content-center align-items-center">

          <!--Grid row-->
          <div class="row  pt-5 mt-3">

            <!--Grid column-->
            <div class="col-md-12">

              <div class="card">
                <div class="card-body">

                  <h2 class="font-weight-bold my-4 text-center mb-5 mt-4 font-weight-bold">
                    <strong>????ng k?? t??i kho???n</strong>
                  </h2>
                  <hr>

                  <!--Grid row-->
                  <div class="row mt-5">

                    <!--Grid column-->
                    <div class="col-md-6 ml-lg-5 ml-md-3">

                      <!--Grid row-->
                      <div class="row pb-4">
                        <div class="col-2 col-lg-1">
                          <i class="fas fa-university indigo-text fa-lg"></i>
                        </div>
                        <div class="col-10">
                          <h4 class="font-weight-bold mb-4">
                            <strong>Safety</strong>
                          </h4>
                          <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores
                            nam, aperiam
                            minima assumenda deleniti hic.</p>
                        </div>
                      </div>
                      <!--Grid row-->

                      <!--Grid row-->
                      <div class="row pb-4">
                        <div class="col-2 col-lg-1">
                          <i class="fas fa-desktop deep-purple-text fa-lg"></i>
                        </div>
                        <div class="col-10">
                          <h4 class="font-weight-bold mb-4">
                            <strong>Technology</strong>
                          </h4>
                          <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores
                            nam, aperiam
                            minima assumenda deleniti hic.</p>
                        </div>
                      </div>
                      <!--Grid row-->

                      <!--Grid row-->
                      <div class="row pb-4">
                        <div class="col-2 col-lg-1">
                          <i class="fas fa-money-bill-alt purple-text fa-lg"></i>
                        </div>
                        <div class="col-10">
                          <h4 class="font-weight-bold mb-4">
                            <strong>Finance</strong>
                          </h4>
                          <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores
                            nam, aperiam
                            minima assumenda deleniti hic.</p>
                        </div>
                      </div>
                      <!--Grid row-->

                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-5">

                      <!--Grid row-->
                      <div class="row pb-4 d-flex justify-content-center mb-4">

                        <h4 class="mt-3 mr-4">
                          <strong>B???n ???? c?? t??i kho???n? <?=anchor('login','Click v??o ????y')?> ????? ????ng nh???p</strong>
                        </h4>

                      </div>

                      <?=validation_errors('<div class="alert alert-warning">','</div>')?>
                      <!--/Grid row-->
                      <?=form_open("register/doRegister")?>
                      <!--Body-->
                      <div class="md-form">
                        <i class="fas fa-user prefix"></i>
                        <input type="text" id="fullname" name="fullname" value="<?=set_value('fullname')?>" class="form-control">
                        <label for="orangeForm-name">H??? t??n:</label>
                      </div>
                      <div class="md-form">
                        <i class="fas fa-envelope prefix"></i>
                        <input type="text" id="email" name="email" value="<?=set_value('email')?>" class="form-control">
                        <label for="orangeForm-email">Email</label>
                      </div>

                      <div class="md-form">
                        <i class="fas fa-lock prefix"></i>
                        <input type="password" id="password" name="password" class="form-control">
                        <label for="orangeForm-pass">M???t kh???u</label>
                      </div>
                
                      <label for="staff_department" data-error="wrong" data-success="right">B??? ph???n (ph??ng)</label>
                      <select class="mdb-select md-form" name="staff_department">
                          <?php
                          foreach ($department_list as $value) {
                          ?>
                              <option value="<?=$value['slug']?>"><?=$value['name']?></option>
                          <?php
                          }
                          ?>
                      </select>
                      
                      <div class="text-center">
                        <button class="btn btn-indigo btn-rounded mt-5">????ng k??</button>
                      </div>
                      </form>
                    </div>
                    <!--Grid column-->

                  </div>
                  <!--Grid row-->

                </div>
              </div>

            </div>
            <!--Grid column-->

          </div>
          <!--Grid row-->

        </div>
      </div>
    </section>
    <!--Intro Section-->

  </header>
  <!--Main Navigation-->

  <!--  SCRIPTS  -->
  <!-- JQuery -->
  <script type="text/javascript" src="<?=base_url();?>public/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?=base_url();?>public/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?=base_url();?>public/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?=base_url();?>public/js/mdb.min.js"></script>
  <script>
    new WOW().init();
    $(document).ready(function() {
      $('.mdb-select').materialSelect();
    });

  </script>
</body>

</html>
