<section class="section-header">
    <h1>Brands List</h1>
</section>

<section class="section-body">



    <div class="card" style="width: 100%">
        <div class="card-header">
            <div class="card-header d-flex justify-content-end">
                <a class="btn btn-primary" href="<?php ROOT_PATH ?>brand/create">Create Brand</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped dataTable no-footer" id="table-2" role="grid" aria-describedby="table-2_info" style="width: 100%">
                    <thead>
                        <tr role="row">
                            <th style="width: 5%">ID</th>
                            <th style="width: 15%">Name</th>
                            <th style="width: 15%">Description</th>
                            <th style="width: 10%">Public</th>
                            <th style="width: 10%">Feature</th>
                            <th style="width: 2%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($listBrands)) {
                            foreach ($listBrands as $brand) {
                        ?>
                                <tr id="item-<?= $brand->id ?>">
                                    <td><?= $brand->id ?></td>
                                    <td><?= $brand->name ?></td>
                                    <td><?= $brand->description ?></td>
                                    <td>
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="publish" value="<?= $brand->publish ?>" <?= ($brand->publish == 1) ? "checked" : ""  ?> class="custom-switch-input" onchange="changeStatus(<?php echo  $brand->id ?>, 'brand')">
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </td>

                                    <td>
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="publish" value="<?= $brand->is_feature ?>" <?= ($brand->is_feature == 1) ? "checked" : ""  ?> class="custom-switch-input" onchange="changeStatusIsFeature(<?php echo  $brand->id ?>, 'brand')">
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </td>

                                    <td class="d-flex justify-content-around">
                                        <a class="btn btn-outline-warning" href="brand/<?= $brand->id ?>/edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a class="btn btn-outline-danger delete_item" href="brand/<?= $brand->id ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php

                            }
                        } else {
                            echo "No data";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>