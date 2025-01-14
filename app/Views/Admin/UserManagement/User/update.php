<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thêm mới người dùng</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Quản lý người dùng</a>
                    </li>
                    <li class="breadcrumb-item active">Thêm mới</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card" id="customerList">
            <div class="card-header">
                <a href="http://localhost/magento-ecommerce/admin/user" class="btn btn-light">Back</a>
            </div>
            <div class="card-body">


                <form name="form-submit" method="post" action="<?= ROOT_URL ?>admin/user/<?= $user['id'] ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="d-flex">
                            <div class="file-upload-container">
                                <input type="file" name="avatar" id="imageInput">
                                <label for="imageInput" class="file-upload-label">
                                    <i class="fas fa-upload"></i>
                                    <span>Ảnh đại diện</span>
                                </label>
                            </div>
                            <div style="margin-left:20px" id="preview">
                                <div class="image-container">
                                    <img src="<?= UPLOAD_URL . "user/" . $user['avatar'] ?>" alt="Preview">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- Full name -->
                            <div class="mt-3">
                                <label for="fullname" class="form-label">Full Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="fullname" id="fullname" value="<?= $user['fullname'] ?? "" ?>" placeholder="Full Name">
                                <div class="mt-1 text-danger">
                                    <?= $errors['fullname'][0] ?? "" ?>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" value="<?= $user['password'] ?? "" ?>" name="password" id="password">
                                <div id="passwordHelpBlock" class="form-text">
                                    Must be 8-20 characters long.
                                </div>
                                <div class="mt-1 text-danger">
                                    <?= $errors['password'][0] ?? "" ?>
                                </div>
                            </div>

                            <div class="mt-3">
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
                        </div>

                        <div class="col-6">
                            <div class="mt-3">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <div class="form-icon">
                                    <input type="email" class="form-control form-control-icon" name="email" id="email" value="<?= $user['email'] ?? "" ?>" placeholder="example@gmail.com">
                                    <i class="ri-mail-unread-line"></i>
                                </div>
                                <div class="mt-1 text-danger">
                                    <?= $errors['email'][0] ?? "" ?>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="<?= $user['phone'] ?? "" ?>" placeholder="Phone number">
                            </div>

                            <div class="mt-5">
                                <label for="" class="form-label">Status</label>
                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                    <input type="checkbox" class="form-check-input" name="publish" value="<?= $user['publish'] ?>" <?= ($user['publish'] == 1) ? "checked" : "" ?> id="publish">
                                    <label class="form-check-label" for="publish">Public</label>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary" id="submit-all">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<?php
