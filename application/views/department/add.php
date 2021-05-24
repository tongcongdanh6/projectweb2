<section class="section card mb-5">
    <form method="POST" action="<?= base_url() ?>department/doAddNewDepartment">
        <?= validation_errors('<div class="alert alert-warning">', '</div>') ?>
        <?php
        if ($this->session->flashdata("message") != null) {
        ?>
            <div class="alert alert-warning"><?=$this->session->flashdata("message")?></div>
        <?php
        }
        ?>
        <div class="card-body">

            <!-- Section heading -->
            <h1 class="text-center my-5 h1">Thêm phòng ban mới</h1>

            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-12">

                    <div class="md-form md-outline">
                        <input placeholder="Tên phòng ban" type="text" id="department_name" name="department_name" class="form-control">
                        <label for="department_name" class="active">Tên phòng ban</label>
                    </div>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

            <div class="row">
                <div class="col-md-12">
                    <label for="head_of_department" data-error="wrong" data-success="right">Trưởng phòng</label>
                    <div class="md-form md-outline">
                        <select class="mdb-select md-form" name="head_of_department" id="head_of_department">
                            <?php
                            foreach ($staff_list as $s) {
                            ?>
                                <option value=<?= $s['id'] ?>><?= $s['fullname'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <button class="btn blue-gradient btn-rounded waves-effect waves-light">Thêm phòng ban</button>
                </div>
            </div>

        </div>
    </form>
</section>