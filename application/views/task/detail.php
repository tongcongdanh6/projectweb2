<section>
    <h3 class="mb-4 dark-grey-text font-weight-bold"><strong>Chi tiết công việc</strong></h3>

    <div class="row mb-5">

        <!-- Grid column -->
        <div class="col-lg-12 col-md-12 mb-4">

            <!-- Card -->
            <div class="card card-cascade">

                <!-- Card image -->
                <div class="view view-cascade gradient-card-header blue-gradient">
                    <h2 class="card-header-title"><?=$task_data[0]['title']?></h2>
                    <p>Mã số công việc: <?=$task_data[0]['id']?></p>
                </div>
                <!-- Card image -->

                <!-- Card content -->
                <div class="card-body card-body-cascade text-center">

                    <p class="card-text pb-2"><?=$task_data[0]['content']?>
                    </p>
                    <hr>
                    <!-- Twitter -->
                    <a class="p-2 m-2 fa-lg tw-ic"><i class="fab fa-twitter"> </i></a>
                    <!-- Linkedin -->
                    <a class="p-2 m-2 fa-lg li-ic"><i class="fab fa-linkedin-in"> </i></a>
                    <!-- Facebook -->
                    <a class="p-2 m-2 fa-lg fb-ic"><i class="fab fa-facebook-f"> </i></a>
                    <!-- Email -->
                    <a class="p-2 m-2 fa-lg email-ic"><i class="fas fa-envelope"> </i></a>
                </div>
                <!-- Card content -->

            </div>
            <!-- Card -->

        </div>
        <!-- Grid column -->

    </div>

</section>