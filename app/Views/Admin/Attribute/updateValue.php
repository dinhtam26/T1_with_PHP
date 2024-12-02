<section class="section-header">
    <h1>Update Value <?= $attribute['code'] ?></h1>
</section>
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

                    <div class="form-group m-4">
                        <button class="btn btn-primary">Update</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</section>