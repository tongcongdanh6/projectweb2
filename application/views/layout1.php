<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= $pageTitle ?></title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>public/css/all.css">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>public/css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>public/css/mdb.min.css">
  <!-- Your custom styles (optional) -->
  <style>
    .navbar .notifications-nav .dropdown-menu {
      width: 20rem;
    }
  </style>
</head>

<body class="fixed-sn white-skin">

  <!-- Main Navigation -->
  <header>

    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav sn-bg-4 fixed">
      <ul class="custom-scrollbar">

        <!-- Logo -->
        <li class="logo-sn waves-effect py-3">
          <div class="text-center">
            <a href="<?= base_url() ?>" class="pl-0">
              <h1>QLCV</h1>
            </a>
          </div>
        </li>

        <!-- Search Form -->
        <li>
          <form class="search-form" role="search">
            <div class="md-form mt-0 waves-light">
              <input type="text" class="form-control py-2" placeholder="Search">
            </div>
          </form>
        </li>

        <?php
        $this->load->view("blocks/navigation");
        ?>

      </ul>
      <div class="sidenav-bg mask-strong"></div>
    </div>
    <!-- Sidebar navigation -->

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">

      <!-- SideNav slide-out button -->
      <div class="float-left">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
      </div>

      <!-- Breadcrumb -->
      <div class="breadcrumb-dn mr-auto">
        <p>Chương trình quản lý công việc</p>
      </div>

      <div class="d-flex change-mode">

        <div class="ml-auto mb-0 mr-3 change-mode-wrapper">
          <button class="btn btn-outline-black btn-sm" id="dark-mode">Change Mode</button>
        </div>

        <!-- Navbar links -->
        <ul class="nav navbar-nav nav-flex-icons ml-auto">

          <!-- Dropdown -->
          <li class="nav-item dropdown notifications-nav">
            <a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php if ($count_unread_notification > 0) {
              ?>
                <span class="badge red"><?= $count_unread_notification ?></span> <i class="fas fa-bell"></i>
              <?php
              }
              ?>
              <span class="d-none d-md-inline-block">Thông báo</span>
            </a>
            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
              <?php
              foreach ($notification_data as $n) {
              ?>
                <?php
                if ($n['mark_read'] == 0) {
                  switch ($n['type_notification']) {
                    case 1:
                      $style_css_noti = "alert-primary";
                      break;
                    case 2:
                      $style_css_noti = "alert-warning";
                      break;
                    case 3:
                      $style_css_noti = "alert-danger";
                      break;
                    case 4:
                      $style_css_noti = "alert-success";
                      break;
                    default:
                      $style_css_noti = "alert-primary";
                      break;
                  }
                ?>
                  <a class="dropdown-item <?= $style_css_noti ?> m-0 px-2" href="<?= base_url() ?>task/detail/<?= $n['taskid'] ?>/?noti_id=<?= $n['id'] ?>">
                  <?php
                } else {
                  ?>
                    <a class="dropdown-item m-0 px-2" href="<?= base_url() ?>task/detail/<?= $n['taskid'] ?>/?noti_id=<?= $n['id'] ?>">
                    <?php
                  }
                    ?>

                    <?php if ($n['mark_read'] == 0) { ?><b><?php } ?>
                      <p style="white-space: normal; margin-bottom: 0px">
                      <i class="fas fa-chart-line mr-2" aria-hidden="true"></i>
                      <b><?= $n["content"] ?></b>
                      </p>
                      <span class="float-right"><i class="far fa-clock" aria-hidden="true"></i>
                        <?php
                        echo date("Y-m-d H:i:s", strtotime($n["created_at"]));
                        ?>
                      </span>
                      <?php if ($n['mark_read'] == 0) { ?></b><?php } ?>
                    </a>
                  <?php
                }
                  ?>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i>
              <span class="clearfix d-none d-sm-inline-block"><?= $this->session->userdata("fullname") ?></span>
              <?php
              if ($this->session->userdata("role") == 1) {
                echo '<span class="badge badge-pill badge-danger">Quản trị viên</span>';
              }
              if ($this->session->userdata("position") == 1) {
                echo '<span class="badge badge-pill badge-danger">Trưởng phòng </span>';
              } else {
                echo '<span class="badge badge-pill badge-success">Nhân viên </span>';
              }
              ?>

            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="<?= base_url() ?>logout">Đăng xuất</a>

            </div>
          </li>

        </ul>
        <!-- Navbar links -->

      </div>

    </nav>
    <!-- Navbar -->

    <!-- Fixed button -->
    <div class="fixed-action-btn clearfix d-none d-xl-block" style="bottom: 45px; right: 24px;">

      <a class="btn-floating btn-lg red">
        <i class="fas fa-pencil-alt"></i>
      </a>

      <ul class="list-unstyled">
        <li><a class="btn-floating red"><i class="fas fa-star"></i></a></li>
        <li><a class="btn-floating yellow darken-1"><i class="fas fa-user"></i></a></li>
        <li><a class="btn-floating green"><i class="fas fa-envelope"></i></a></li>
        <li><a class="btn-floating blue"><i class="fas fa-shopping-cart"></i></a></li>
      </ul>

    </div>
    <!-- Fixed button -->

  </header>
  <!-- Main Navigation -->

  <!-- Main layout -->
  <main>
    <?php $this->load->view($subview) ?>
  </main>
  <!-- Main layout -->

  <!-- Footer -->
  <footer class="page-footer pt-0 mt-5 rgba-stylish-light">

    <!-- Copyright -->
    <div class="footer-copyright py-3 text-center">
      <div class="container-fluid">
        © 2021 Copyright by ...
      </div>
    </div>

  </footer>
  <!-- Footer -->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script src="<?= base_url() ?>public/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?= base_url() ?>public/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?= base_url() ?>public/js/bootstrap.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?= base_url() ?>public/js/mdb.min.js"></script>
  <script type="text/javascript" src="<?= base_url() ?>public/js/addons/datatables.min.js"></script>
  <script type="text/javascript" src="<?= base_url() ?>public/js/addons/datatables-select.js"></script>

  <!-- Initializations -->
  <script>
    // SideNav Initialization
    $(".button-collapse").sideNav();

    var container = document.querySelector('.custom-scrollbar');
    var ps = new PerfectScrollbar(container, {
      wheelSpeed: 2,
      wheelPropagation: true,
      minScrollbarLength: 20
    });

    // Data Picker Initialization
    $('.datepicker').pickadate();

    // Material Select Initialization
    $(document).ready(function() {
      $('.mdb-select').material_select();
    });

    // Tooltips Initialization
    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>

  <!-- Charts -->
  <script>
    // Small chart
    $(function() {
      $('.min-chart#chart-sales').easyPieChart({
        barColor: "#FF5252",
        onStep: function(from, to, percent) {
          $(this.el).find('.percent').text(Math.round(percent));
        }
      });
    });

    // Main chart
    var ctxL = document.getElementById("lineChart").getContext('2d');
    var myLineChart = new Chart(ctxL, {
      type: 'line',
      data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: "My First dataset",
          fillColor: "#fff",
          backgroundColor: 'rgba(255, 255, 255, .3)',
          borderColor: 'rgba(255, 255, 255)',
          data: [0, 10, 5, 2, 20, 30, 45],
        }]
      },
      options: {
        legend: {
          labels: {
            fontColor: "#fff",
          }
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: true,
              color: "rgba(255,255,255,.25)"
            },
            ticks: {
              fontColor: "#fff",
            },
          }],
          yAxes: [{
            display: true,
            gridLines: {
              display: true,
              color: "rgba(255,255,255,.25)"
            },
            ticks: {
              fontColor: "#fff",
            },
          }],
        }
      }
    });

    $(function() {
      $('#dark-mode').on('click', function(e) {

        e.preventDefault();
        $('h4, button').not('.check').toggleClass('dark-grey-text text-white');
        $('.list-panel a').toggleClass('dark-grey-text');

        $('footer, .card').toggleClass('dark-card-admin');
        $('body, .navbar').toggleClass('white-skin navy-blue-skin');
        $(this).toggleClass('white text-dark btn-outline-black');
        $('body').toggleClass('dark-bg-admin');
        $('h6, .card, p, td, th, i, li a, h4, input, label').not(
          '#slide-out i, #slide-out a, .dropdown-item i, .dropdown-item').toggleClass('text-white');
        $('.btn-dash').toggleClass('grey blue').toggleClass('lighten-3 darken-3');
        $('.gradient-card-header').toggleClass('white black lighten-4');
        $('.list-panel a').toggleClass('navy-blue-bg-a text-white').toggleClass('list-group-border');

      });
    });
  </script>
  <script>
    // Material Select Initialization
    $(document).ready(function() {
      $('.mdb-select').materialSelect();


      $('#dtMaterialDesignExample').DataTable({
        "responsive": true,
        "autoWidth": true
      });

      // Tooltips Initialization
      $(function() {
        $('[data-toggle="tooltip"]').tooltip()
      })

    });
  </script>
</body>

</html>