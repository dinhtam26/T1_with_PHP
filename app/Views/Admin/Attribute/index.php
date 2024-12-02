<section class="section-header">
    <h1>Attribute List</h1>
</section>

<section class="section-body">
    <div class="card" style="width: 100%">
        <div class="card-header">
            <div class="card-header d-flex justify-content-end">
                <a class="btn btn-primary" href="<?php ROOT_PATH ?>attribute/create">Create Attribute</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped dataTable no-footer" id="table-2" role="grid" aria-describedby="table-2_info" style="width: 100%">
                    <thead>
                        <tr role="row">
                            <th style="width: 2%">ID</th>
                            <th style="width: 15%">Name</th>
                            <th style="width: 15%">Code</th>
                            <th style="width: 20%">Description</th>
                            <th style="width: 2%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($listAttributes)) {
                            foreach ($listAttributes as $attribute) {
                        ?>
                                <tr id="item-<?= $attribute->id ?>" class="even">
                                    <td><?= $attribute->id ?></td>
                                    <td><a href="attribute/<?= $attribute->id ?>/edit"><?= $attribute->name ?></a></td>
                                    <td><?= $attribute->code ?></td>
                                    <td><?= $attribute->description ?></td>

                                    <td class="d-flex justify-content-around">
                                        <a class="btn btn-outline-warning" href="attribute/<?= $attribute->id ?>/edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a class="btn btn-outline-danger delete_item" href="attribute/<?= $attribute->id ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                                # code...
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>