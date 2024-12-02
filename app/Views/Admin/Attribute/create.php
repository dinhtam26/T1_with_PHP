<section class="section-header">
    <h1>Create Attribute</h1>
</section>
<section class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/attribute" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label>Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="<?= $data['name'] ?? "" ?>">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label>Code<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code" value="<?= $data['code'] ?? "" ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?= $data['description'] ?? "" ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>

        </div>
    </div>
</section>