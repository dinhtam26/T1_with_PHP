<section class="section-header">
    <h1>Create Product Catalogue</h1>
</section>
<section class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/productCatalogue" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">

                        <div class="form-group">
                            <div class="control-label">Publish</div>
                            <label class="custom-switch mt-2">
                                <input type="checkbox" name="publish" value="<?= $productCatalogue['publish'] ?>" <?= ($productCatalogue['publish'] == 1) ? "checked" : "" ?> class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Active</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="<?= $productCatalogue['name'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Order</label>
                            <input type="text" class="form-control" name="order" value="<?= $productCatalogue['order'] ?>" placeholder="Điền số để sắp xếp vị trí">
                        </div>
                    </div>

                    <div class="col-6">

                        <div class="form-group">
                            <div class="control-label">Feature</div>
                            <label class="custom-switch mt-2">
                                <input type="checkbox" name="is_feature" value="<?= $productCatalogue['is_feature'] ?>" <?= ($productCatalogue['is_feature'] == 1) ? "checked" : "" ?> class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Active</span>
                            </label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <label for="">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="image">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>

                            <img width="100px" src="<?= UPLOAD_URL . "productCatalogue/" . $productCatalogue['image'] ?>" alt="...">
                        </div>

                        <div class="form-group">
                            <label>Parent_id</label>
                            <select class="form-control" name="parent_id">
                                <option value="">Chọn danh mục cha (Có thể để trống)</option>
                                <?php
                                if (!empty($parentCatalogue)) {
                                    foreach ($parentCatalogue as $catalogue) {
                                ?>
                                        <option value="<?= $catalogue->id ?>"
                                            <?= ($productCatalogue['parent_id'] == $catalogue->id ? "selected" : "") ?>><?= $catalogue->name ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <div class="col-sm-12">
                        <textarea class="summernote-simple" style="display: none;" name="description"><?= $productCatalogue['description'] ?></textarea>
                        <div class="note-editor note-frame card">
                            <div class="note-dropzone">
                                <div class="note-dropzone-message"></div>
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
