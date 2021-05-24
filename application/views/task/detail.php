<?php
if ($isAuthorized == false) {
?>
    <section>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="alert alert-danger">
                    <b>
                        Bạn không có quyền xem chi tiết công việc này. Nếu bạn nghĩ đây là lỗi do hệ thống. Vui lòng liên hệ quản trị viên của website để biết thêm chi tiết.
                    </b>
                </div>
            </div>
        </div>
    </section>
<?php
}
?>


<?php
if ($isAuthorized == true) {
?>
    <section>
        <h3 class="mb-4 dark-grey-text font-weight-bold"><strong>Chi tiết công việc</strong></h3>

        <div class="row mb-5">

            <!-- Grid column -->
            <div class="col-lg-12 col-md-12 mb-4">

                <!-- Card -->
                <div class="card card-cascade">

                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header blue-gradient">
                        <h2 class="card-header-title"><?= $task_data[0]['title'] ?></h2>
                        <p>Mã số công việc: <?= $task_data[0]['id'] ?></p>
                    </div>
                    <!-- Card image -->

                    <!-- Card content -->
                    <div class="card-body card-body-cascade">

                        <p class="card-text pb-2 text-center"><?= $task_data[0]['content'] ?>
                        </p>
                        <p class="card-text">Trạng thái:
                            <?php
                            if ($task_data[0]['status'] == 1) {
                            ?>
                                <span class="alert alert-primary">
                                    Vừa được nhận
                                </span>
                            <?php
                            }
                            ?>
                            <?php
                            if ($task_data[0]['status'] == 2) {
                            ?>
                                <span class="alert alert-warning">
                                    Đang thực hiện
                                </span>
                            <?php
                            }
                            ?>
                            <?php
                            if ($task_data[0]['status'] == 3) {
                            ?>
                                <span class="alert alert-danger">
                                    Bị trì hoãn
                                </span>
                            <?php
                            }
                            ?>
                            <?php
                            if ($task_data[0]['status'] == 4) {
                            ?>
                                <span class="alert alert-success">
                                    Đã hoàn thành
                                </span>
                            <?php
                            }
                            ?>
                        </p>
                        <p class="card-text pb-2">Người được giao: <b><?=$task_data[0]['handler_fullname']?></b></p>
                        <p class="card-text pb-2">Deadline:
                        <b><?=date("d-m-Y H:i:s",strtotime($task_data[0]['deadline']))?></b>
                        </p>
                        <hr>
                        <!-- Twitter -->
                        <a class="p-2 m-2 fa-lg tw-ic"><i class="fab fa-twitter"> </i></a>
                        <!-- Linkedin -->
                        <a class="p-2 m-2 fa-lg li-ic"><i class="fab fa-linkedin-in"> </i></a>
                        <!-- Facebook -->
                        <a class="p-2 m-2 fa-lg fb-ic"><i class="fab fa-facebook-f"> </i></a>
                        <!-- Email -->
                        <a class="p-2 m-2 fa-lg email-ic"><i class="fas fa-envelope"> </i></a>
                        <a class="btn btn-primary btn-rounded waves-effect waves-light" href="<?=base_url()?>task/edit/<?=$task_data[0]['id']?>">Chỉnh sửa công việc này</a>
                        <?php
                        if($this->session->userdata("role") == 1 || $this->session->userdata("position") == 1) {
                        echo '<a data-toggle="modal" data-target="#confirmDeleteTask" class="btn btn-danger">Xóa công việc này!!!</a>';
                        }
                        ?>
                        
                    </div>
                    <!-- Card content -->

                </div>
                <!-- Card -->

            </div>
            <!-- Grid column -->

        </div>

        <div class="modal fade" id="confirmDeleteTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-notify modal-danger" role="document">
            <!-- Content -->
            <div class="modal-content">
              <!-- Header -->
              <div class="modal-header">
                <p class="heading">Xác nhận thao tác XÓA</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="white-text">×</span>
                </button>
              </div>

              <!-- Body -->
              <div class="modal-body">

                <div class="row">
                  <div class="col-3">
                    <p></p>
                    <p class="text-center"><i class="fas fa-times fa-4x"></i></p>
                  </div>

                  <div class="col-9">
                    <p>Thao tác này khiến dữ liệu mất hoàn toàn trên máy chủ? Bạn có thực sự muốn thao tác không?</p>
                    <h2>Mã công việc: <span class="badge"><?=$task_data[0]['id']?></span></h2>
                  </div>
                </div>
              </div>

              <!-- Footer -->
              <div class="modal-footer justify-content-center">
                <a type="button" href="<?=base_url()?>task/delete/<?=$task_data[0]['id']?>" class="btn btn-danger waves-effect waves-light">XÓA</a>
                <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">HỦY THAO TÁC</a>
              </div>
            </div>
            <!-- Content -->
          </div>
        </div>
    </section>
<?php
}
?>