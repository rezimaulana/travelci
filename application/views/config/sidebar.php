<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gambar sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center text-white nav-link adeeva-link">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="far fa-snowflake"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Adeeva Tour</div>
            </a>

            <!-- QUERY MENU -->
            <?php
            $role_id = $this->session->userdata('role_id');
            $this->db->select('user_akses_menu.*,role,title,url,icon');
            $this->db->from('user_akses_menu');
            $this->db->join('user_menu', 'menu_id = user_menu.id');
            $this->db->join('user_role', 'role_id = user_role.id');
            $this->db->where(['role_id' => $role_id]);
            $this->db->order_by('menu_id', 'ASC');
            $menu = $this->db->get()->result_array();
            ?>


            <?php foreach ($menu as $menu) : ?>
                <!-- Nav Item - Home -->
                <?php if ($menu['title'] != '') { ?>
                    <li class="nav-item">
                        <a class="nav-link adeeva-link" href="<?= base_url($menu['url']) ?>">
                            <i class="<?= $menu['icon'] ?>"></i>
                            <span><?= $menu['title'] ?></span></a>
                    </li>
                <?php } ?>

            <?php endforeach; ?>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link adeeva-link" href="<?= base_url('auth/logout'); ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->