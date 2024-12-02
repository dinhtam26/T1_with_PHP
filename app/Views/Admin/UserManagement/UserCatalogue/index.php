<section class="section-header">
    <h1>User Catalogue List</h1>
</section>

<section class="section-body">

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a class="btn btn-primary" href="<?php ROOT_PATH ?>userCatalogue/permission">Permission</a>
            <a class="btn btn-primary ml-4" href="<?php ROOT_PATH ?>userCatalogue/create">Create User Catalogue</a>
        </div>
        <div class="card-body">
            <table id="myTable" class="table table-striped cell-border" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Publish</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($listUserCatalogue as $key => $userCatalogue) {
                    ?>
                        <tr id="item-<?= $userCatalogue->id ?>">
                            <td><?= $userCatalogue->id ?></td>
                            <td><?= $userCatalogue->name ?></td>
                            <td><?= $userCatalogue->code ?></td>
                            <td><?= $userCatalogue->description ?></td>
                            <td><?= $userCatalogue->quantity ?></td>
                            <td>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="publish" value="<?= $userCatalogue->publish ?>" <?= ($userCatalogue->publish == 1) ? "checked" : ""  ?> class="custom-switch-input" onchange="changeStatus(<?php echo $userCatalogue->id; ?>, 'userCatalogue')">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </td>
                            <td>
                                <a class="btn btn-outline-warning" href="userCatalogue/<?= $userCatalogue->id ?>/edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a class="btn btn-outline-danger delete_item" href="<?= $userCatalogue->id ?>/userCatalogue">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</section>