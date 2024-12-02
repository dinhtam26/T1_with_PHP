<section class="section-header">
    <h1>Create User</h1>
</section>
<section class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/userCatalogue" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">
            <form action="<?= ROOT_URL ?>admin/userCatalogue/<?= $userCatalogue['id'] ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?= $userCatalogue['name'] ?? "" ?>">
                        </div>
                        <div class="form-group">
                            <div class="control-label">Publish</div>
                            <label class="custom-switch mt-2">
                                <input type="checkbox" name="publish" value="<?= $userCatalogue['publish'] ?>" <?= ($userCatalogue['publish'] == 1) ? "checked" : "" ?> class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description"></span>
                            </label>
                        </div>

                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" name="description" value="<?= $userCatalogue['description'] ?? "" ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</section>