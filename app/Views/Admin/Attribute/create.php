<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thêm mới thuộc tính</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Quản lý thuộc tính</a>
                    </li>
                    <li class="breadcrumb-item active">Thêm mới</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/attribute" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row mt-3">
                    <div class="col-8">
                        <div class="form-group">
                            <label>Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Nhập tên thuộc tính" value="<?= $data['name'] ?? "" ?>">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label>Code<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Nhập mã thuộc tính. Nếu không nhập thì theo tên thuộc tính" name="code" value="<?= $data['code'] ?? "" ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" placeholder="Mô tả thuộc tính" rows="5" id=""><?= $data['description'] ?? "" ?></textarea>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>

        </div>
    </div>
</div>