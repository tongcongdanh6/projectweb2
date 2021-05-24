        <!-- Side navigation links -->
        <li>
            <ul class="collapsible collapsible-accordion">

                <li>
                    <a class="waves-effect arrow-r" href="<?= base_url() ?>dashboard">
                        <i class="w-fa fas fa-tachometer-alt"></i>Bảng điều khiển</i>
                    </a>
                </li>
                <?php
                if (intval($this->session->userdata('role')) === 1) {
                ?>
                    <li>
                        <a class="collapsible-header waves-effect arrow-r">
                            <i class="w-fa fas fa-user"></i>Người dùng<i class="fas fa-angle-down rotate-icon"></i>
                        </a>
                        <div class="collapsible-body">
                            <ul>
                                <li>
                                    <a href="<?= base_url() ?>users/add" class="waves-effect"><i class="fas fa-plus"></i>Thêm người dùng</a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>users" class="waves-effect"><i class="fas fa-list-ul"></i>Quản lý người dùng</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                <?php
                }
                ?>
                <li>
                    <a class="collapsible-header waves-effect arrow-r">
                        <i class="w-fa fas fa-table"></i>Công việc<i class="fas fa-angle-down rotate-icon"></i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <?php
                                if (intval($this->session->userdata("role")) == 1 || intval($this->session->userdata("position")) == 1) {
                            ?>
                                <li>
                                    <a href="<?= base_url() ?>task/add" class="waves-effect"><i class="fas fa-plus"></i>Thêm công việc</a>
                                </li>
                            <?php
                            }
                            ?>
                            <li>
                                <a href="<?= base_url() ?>task" class="waves-effect"><i class="fas fa-list-ul"></i>Danh sách công việc</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php
                if (intval($this->session->userdata('role')) === 1) {
                ?>
                    <li>
                        <a class="collapsible-header waves-effect arrow-r">
                            <i class="w-fa fas fa-table"></i>Phòng ban<i class="fas fa-angle-down rotate-icon"></i>
                        </a>
                        <div class="collapsible-body">
                            <ul>
                                <li>
                                    <a href="<?= base_url() ?>department/add" class="waves-effect"><i class="fas fa-plus"></i>Thêm phòng ban</a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>department" class="waves-effect"><i class="fas fa-list-ul"></i>Danh sách phòng ban</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                <?php
                }
                ?>
            </ul>
        </li>
        <!-- Side navigation links -->