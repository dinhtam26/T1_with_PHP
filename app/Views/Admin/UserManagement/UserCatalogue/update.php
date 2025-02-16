<!-- <section class="section-header">
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
</section> -->

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Chỉnh sửa nhóm người dùng</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Quản lý nhóm người dùng</a>
                    </li>
                    <li class="breadcrumb-item active">Chỉnh sửa</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card" id="customerList">
            <div class="card-header">
                <a href="http://localhost/magento-ecommerce/admin/userCatalogue" class="btn btn-light">Back</a>
            </div>
            <div class="card-body">
                <form name="form-submit" action="<?= ROOT_URL ?>admin/userCatalogue/<?= $userCatalogue['id'] ?>" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-6">
                            <!-- Full name -->
                            <div class="mt-3">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="<?= $userCatalogue['name'] ?? "" ?>">
                            </div>

                            <div class="mt-3">
                                <label for="" class="form-label">Status</label>
                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                    <input type="checkbox" class="form-check-input" name="publish" value="<?= $userCatalogue['publish'] ?>" <?= ($userCatalogue['publish'] == 1) ? "checked" : "" ?> id="publish">
                                    <label class="form-check-label" for="publish">Public</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mt-3"> <label>Description</label>
                                <textarea name="description" class="form-control" rows="5" id=""><?= $userCatalogue['description'] ?? "" ?></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary" id="submit-all">Chỉnh sửa</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!--end col-->
</div>