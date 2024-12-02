<section class="section-header">
    <h1>Product Catalogue List</h1>
</section>

<section class="section-body">



    <div class="card" style="width: 100%">
        <div class="card-header">
            <div class="card-header d-flex justify-content-end">
                <a class="btn btn-primary" href="<?php ROOT_PATH ?>productCatalogue/create">Create Catalogue</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped dataTable no-footer" id="table-2" role="grid" aria-describedby="table-2_info" style="width: 100%">
                    <thead>
                        <tr role="row">
                            <th style="width: 5%">ID</th>
                            <th style="width: 15%">Name</th>
                            <th style="width: 15%">Image</th>
                            <th style="width: 15%">Order</th>
                            <th style="width: 15%">Parent_id</th>
                            <th style="width: 10%">Public</th>
                            <th style="width: 10%">Feature</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        if (!empty($listProductCatalogue)) {
                            foreach ($listProductCatalogue as $productCatalogue) {

                        ?>
                                <tr id="item-<?= $productCatalogue->id ?>">
                                    <td><?= $productCatalogue->id ?></td>
                                    <td><?= $productCatalogue->name ?></td>
                                    <td>
                                        <?php
                                        if (!empty($productCatalogue->image)) {

                                        ?>
                                            <img width="100px" src="<?= UPLOAD_URL . "productCatalogue/" . $productCatalogue->image ?>" alt="...">
                                        <?php
                                        }
                                        ?>

                                    </td>
                                    <td><?= $productCatalogue->order ?></td>
                                    <td><?= $productCatalogue->parent_id ?></td>
                                    <td>
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="publish" value="<?= $productCatalogue->publish ?>" <?= $productCatalogue->publish == 1 ? "checked" : "" ?> class="custom-switch-input" onchange="changeStatus(<?= $productCatalogue->id ?>, 'productCatalogue')">
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </td>

                                    <td>
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="publish" value="<?= $productCatalogue->is_feature ?>" <?= $productCatalogue->is_feature == 1 ? "checked" : "" ?> class="custom-switch-input" onchange="changeStatusIsFeature(<?= $productCatalogue->id ?>, 'productCatalogue')">
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </td>

                                    <td class="d-flex justify-content-around">
                                        <a class="btn btn-outline-warning" href="productCatalogue/<?= $productCatalogue->id ?>/edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a class="btn btn-outline-danger delete_item" href="productCatalogue/<?= $productCatalogue->id ?>">
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

</section>
<?php
