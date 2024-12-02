<section class="section-header">
    <h1>Create User</h1>
</section>
<section class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/userCatalogue" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group">
                            <div class="control-label">Publish</div>
                            <label class="custom-switch mt-2">
                                <input type="checkbox" name="publish" value="1" checked class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Active</span>
                            </label>
                        </div>

                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" name="description" value="<?= $data['password'] ?? "" ?>">
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>

                </div>
            </form>

        </div>
    </div>
</section>