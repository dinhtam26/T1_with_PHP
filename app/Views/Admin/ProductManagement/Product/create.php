<section class="section" style="height:1500px">
    <div class="section-header">
        <h1>Tạo mới sản phẩm</h1>
    </div>

    <div class="section-body">
        <h2 class="section-title">Tạo mới sản phẩm</h2>
        <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p>

        <form id="uploadForm" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-md-9 col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tiêu đề sản phẩm</label>
                                <input type="text" class="form-control" name="name" placeholder="Tiêu đề sản phẩm">
                            </div>

                            <div class="form-group ">
                                <label class="">Mô tả sản phẩm</label>
                                <div class="">
                                    <textarea class="summernote" style="display: none;" name="description"></textarea>
                                    <div class="note-editor note-frame card"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Ảnh album sản phẩm</h4>
                        </div>
                        <div class="card-body">
                            <div style=" display: flex;flex-direction: column;margin-bottom: 20px;" class="form-group">
                                <label for="album">Ảnh sản phẩm</label>
                                <input type="file" id="album" name="album[]" multiple style="display: block; width: 100%;max-width: 400px;padding: 10px;font-size: 14px;border: 1px solid #ccc;border-radius: 4px;background-color: #f9f9f9;color: #555;cursor: pointer;" />
                            </div>

                            <div class="d-flex g-2" id="preview-area">
                                <!-- <h3>Selected Images:</h3> -->
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex ">
                            <h4 class="">Dữ liệu sản phẩm</h4>
                            <select style="width: 300px;" class="form-control" name="type">
                                <option value="simple">Sản phẩm đơn giản</option>
                                <option value="variant">Sản phẩm biến thể</option>
                            </select>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-3">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active show" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="false">Chung</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">Hàng tồn kho</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="true">Shipping</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="attribute-tab4" data-toggle="tab" href="#attribute4" role="tab" aria-controls="attribute" aria-selected="true">Thuộc tính</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" style="display:none" id="product_variants-tab4" data-toggle="tab" href="#product_variants4" role="tab" aria-controls="product_variants" aria-selected="true">Sản phẩm biến thể</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-9">
                                    <div class="tab-content no-padding" id="myTab2Content">
                                        <!-- Chung -->
                                        <div class="tab-pane fade  active show" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                                            <p class="text-danger">Chú ý: <span class="text-danger">Nhập giá VND</span></p>
                                            <h5>Thông tin giá</h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Giá bán</label>
                                                        <input type="text" class="form-control" name="price">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Giá sale</label>
                                                        <input type="text" class="form-control" placeholder="Nhập giá so sánh với giá vốn" name="sale_price">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Giá vốn</label>
                                                        <input type="text" class="form-control" name="cost_price">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Hàng tồn kho -->
                                        <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Sku</label>
                                                        <input type="text" class="form-control" name="sku">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Số lượng</label>
                                                        <input type="text" class="form-control" name="stock">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Ngưỡng tồn kho thấp</label>
                                                        <input type="text" class="form-control" name="low_stock_amount">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Shipping -->
                                        <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">

                                            <div class="d-flex justify-content-around align-items-center">
                                                <label for="">Cân nặng (g)</label>
                                                <input style="width: 520px" type="text" class="form-control" name="weight">
                                            </div>

                                            <div class="d-flex justify-content-around align-items-center mt-5">
                                                <label for="">Kích thước (cm)</label>
                                                <div style="width: 520px">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="Length" name="length">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="Width" name="width">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="Height" name="height">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label style="margin-right: 15px">Shipping class</label>
                                                <select name="shipping_ids[]" style="width: 520px;" class="form-control select2" multiple="" tabindex="1" aria-hidden="false" aria-placeholder="Chosse class shipping">
                                                    <option>Option 1</option>
                                                </select>
                                            </div>


                                        </div>
                                        <!-- Thuộc tính -->
                                        <div class="tab-pane fade" id="attribute4" role="tabpanel" aria-labelledby="attribute-tab4">
                                            <p>Chọn thuộc tính</p>
                                            <div class="form-group">
                                                <label style="margin-right: 15px; color: red">Thuộc tính</label>
                                                <select style="width: 520px;" name="attribute" class="form-control select2 attribute_select" multiple="" tabindex="1" aria-hidden="false" aria-placeholder="Chosse class shipping">
                                                    <?php
                                                    if (!empty($attributeList)) {
                                                        foreach ($attributeList as $attribute) {
                                                    ?>
                                                            <option value="<?= $attribute->id ?>"><?= $attribute->name ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <p>Chọn giá trị cho thuộc tính</p>
                                            <div id="attribute_values"></div>
                                            <span style="cursor: no-drop; display:none" class="btn btn-secondary save_attribute">Lưu thuộc tính</span>
                                        </div>
                                        <!-- Product Variant -->
                                        <div class="tab-pane fade" id="product_variants4" role="tabpanel" aria-labelledby="product_variants-tab4">
                                            <span style="pointer-events: none; cursor: not-allowed; color: gray; text-decoration: none; background:#e3dcdc;" class="btn" id="generateProductVariant">Tạo sản phẩm biến thể</span>
                                            <div id="accordion">
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-group">
                                <label for="album">Ảnh sản phẩm</label>
                                <input type="file" name="image" id="image" />
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="image-preview-area">
                                <!-- <h3>Selected Images:</h3> -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Thương hiệu</label>
                                <select name="brand_id" class="form-control select2 " tabindex="-1" aria-hidden="true">
                                    <option value="">Chọn thương hiệu</option>
                                    <?php
                                    if (!empty($brandList)) {
                                        foreach ($brandList as $brand) {
                                    ?>
                                            <option value="<?= $brand->id ?>"><?= $brand->name ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <select name="product_catalogue_id" class="form-control select2 " tabindex="-1" aria-hidden="true">
                                    <option value="">Chọn loại sản phẩm</option>
                                    <?php
                                    if (!empty($productCatalogueList)) {
                                        foreach ($productCatalogueList as $productCatalogue) {
                                            # code... 
                                    ?>
                                            <option value="<?= $productCatalogue->id ?>"><?= $productCatalogue->name ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               
            </div>








            <div class="form-group">
                <button class="btn btn-primary btn-submit" type="submit">Create</button>
            </div>
        </form>
    </div>


   
  
</section>