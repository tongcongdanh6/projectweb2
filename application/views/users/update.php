<div class="container-fluid">
    <!-- Section: Inputs -->
    <form action="<?php echo base_url(); ?>users/do_update/<?php echo $data_needupdate['id']; ?>" method="post">
        
        <section class="section card mb-5">
            <h1 class="card-header primary-color white-text text-center">Update thông tin user</h1>
            <div class="card-body">
                <?=validation_errors('<div class="alert alert-warning">','</div>')?>
                <!-- Grid row -->
                <div class="row">

                    <!-- Grid column -->
                    <div class="col-md-12">

                        <div class="md-form md-outline">
                            <input type="text" name="staff_fullname" class="form-control" value="<?=$data_needupdate['fullname']?>">
                            <label for="staff_fullname" class="">Họ và tên nhân viên</label>
                        </div>

                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row -->
                <div class="row text-left">

                    <!-- Grid column -->
                    <div class="col-md-6 mb-4">

                        <!-- Email validation -->
                        <div class="md-form md-outline">
                            <i class="fas fa-envelope prefix"></i>
                            <input type="email" name="staff_email" class="form-control" value="<?=$data_needupdate['email']?>" required>
                            <label for="staff_email">Email</label>
                        </div>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-6 mb-4">

                        <!-- Password validation -->
                        <div class="md-form md-outline">
                            <i class="fas fa-lock prefix"></i>
                            <input type="password" name="staff_password" class="form-control validate" value="<?=$data_needupdate['password']?>" required>
                            <label for="staff_password" data-error="wrong" data-success="right" >Mật khẩu</label>
                        </div>

                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row -->


                <!-- Grid row -->
                <div class="row text-left">
                    <!-- Grid column -->
                    <div class="col-md-12 mb-4">
                        <label for="staff_department" data-error="wrong" data-success="right">Bộ phận (phòng)</label>
                        <select class="mdb-select md-form" name="staff_department" required>
                            <?php
                            foreach ($department_list as $value) {
                            ?>
                                <option value="<?=$value['slug']?>"><?=$value['name']?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->

                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="btn blue-gradient btn-rounded waves-effect waves-light">Update</button>
                    </div>
                </div>

            </div>

        </section>
        <!-- Section: Inputs -->
    </form>

</div>