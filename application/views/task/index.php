<?php
var_dump($tasks_data);
?>
<div class="container-fluid mb-5">

    <!-- Section: Basic examples -->
    <section>

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
                    : activate to sort column descending" style="width: 78px;">ID Công việc
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name
                    : activate to sort column descending" style="width: 78px;">Người tạo
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-label="Position
                    : activate to sort column ascending" style="width: 130.8px;">Người được giao
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-label="Office
                    : activate to sort column ascending" style="width: 55.6px;">Tiêu đề
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dtMaterialDesignExample" rowspan="1" colspan="1" aria-label="Start date
                    : activate to sort column ascending" style="width: 58.8px;">Tóm tắt nội dung
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($tasks_data as $key => $s) {
                                        ?>
                                            <tr role="row">
                                                <td><?=$s['id']?></td>
                                                <td><?=$s['creator']?></td>
                                                <td><?=$s['handler']?></td>
                                                <td><?=$s['title']?></td>
                                                <td><?=$s['content']?></td>
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