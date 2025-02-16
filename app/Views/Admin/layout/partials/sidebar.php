<!-- <div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
        
            <li class="menu-header">Dashboard</li>
            <li class="active">
               <a class="nav-link" href="admin"><i class="fas fa-fire"></i> <span>Dashboard</span></a> 
</li>


<li class="menu-header">Starter</li>
<li class="dropdown">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>User Management</span></a>
    <ul class="dropdown-menu">
        <li><a class="nav-link" href="admin/user">User</a></li> 
        <li><a class="nav-link" href="admin/userCatalogue">User Catalogue</a></li> 
        <li><a class="nav-link" href="admin/permission">Permission</a></li> 
    </ul>
</li>

<li class="dropdown">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Quản lý sản phẩm</span></a>
    <ul class="dropdown-menu">
         <li><a class="nav-link" href="admin/brand">Thương hiệu</a></li> 
         <li><a class="nav-link" href="admin/productCatalogue">Danh mục</a></li> 
         <li><a class="nav-link" href="admin/attribute">Thuộc tính</a></li> 
         <li><a class="nav-link" href="admin/product">Sản phẩm</a></li> 

    </ul>
</li>
 <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
            <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li> 
</ul>

<div class="mt-4 mb-4 p-3 hide-sidebar-mini">

</div>
</aside>
</div> -->

<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22" />
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="17" />
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22" />
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="17" />
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title">
                    <span data-key="t-menu">Menu</span>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link menu-link"
                        href="#sidebarUser"
                        data-bs-toggle="collapse"
                        role="button"
                        aria-expanded="false"
                        aria-controls="sidebarUser">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-user">Quản lý người dùng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarUser">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= ROOT_URL ?>admin/userCatalogue" class="nav-link"> Nhóm người dùng </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ROOT_URL ?>admin/user" class="nav-link"> Người dùng </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ROOT_URL ?>admin/permission" class="nav-link"> Phân quyền </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a
                        class="nav-link menu-link"
                        href="#sidebarDashboards"
                        data-bs-toggle="collapse"
                        role="button"
                        aria-expanded="false"
                        aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Quản lý sản phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= ROOT_URL ?>admin/product" class="nav-link"> Sản phẩm </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ROOT_URL ?>admin/brand" class="nav-link"> Thương hiệu </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ROOT_URL ?>admin/attribute" class="nav-link"> Thuộc tính </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>