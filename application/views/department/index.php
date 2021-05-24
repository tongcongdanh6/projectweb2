<div class="container-fluid mb-5">

    <!-- Section: Basic examples -->
    <section>

        <!-- Gird column -->
        <div class="col-md-12">
            <?php
            if ($this->session->flashdata("message") != null) {
            ?>
                <div class="alert alert-warning"><?= $this->session->flashdata("message") ?></div>
            <?php
            }
            ?>
            <h5 class="my-4 dark-grey-text font-weight-bold">Danh sách phòng ban</h5>
            <div class="card">
                <div class="card-body">
                    <div id="dtMaterialDesignExample_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="dtMaterialDesignExample" class="table table-striped dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="dtMaterialDesignExample_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name
                    : activate to sort column descending" style="width: 78px;">ID
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name
                    : activate to sort column descending" style="width: 78px;">Tên phòng ban
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name
                    : activate to sort column descending" style="width: 78px;">Trưởng phòng
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($department_list as $key => $s) {
                                        ?>
                                            <tr role="row">
                                                <td><?= $s['id'] ?></td>
                                                <td><?= $s['name'] ?></td>
                                                <td><?= $s['nameheadof'] ?></td>
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