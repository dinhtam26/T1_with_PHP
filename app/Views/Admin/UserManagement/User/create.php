<section class="section-header">
    <h1>Create User</h1>
</section>
<section class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/user" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="fullname" value="<?= $data['fullname'] ?? "" ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Avatar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>



                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="user_catalogue_id">
                                <?php
                                foreach ($userCatalogues as $key => $userCatalogue) {
                                ?>
                                    <option <?= ($userCatalogue->code == "member") ? "selected" : "" ?> value="<?= $userCatalogue->id ?>"><?= $userCatalogue->name ?></option>
                                <?php
                                }
                                ?>
                            </select>
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
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" value="<?= $data['email'] ?? "" ?>">
                        </div>

                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" value="<?= $data['password'] ?? "" ?>">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" value="<?= $data['phone'] ?? "" ?>">
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