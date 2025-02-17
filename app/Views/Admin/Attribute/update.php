<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Chỉnh sửa thuộc tính</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Quản lý thuộc tính</a>
                    </li>
                    <li class="breadcrumb-item active">Chỉnh sửa</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/attribute" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row mt-3">
                    <div class="col-8">
                        <div class="form-group">
                            <label>Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="<?= $attribute['name'] ?? "" ?>">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label>Code<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code" value="<?= $attribute['code'] ?? "" ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label>Description</label>
                    <textarea name="description" rows="5" class="form-control"><?= $attribute['description'] ?? "" ?></textarea>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</section>

<!-- Attribute -->

<section class="section-header">
    <h2>Giá trị thuộc tính <span class="text-danger"><?= $attribute['name'] ?? "" ?></span></h2>
</section>
<section class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/attribute" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    <form method="post" action="<?= ROOT_URL ?>admin/attribute/value/store" enctype="multipart/form-data">
                        <div class="d-flex align-items-center justify-content-between">

                            <div class="form-group" style="width:350px">
                                <label>Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Ghi <?= strtolower($attribute['name'])   ?> muốn thêm">
                            </div>

                            <input type="hidden" name="attribute_id" value="<?= $attribute['id'] ?>">
                            <div class="form-group mt-4">
                                <button class="btn btn-primary">Create</button>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="col-7">
                    <div class="table-responsive">
                        <table class="table table-striped dataTable no-footer" id="table-2" role="grid" aria-describedby="table-2_info" style="width: 100%">
                            <thead>
                                <tr role="row">
                                    <th style="width: 2%">ID</th>
                                    <th style="width: 15%"><?= $attribute['name'] ?? "" ?></th>
                                    <th style="width: 0.5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (!empty($attribute_value)) {
                                    foreach ($attribute_value as $value) {
                                ?>
                                        <tr id="item-<?= $value->id ?>" class="even">
                                            <td><?= $value->id ?></td>
                                            <td><?= $value->name ?></td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <li class="list-inline-item edit">
                                                        <a href="<?= ROOT_URL ?>admin/attribute/value/<?= $value->id ?>/edit" class="text-primary d-inline-block edit-item-btn">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class="text-danger d-inline-block remove-item-btn delete_item" href="<?= ROOT_URL ?>admin/attribute/value/<?= $value->id ?>">
                                                            <i class="ri-delete-bin-5-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                </ul>

                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>



    </div>
    </div>
</section>