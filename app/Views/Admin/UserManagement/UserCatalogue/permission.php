<section class="section-header">
    <h4>User Catalogue Permission</h4>
</section>
<section class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/userCatalogue" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">
            <table id="myTable" class="table table-striped cell-border" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Module</th>
                        <th>Controller</th>
                        <th>Action</th>
                        <?php
                        foreach ($listUserCatalogue as $userCatalogue) {
                        ?>
                            <th><?= $userCatalogue->name ?></th>
                        <?php
                        }
                        ?>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($listPermission)) {
                        foreach ($listPermission as $permission) {
                    ?>
                            <tr>
                                <td><?= $permission->name ?></td>
                                <td><?= $permission->module ?></td>
                                <td><?= $permission->controller ?></td>
                                <td><?= $permission->action ?></td>

                                <?php
                                foreach ($listUserCatalogue as $userCatalogue) {
                                    $value = $permission->id . ":" . $userCatalogue->id;
                                    $class = "bg-primary";
                                    if ($permission->module == "admin" && $userCatalogue->code !== "admin") {
                                        $value = "";
                                        $class = "bg-light";
                                    }

                                ?>
                                    <td>
                                        <div class="col-auto ">
                                            <label class="colorinput">
                                                <input type="checkbox" name="permission" value="<?= $value ?>"
                                                    <?php

                                                    if ($permission->module == "admin" && $userCatalogue->code !== "admin") {
                                                        echo "disabled";
                                                    }

                                                    if (!empty($permissionUserCatalogues)) {
                                                        foreach ($permissionUserCatalogues as $permissionUserCatalogue) {
                                                            if ($permissionUserCatalogue->permission_id . ":" . $permissionUserCatalogue->user_catalogue_id == $permission->id . ":" . $userCatalogue->id) {
                                                                echo "checked";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    class="colorinput-input check-permission">
                                                <span class="colorinput-color  <?= $class  ?>"></span>
                                            </label>
                                        </div>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>