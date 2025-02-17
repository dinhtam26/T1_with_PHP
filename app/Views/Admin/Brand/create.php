<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thêm mới thương hiệu</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Quản lý thương hiệu</a>
                    </li>
                    <li class="breadcrumb-item active">Thêm mới</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-log-12">
        <div class="card">
            <div class="card-header">
                <a href="http://localhost/magento-ecommerce/admin/brand" class="btn btn-light">Back</a>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group mt-3">
                        <div class="d-flex">
                            <div class="file-upload-container">
                                <input type="file" name="image" id="imageInput">
                                <label for="imageInput" class="file-upload-label">
                                    <i class="fas fa-upload"></i>
                                    <span>Ảnh thương hiệu</span>
                                </label>
                            </div>
                            <div style="margin-left:20px" id="preview"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around">
                        <div class="form-group">
                            <div class="control-label">Publish</div>
                            <div class="form-check form-switch form-switch-info form-switch-md mb-3">
                                <input class="form-check-input" type="checkbox" name="public" value="1" checked>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="control-label">Feature</div>
                            <div class="form-check form-switch form-switch-info form-switch-md mb-3">
                                <input class="form-check-input" type="checkbox" name="is_feature" value="1" checked>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-4">
                                <label>Description</label>
                                <input type="text" class="form-control" name="description" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>