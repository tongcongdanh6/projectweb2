<!-- TASK SECTION -->
<section class="mb-5">

    <!-- Grid row -->
    <div class="row">
            <!-- Grid column -->
            <div class="col-lg-4 col-md-12 mb-lg-0 mb-4">

                <!-- Panel -->
                <div class="card">

                    <div class="card-header white-text primary-color">
                        Danh sách công việc
                    </div>
                    <div class="card-body text-center px-4 mb-3">
                    <?php
                        if(count($tasks_data) == 0) {
                            echo "Hiện tại không có task nào";
                        }
                    ?>
                        <div class="list-group list-panel">
                            <?php
                            foreach ($tasks_data as $t) {
                            ?>
                                <a href="<?=base_url()?>task/detail/<?=$t['id']?>" class="list-group-item d-flex justify-content-between"><?= $t['title'] ?>
                                    <?php
                                    if ($t['status'] == 1) {
                                    ?>
                                        <span class="badge badge-info">Đang thực hiện</span>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($t['status'] == 2) {
                                    ?>
                                        <span class="badge badge-warning">Bị hoãn lại</span>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($t['status'] == 3) {
                                    ?>
                                        <span class="badge badge-success">Hoàn thành</span>
                                    <?php
                                    }
                                    ?>
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <!-- Panel -->

            </div>
            <!-- Grid column -->

    </div>
    <!-- Grid row -->

</section>
<!-- ./ TASK SECTION -->