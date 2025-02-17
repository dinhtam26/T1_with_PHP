<!-- TitleTitle -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thuộc tính</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Quản lý thuộc tính</a>
                    </li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
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
                            <a class="btn btn-success add-btn" href="<?php ROOT_PATH ?>attribute/create"><i class="ri-add-line align-bottom me-1"></i> Thêm thuộc tính mới</a>
                            <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> Import</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-bottom-dashed border-bottom">

                <form>
                    <div class="row g-3 mb-3">
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
                <!--  -->
                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline collapsed mt-3" style="width: 100%;" aria-describedby="example_info">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 16.8px;" class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="
                                            
                                                
                                            
                                        : activate to sort column ascending">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                </div>
                            </th>
                            <th style="width: 20%;">ID</th>
                            <th style="width: 20%;">Name</th>
                            <th style="width: 20%;">Code</th>
                            <th style="width: 20%;">Description</th>
                            <th style="width: 300px">Action</th>
                            <th>Giá trị thuộc tính</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        if (!empty($listAttributes)) {
                            foreach ($listAttributes as $attribute) {
                        ?>
                                <tr class="<?= $i % 2 == 0 ? "odd" : "even" ?>" id="item-<?= $attribute->id ?>">
                                    <th class="dtr-control" data-id="<?= $attribute->id ?>">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                        </div>
                                    </th>
                                    <td><?= $attribute->id ?></td>
                                    <td><a href="attribute/<?= $attribute->id ?>/edit"><?= $attribute->name ?></a></td>
                                    <td><?= $attribute->code ?></td>
                                    <td><?= $attribute->description ?></td>
                                    <td>
                                        <ul class="list-inline hstack gap-2 mb-0">
                                            <li class="list-inline-item edit">
                                                <a href="attribute/<?= $attribute->id ?>/edit" class="text-primary d-inline-block edit-item-btn">
                                                    <i class="ri-pencil-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="text-danger d-inline-block remove-item-btn delete_item" href="attribute/<?= $attribute->id ?>">
                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <span style="width: 900px;display: inline-block;" class="attribute-value-<?= $attribute->id ?>" id="<?= $attribute->id ?>-kkk"></span>
                                    </td>
                                </tr>
                        <?php
                                # code...
                                $i++;
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>