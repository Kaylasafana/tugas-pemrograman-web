<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    
    <ul class="nav menu">

        <!-- Dashboard -->
        <li>
            <a href="<?= base_url('admin/dashboard-admin'); ?>">
                <span class="glyphicon glyphicon-dashboard"></span> Dashboard
            </a>
        </li>

        <!-- Master Data Dropdown -->
        <li class="parent">

            <a href="#sub-item-master" data-toggle="collapse">
                <span class="glyphicon glyphicon-list"></span> 
                Master Data

                <span class="icon pull-right">
                    <em class="glyphicon glyphicon-s glyphicon-plus"></em>
                </span>
            </a>

            <ul class="children collapse" id="sub-item-master">

                <li>
                    <a href="<?= base_url('admin/master-data-admin'); ?>">
                        <span class="glyphicon glyphicon-folder-open"></span> 
                        Data Admin
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('admin/master-data-anggota'); ?>">
                        <span class="glyphicon glyphicon-user"></span> 
                        Data Anggota
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('admin/master-data-kategori'); ?>">
                        <span class="glyphicon glyphicon-tags"></span> 
                        Data Kategori
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('admin/master-data-rak'); ?>">
                        <span class="glyphicon glyphicon-th-large"></span> 
                        Data Rak
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('admin/master-data-buku'); ?>">
                        <span class="glyphicon glyphicon-book"></span> 
                        Data Buku
                    </a>
                </li>

            </ul>
        </li>

        <!-- Divider -->
        <li role="presentation" class="divider"></li>

        <!-- Logout -->
        <li>
            <a href="<?= base_url('admin/logout'); ?>">
                <span class="glyphicon glyphicon-log-out"></span> 
                Logout
            </a>
        </li>

    </ul>

    <div class="attribution">
        Template by 
        <a href="http://www.medialoot.com/item/lumino-admin-bootstrap-template/">
            Medialoot
        </a>
    </div>

</div>