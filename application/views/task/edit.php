<?php
if ($isAuthorized == false) {
?>
    <section>
        <?php
        $this->load->view("errors/restricted_area");
        ?>
    </section>
<?php
}
?>

<?php
if ($isAuthorized == true) {
?>

    <section class="my-5">
        <form method="post" action="<?=base_url()?>task/doEditTask/<?=$task_data[0]['id']?>">
        <div class="row">

            <!-- Grid column -->
            <div class="col-lg-12 mb-4">

                <!--Form with header -->
                <div class="card">

                    <div class="card-body">
                        <!--Header -->
                        <div class="form-header blue accent-1">
                            <h3>Chỉnh sửa chi tiết công việc</h3>
                        </div>

                        <br>

                        <?php
                        if (intval($this->session->userdata("position")) == 1) {

                        ?>
                            <!--Body -->
                            <div class="md-form">
                                <i class="fas fa-pencil-alt prefix"></i>
                                <input type="text" name="task_title" class="form-control" value="<?= $task_data[0]['title'] ?>">
                                
                                <label for="task_title">Tên công việc</label>
                            </div>

                            <label for="task_handler" class="text text-success">Người được giao</label>
                            <select class="mdb-select md-form" name="task_handler">
                                <?php
                                foreach ($stafflist as $s) {
                                ?>
                                    <option value=<?= $s["id"] ?> <?= ($task_data[0]['handler'] === $s["id"]) ? "selected" : "" ?>><?= $s["fullname"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>


                            <div class="md-form md-outline">
                                <textarea type="text" name="task_content" class="md-textarea form-control" rows="3"><?= $task_data[0]['content'] ?></textarea>
                                <label for="task_content" class="">Nội dung công việc</label>
                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        if (intval($this->session->userdata("position")) != 1) {

                        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h3 class="text-success"><?= $task_data[0]["title"] ?></h3>
                                    </div>
                                    <hr>
                                    <div class="text-justify text-primary">
                                        <?= $task_data[0]["content"] ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                if (intval($this->session->userdata("position")) == 1) {

                                ?>
                                    <div class="md-form md-outline">
                                        <!-- <label for="task_deadline">Deadline</label> -->
                                        <input type="datetime-local" name="task_deadline" class="form-control" value="<?php echo preg_replace('/[+].*/', '', date("c", strtotime($task_data[0]['deadline']))); ?>">
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="text-primary">
                                        Deadline: <b><?=$task_data[0]["deadline"]?></b>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="col-md-6">
                                <select class="mdb-select md-form" name="task_status">
                                    <option value="" disabled selected>Chọn trạng thái công việc</option>
                                    <option value="1" <?= ($task_data[0]['status'] == 1) ? "selected" : "" ?>>Vừa được giao</option>
                                    <option value="2" <?= ($task_data[0]['status'] == 2) ? "selected" : "" ?>>Đang thực hiện</option>
                                    <option value="3" <?= ($task_data[0]['status'] == 3) ? "selected" : "" ?>>Trì hoãn</option>
                                    <option value="4" <?= ($task_data[0]['status'] == 4) ? "selected" : "" ?>>Đã hoàn thành</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-blue waves-effect waves-light">Cập nhật</button>
                        </div>

                    </div>

                </div>
                <!--Form with header -->

            </div>
            <!-- Grid column -->

        </div>
                            </form>
    </section>

<?php
}
?>