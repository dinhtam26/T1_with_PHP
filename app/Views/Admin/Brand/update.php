<section class="section-header">
    <h1>Update Brand</h1>
</section>
<section class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/brand" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="<?= $data['name'] ?? "" ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>

                        <?php
                        if (!empty($data['image'])) {
                        ?>
                            <figure class="avatar mr-2 avatar-xl">
                                <img style="" src="<?= UPLOAD_URL . "brands/" . $data['image'] ?>" alt="...">
                            </figure>

                        <?php
                        }
                        ?>

                    </div>

                    <div class="col-6">
                        <div class="form-group mb-4">
                            <label>Description</label>
                            <input type="text" class="form-control" name="description" value="<?= $data['description'] ?? "" ?>">
                        </div>

                        <div class="d-flex justify-content-around">
                            <div class="form-group">
                                <div class="control-label">Publish</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="publish" value="<?= $data['publish'] ?>" <?= ($data['publish'] == 1) ? "checked" : "" ?> class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Active</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <div class="control-label">Feature</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="is_feature" value="<?= $data['is_feature'] ?>" <?= ($data['is_feature'] == 1) ? "checked" : "" ?> class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Active</span>
                                </label>
                            </div>
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
<?php
