<section class="section-header">
    <h1>Update User</h1>

</section>
<section class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/user" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">
            <form action="<?= ROOT_URL ?>admin/user/<?= $user['id'] ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="fullname" value="<?= $user['fullname'] ?? "" ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Avatar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <?php
                            if (!empty($user['avatar'])) {
                            ?>
                                <figure class="avatar mr-2 avatar-xl">
                                    <img style="object-fit: cover; width=100%" src="<?= UPLOAD_URL . "user/" . $user['avatar'] ?>" alt="...">
                                </figure>

                            <?php
                            }
                            ?>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="user_catalogue_id">
                                <?php
                                foreach ($userCatalogues as $key => $userCatalogue) {
                                ?>
                                    <option value="<?= $userCatalogue->id ?>"
                                        <?= ($userCatalogue->id == $user['user_catalogue_id']) ?  "selected" : "" ?>>
                                        <?= $userCatalogue->name ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="control-label">Publish</div>
                            <label class="custom-switch mt-2">
                                <input type="checkbox" name="publish" value="<?= $user['publish'] ?>" <?= ($user['publish'] == 1) ? "checked" : "" ?> class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Active</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" value="<?= $user['email'] ?? "" ?>">
                        </div>

                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" value="<?= $user['password'] ?? "" ?>">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" value="<?= $user['phone'] ?? "" ?>">
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
// dd($this);
