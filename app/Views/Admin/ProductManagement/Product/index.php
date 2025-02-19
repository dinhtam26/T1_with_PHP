<!-- TitleTitle -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Sản phẩm</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Quản lý sản phẩm</a>
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
                            <h5 class="card-title mb-0">Danh sách sản phẩm</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="d-flex flex-wrap align-items-start gap-2">
                            <button class="btn btn-soft-danger" id="remove-actions" onclick="deleteMultiple()" style="display:block"><i class="ri-delete-bin-2-line"></i></button>
                            <a class="btn btn-success add-btn" href="<?php ROOT_PATH ?>product/create"><i class="ri-add-line align-bottom me-1"></i> Thêm sản phẩm mới</a>
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
                            <th>Tên sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Tổng tồn kho</th>
                            <th>Thương hiệu</th>
                            <th>Nhóm sản phẩm</th>
                            <th>Tình trạng</th>
                            <th style="width: 100%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        if (!empty($products)) {
                            foreach ($products as $product) {

                        ?>
                                <tr class="<?= $i % 2 == 0 ? "odd" : "even" ?>" id="item-<?= $product['product_id'] ?>">
                                    <th class="dtr-control" data-id="<?= $product['product_id'] ?>">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                        </div>
                                    </th>
                                    <td><a href="product/<?= $product['product_id'] ?>/edit"><?= $product['product_name'] ?> </a></td>
                                    <td><?= $product['product_type'] ?></td>
                                    <td><span class="badge bg-primary"><?= $product['total_stock'] ?></span></td>
                                    <td><?= $product['brand_name'] ?></td>
                                    <td>
                                        <?= $product['product_catalogue_name'] ?>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch form-switch-info form-switch-md ms-3">
                                            <input class="form-check-input" type="checkbox" name="publish" value="<?= $product['publish'] ?>" <?= ($product['publish'] == 1) ? "checked" : ""  ?> onchange="changeStatus(<?php echo $product['product_id']; ?>, 'product')">
                                        </div>
                                    </td>
                                    <td style="width: 100%">
                                        <table style="width: 1165px;" class="table table-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Tên sản phẩm</th>
                                                    <th scope="col">Tồn kho</th>
                                                    <th scope="col">Giá nhập</th>
                                                    <th scope="col">Giá bán</th>
                                                    <th scope="col">Giá khuyến mại</th>
                                                    <th scope="col">Giao hàng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // dd($product);
                                                foreach ($product['product_variants'] as $product_variant) {

                                                ?>
                                                    <tr>
                                                        <td>
                                                            <img src="<?= UPLOAD_URL .  "products/" . strtolower($product['product_catalogue_name']) . "/" . $product_variant['image'] ?>" alt="" class="avatar-md me-2">
                                                            <strong class="text-primary"><?= $product_variant['name'] ?></strong>
                                                        </td>
                                                        <td><span class="badge bg-primary"><?= $product_variant['stock'] ?></span></td>
                                                        <td><?= number_format($product_variant['cost_price'], 0, ',', '.') ?></td>
                                                        <td><?= number_format($product_variant['price'], 0, ',', '.') ?></td>
                                                        <td><?= number_format($product_variant['sale_price'], 0, ',', '.') ?></td>
                                                        <td>
                                                            <ul class="text-primary">
                                                                <li>Cân nặng: <b><?= $product_variant['weight'] ?></b></li>
                                                                <li>Dài: <b><?= $product_variant['length'] ?> cm</b></li>
                                                                <li>Cao: <b><?= $product_variant['width'] ?> cm</b></li>
                                                                <li>Rộng: <b><?= $product_variant['height'] ?> cm</b></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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