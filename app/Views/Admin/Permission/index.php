<!-- TitleTitle -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Phân quyền</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Quản lý phân quyền</a>
                    </li>
                    <li class="breadcrumb-item active">Danh sách phân quyền</li>
                </ol>
            </div>
        </div>
    </div>
</div>



<!-- Main content -->
<div class="row">
    <div class="col-lg-12">
        <div class="card" id="customerList">
            <div class="card-header border-bottom-dashed">

                <div class="row g-4 align-items-center">
                    <div class="col-sm">
                        <div>
                            <h5 class="card-title mb-0">Danh sách phân quyền</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex flex-wrap align-items-start gap-2">
                            <button class="btn btn-soft-danger" id="remove-actions" onclick="deleteMultiple()" style="display:block"><i class="ri-delete-bin-2-line"></i></button>
                            <a class="btn btn-success add-btn" href="<?php ROOT_PATH ?>permission/create"><i class="ri-add-line align-bottom me-1"></i>Thêm mới quyền</a>
                            <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> Import</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-bottom-dashed border-bottom">
                <form>
                    <div class="row g-3">
                        <!-- Search -->
                        <div class="col-xl-4">
                            <div class="search-box">
                                <input type="text" class="form-control search" placeholder="Search for customer, email, phone, status or something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="col-xl-8">
                            <div class="row g-3">
                                <div class="col-sm-3">
                                    <div>
                                        <select class="form-control" data-plugin="choices" data-choices="" data-choices-search-false="" name="choices-single-default" id="idStatus">
                                            <option value="">Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div>
                    <div class="table-responsive table-card mb-1">
                        <table class="table align-middle" id="customerTable">
                            <thead>
                                <tr role="row">
                                    <th class="sort"> ID</th>
                                    <th class="sort">Name</th>
                                    <th class="sort">Module</th>
                                    <th class="sort">Controller</th>
                                    <th class="sort">Action</th>
                                    <th class="sort"> Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                <?php
                                if (!empty($permissions)) {
                                    foreach ($permissions as $permission) {
                                ?>
                                        <tr>
                                            <td><?= $permission->id ?></td>
                                            <td><?= $permission->name ?></td>
                                            <td><?= $permission->module ?></td>
                                            <td><?= $permission->controller ?></td>
                                            <td><?= $permission->action ?></td>
                                            <td class="text-center">
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <li class="list-inline-item edit">
                                                        <a href="permission/<?= $permission->id ?>/edit" class="text-primary d-inline-block edit-item-btn">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="text-danger d-inline-block remove-item-btn delete_item" href="permission/<?= $permission->id  ?>">
                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0">We've searched more than 150+ customer We did not find any customer for you search.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Phân trang -->
                    <!-- <div class="d-flex justify-content-end">
                        <div class="pagination-wrap hstack gap-2" style="display: flex;">
                            <a class="page-item pagination-prev disabled" href="#">
                                Previous
                            </a>
                            <ul class="pagination listjs-pagination mb-0">
                                <li class="active"><a class="page" href="#" data-i="1" data-page="8">1</a></li>
                                <li><a class="page" href="#" data-i="2" data-page="8">2</a></li>
                            </ul>
                            <a class="page-item pagination-next" href="#">
                                Next
                            </a>
                        </div>
                    </div> -->
                    <!-- End phân trang  -->
                </div>
            </div>
        </div>

    </div>
    <!--end col-->
</div>