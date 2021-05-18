<div class="container-fluid mb-5">

    <!-- Section: Basic examples -->
    <section>
        
        <?php
        if ($this->session->flashdata('message')) {
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary">
                        <?=$this->session->flashdata('message')?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- Gird column -->
        <div class="col-md-12">

            <h5 class="my-4 dark-grey-text font-weight-bold">Danh sách công việc</h5>
            <div class="card">
                <div class="card-body">
                    <div id="dtMaterialDesignExample_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="dtMaterialDesignExample" class="table table-striped dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="dtMaterialDesignExample_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name
                    : activate to sort column descending">ID
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name
                    : activate to sort column descending">Người tạo
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-label="Position
                    : activate to sort column ascending">Người được giao
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-label="Office
                    : activate to sort column ascending">Tiêu đề
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-label="Start date
                    : activate to sort column ascending">Tóm tắt nội dung
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-label="Start date
                    : activate to sort column ascending">Tạo vào
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($tasks_data as $key => $s) {
                                        ?>
                                            <tr role="row">
                                                <td><?= $s['id'] ?></td>
                                                <td><?= $s['creator_fullname'] ?></td>
                                                <td><?= $s['handler_fullname'] ?></td>
                                                <td>
                                                    <a href="<?= base_url() ?>task/detail/<?= $s['id'] ?>" class="btn btn-primary btn-sm"><?= $s['title'] ?></a>
                                                </td>
                                                <td><?= word_limiter($s['content'], 9) ?></td>
                                                <td><?= date("d-m-Y H:i:s", strtotime($s['created_at'])) ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Gird column -->

    </section>
    <!-- Section: Basic examples -->

</div>