<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <!-- Dashboard -->
            <li class="menu-header">Dashboard</li>
            <li class="active">
                <a class="nav-link" href="<?= ROOT_URL ?>admin"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>


            <li class="menu-header">Starter</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>User Management</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= ROOT_URL ?>admin/user">User</a></li>
                    <li><a class="nav-link" href="<?= ROOT_URL ?>admin/userCatalogue">User Catalogue</a></li>
                    <li><a class="nav-link" href="<?= ROOT_URL ?>admin/permission">Permission</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Quản lý sản phẩm</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= ROOT_URL ?>admin/brand">Thương hiệu</a></li>
                    <li><a class="nav-link" href="<?= ROOT_URL ?>admin/productCatalogue">Danh mục</a></li>
                    <li><a class="nav-link" href="<?= ROOT_URL ?>admin/attribute">Thuộc tính</a></li>
                    <li><a class="nav-link" href="<?= ROOT_URL ?>admin/attribute">Sản phẩm</a></li>

                </ul>
            </li>
            <!-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
            <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li> -->
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <!-- <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a> -->
        </div>
    </aside>
</div>