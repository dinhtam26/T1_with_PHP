<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Chỉnh sửa giá trị của thuộc tính <span> <?= $attribute['name'] ?></span></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Quản lý thuộc tính</a>
                    </li>
                    <li class="breadcrumb-item active">Chỉnh sửa giá trị thuộc tính</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/attribute/<?= $attribute_value['attribute_id'] ?>/edit" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="d-flex align-items-center ">

                    <div class="form-group" style="width:500px">
                        <label>Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="" value="<?= $attribute_value['name'] ?>">
                    </div>

                </div>

                <div class="form-group mt-3">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</section>