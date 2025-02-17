<!-- TitleTitle -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thương hiệu</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Quản lý thương hiệu</a>
                    </li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card" id="customerList">
            <div class="card-header border-bottom-dashed">

                <div class="row g-4 align-items-center">
                    <div class="col-sm">
                        <div>
                            <h5 class="card-title mb-0">Danh sách thương hiệu</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex flex-wrap align-items-start gap-2">
                            <button class="btn btn-soft-danger" id="remove-actions" onclick="deleteMultiple()" style="display:block"><i class="ri-delete-bin-2-line"></i></button>
                            <a class="btn btn-success add-btn" href="<?php ROOT_PATH ?>brand/create"><i class="ri-add-line align-bottom me-1"></i> Thêm thương hiệu mới</a>
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
                <div class="table-responsive mt-3">

                    <table class="table align-middle" id="customerTable">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" style="width: 50px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th class="sort" data-sort="id">ID</th>
                                <th class="sort" data-sort="name">Name</th>
                                <th class="sort" data-sort="description">Description</th>
                                <th class="sort" data-sort="public">Public</th>
                                <th class="sort" data-sort="feature">Feature</th>
                                <th class="sort" data-sort="action">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            <?php
                            if (!empty($listBrands)) {
                                foreach ($listBrands as $brand) {
                            ?>
                                    <tr id="item-<?= $brand->id ?>">
                                        <td scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                            </div>
                                        </td>
                                        <td><?= $brand->id ?></td>
                                        <td><?= $brand->name ?></td>
                                        <td><?= $brand->description ?></td>

                                        <td class="public">
                                            <div class="form-check form-switch form-switch-info form-switch-md mb-3">
                                                <input class="form-check-input" type="checkbox" name="public" value="<?= $brand->publish ?>" <?= ($brand->publish == 1) ? "checked" : ""  ?> onchange="changeStatus(<?php echo $brand->id; ?>, 'brand')">
                                            </div>
                                        </td>

                                        <td class="feature">
                                            <div class="form-check form-switch form-switch-info form-switch-md mb-3">
                                                <input class="form-check-input" type="checkbox" name="feature" value="<?= $brand->is_feature ?>" <?= ($brand->is_feature == 1) ? "checked" : ""  ?> onchange="changeStatusIsFeature(<?php echo $brand->id; ?>, 'brand')">
                                            </div>
                                        </td>



                                        <td class="text-center">
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item edit">
                                                    <a href="brand/<?= $brand->id ?>/edit" class="text-primary d-inline-block edit-item-btn">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="text-danger d-inline-block remove-item-btn delete_item" href="brand/<?= $brand->id ?>">
                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                            <?php

                                }
                            } else {
                                echo "No data";
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

</div>