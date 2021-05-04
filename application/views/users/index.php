<div class="container-fluid mb-5">

    <!-- Section: Basic examples -->
    <section>

        <!-- Gird column -->
        <div class="col-md-12">

            <h5 class="my-4 dark-grey-text font-weight-bold">Danh sách nhân viên</h5>
            <div class="card">
                <div class="card-body">
                    <div id="dtMaterialDesignExample_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="dtMaterialDesignExample" class="table table-striped dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="dtMaterialDesignExample_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name
                    : activate to sort column descending" style="width: 78px;">Tên
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-label="Position
                    : activate to sort column ascending" style="width: 130.8px;">Phòng ban
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-label="Office
                    : activate to sort column ascending" style="width: 55.6px;">Vị trí
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-label="Age
                    : activate to sort column ascending" style="width: 25.2px;">Quyền
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-label="Start date
                    : activate to sort column ascending" style="width: 58.8px;">Email
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($staffList as $key => $s) {
                                        ?>
                                            <tr role="row">
                                                <td><?=$s['fullname']?></td>
                                                <td><?=$s['department']?></td>
                                                <td>Tokyo</td>
                                                <td><?=$s['role']?></td>
                                                <td><?=$s['email']?></td>
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