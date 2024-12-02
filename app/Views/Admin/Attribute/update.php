<section class="section-header">
    <h1>Update Attribute</h1>
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
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?= $attribute['description'] ?? "" ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</section>

<!-- Attribute -->

<section class="section-header">
    <h1>Create <?= $attribute['code'] ?? "" ?> value</h1>
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
                            <div class="form-group m-4">
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
                                    <th style="width: 15%">Name</th>
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
                                            <td class="d-flex justify-content-around">
                                                <a class="btn btn-outline-warning" href="<?= ROOT_URL ?>admin/attribute/value/<?= $value->id ?>/edit">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <a class="btn btn-outline-danger delete_item" href="<?= ROOT_URL ?>admin/attribute/value/<?= $value->id ?>">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
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