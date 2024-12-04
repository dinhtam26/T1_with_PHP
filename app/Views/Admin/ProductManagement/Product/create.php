<section class="section" style="height:1500px">
    <div class="section-header">
        <h1>Create Product</h1>
    </div>

    <div class="section-body">
        <h2 class="section-title">Create Product</h2>
        <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p>

        <form action="" method="post">
            <div class="row">
                <div class="col-12 col-md-9 col-lg-9">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="form-group ">
                                <label class="">Description</label>
                                <div class="">
                                    <textarea class="summernote" style="display: none;"></textarea>
                                    <div class="note-editor note-frame card">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex ">

                            <h4 class=""> Product data</h4>

                            <select style="width: 300px;" class="form-control" name="user_catalogue_id">
                                <option value="">Simple product</option>
                                <option value="">Variant product</option>
                            </select>

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-3">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link  active show" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="false">Chung</a>
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
                                            <a class="nav-link" id="product_variants-tab4" data-toggle="tab" href="#product_variants4" role="tab" aria-controls="product_variants" aria-selected="true">Sản phẩm biến thể</a>
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
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Giá so sánh</label>
                                                        <input type="text" class="form-control" placeholder="Nhập giá so sánh với giá vốn">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Giá vốn</label>
                                                        <input type="text" class="form-control">
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
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Số lượng</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="">Ngưỡng tồn kho thấp</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Shipping -->
                                        <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">

                                            <div class="d-flex justify-content-around align-items-center">
                                                <label for="">Cân nặng (g)</label>
                                                <input style="width: 520px" type="text" class="form-control">
                                            </div>

                                            <div class="d-flex justify-content-around align-items-center mt-5">
                                                <label for="">Kích thước (cm)</label>
                                                <div style="width: 520px">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="Length">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="Width">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="Height">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label style="margin-right: 15px">Shipping class</label>
                                                <select style="width: 520px;" class="form-control select2" multiple="" tabindex="1" aria-hidden="false" aria-placeholder="Chosse class shipping">
                                                    <option>Option 1</option>
                                                </select>
                                            </div>


                                        </div>
                                        <!-- Thuộc tính -->
                                        <div class="tab-pane fade" id="attribute4" role="tabpanel" aria-labelledby="attribute-tab4">
                                            <p>Chọn thuộc tính</p>


                                            <div class="form-group">
                                                <label>Thuộc tính</label>
                                                <select style="width: 250px;" class="form-control select2 " tabindex="-1" aria-hidden="true">
                                                    <option>Option 1</option>
                                                    <option>Option 2</option>
                                                    <option>Option 3</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label style="margin-right: 15px">Option 1</label>
                                                <select style="width: 520px;" class="form-control select2" multiple="" tabindex="1" aria-hidden="false" aria-placeholder="Chosse class shipping">
                                                    <!-- <option value="" disabled selected>Chọn một tùy chọn</option> -->
                                                    <option>Option 2</option>
                                                    <option>Option 3</option>
                                                    <option>Option 4</option>
                                                    <option>Option 5</option>
                                                    <option>Option 6</option>
                                                    <option>Option 7</option>
                                                    <option>Option 8</option>
                                                    <option>Option 9</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Thuộc tính -->
                                        <div class="tab-pane fade" id="product_variants4" role="tabpanel" aria-labelledby="product_variants-tab4">

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
                        </div>
                        <div class="card-body">
                            <div class="form-group dropzone dz-clickable" id="mydropzone">
                                <label for="">Ablum</label>
                                <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                            </div>
                            <div class="form-group">
                                <label>Thương hiệu</label>
                                <select class="form-control select2 " tabindex="-1" aria-hidden="true">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <select class="form-control select2 " tabindex="-1" aria-hidden="true">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>