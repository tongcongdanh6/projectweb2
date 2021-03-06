<!-- TASK SECTION -->
<section class="mb-5">

    <!-- Grid row -->
    <div class="row">
        <?php
        foreach ($department_data as $d) {
        ?>
            <!-- Grid column -->
            <div class="col-lg-4 col-md-12 mb-lg-0 mb-4">

                <!-- Panel -->
                <div class="card">

                    <div class="card-header white-text primary-color">
                        <?= $d['name'] ?>
                    </div>
                    <div class="card-body text-center px-4 mb-3">
                        <?php
                        if (isset($tasks_data[$d['slug']])) {
                            if (count($tasks_data[$d['slug']]) == 0) {
                                echo "Hiện tại không có task nào";
                            }
                        }
                        ?>
                        <div class="list-group list-panel">
                            <?php
                            if (isset($tasks_data[$d['slug']])) {
                                foreach ($tasks_data[$d['slug']] as $t) {
                            ?>
                                    <a href="<?= base_url() ?>task/detail/<?= $t['id'] ?>" class="list-group-item d-flex justify-content-between"><?= $t['title'] ?>
                                        <?php

                                        if ($t['status'] == 1) {
                                        ?>
                                            <span class="badge badge-success">Vừa nhận</span>
                                        <?php
                                        }
                                        ?>
                                        <?php

                                        if ($t['status'] == 2) {
                                        ?>
                                            <span class="badge badge-warning">Đang thực hiện</span>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($t['status'] == 3) {
                                        ?>
                                            <span class="badge badge-danger">Trì hoãn</span>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($t['status'] == 4) {
                                        ?>
                                            <span class="badge badge-success">Hoàn thành</span>
                                        <?php
                                        }
                                        ?>
                                    </a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <!-- Panel -->

            </div>
            <!-- Grid column -->
        <?php
        }
        ?>

    </div>
    <!-- Grid row -->

</section>
<!-- ./ TASK SECTION -->