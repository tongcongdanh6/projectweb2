<?php
// var_dump($department_staff_list);
?>

<div class="container-fluid">
    <!-- Section: Inputs -->
    <?= form_open("task/doAddNewTask"); ?>
    <section class="section card mb-5">
        <h1 class="card-header primary-color white-text text-center">Thêm công việc mới</h1>
        <div class="card-body">
            <?= validation_errors('<div class="alert alert-warning">', '</div>') ?>
            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-12">

                    <div class="md-form md-outline">
                        <input type="text" name="task_title" class="form-control" value="<?= set_value('task_title') ?>">
                        <label for="task_title" class="">Tên công việc mới</label>
                    </div>

                </div>
                <!-- Grid column -->

            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="task_handler" data-error="wrong" data-success="right">Người được giao</label>
                    <div class="md-form md-outline">
                        <select class="mdb-select md-form" name="task_handler" id="task_handler">
                            <?php
                            if ($this->session->userdata("role") == 1) {
                            ?>
                                <?php
                                foreach ($department_staff_list as $k => $v) {
                                ?>
                                    <optgroup label="<?=$k?>">
                                        <?php
                                        foreach($v as $v1) {
                                        ?>
                                            <option value=<?=$v1['id']?>><?=$v1['fullname']?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                <?php
                                }
                            } else {
                                foreach($department_staff_list as $k) {
                                ?>
                                    <option value=<?=$k['id']?>><?=$k['fullname']?></option>
                            <?php
                            }}
                            ?>

                        </select>
                    </div>

                </div>
            </div>
            <!-- Grid row -->
            <div class="row text-left">

                <!-- Grid column -->
                <div class="col-md-12 mb-6">

                    <!-- Basic textarea -->
                    <div class="md-form md-outline">
                        <textarea type="text" name="task_content" class="md-textarea form-control" rows="3"></textarea>
                        <label for="task_content" class="">Nội dung công việc</label>
                    </div>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

            <div class="row text-left">

                <!-- Grid column -->
                <div class="col-md-6 mb-6">
                    <label for="task_deadline" class="">Deadline</label>
                    <!-- Basic textarea -->
                    <div class="md-form md-outline">
                        <input type="datetime-local" name="task_deadline" class="form-control" value="<?= set_value('task_deadline') ?>">

                    </div>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

            <div class="row">
                <div class="col-md-12 text-center">
                    <button class="btn blue-gradient btn-rounded waves-effect waves-light">Thêm công việc mới</button>
                </div>
            </div>

        </div>

    </section>
    <!-- Section: Inputs -->
    </form>

</div>