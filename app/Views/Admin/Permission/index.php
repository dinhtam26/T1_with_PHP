<section class="section-header">
    <h1>Permission List</h1>
</section>

<section class="section-body">



    <div class="card" style="width: 100%">
        <div class="card-header">
            <div class="card-header d-flex justify-content-end">
                <a class="btn btn-primary" href="<?php ROOT_PATH ?>permission/create">Create Permission</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped dataTable no-footer" id="table-2" role="grid" aria-describedby="table-2_info" style="width: 100%">
                    <thead>
                        <tr role="row">
                            <th style="width: 5%">ID</th>
                            <th style="width: 15%">Name</th>
                            <th style="width: 15%">Module</th>
                            <th style="width: 10%">Controller</th>
                            <th style="width: 10%">Action</th>
                            <th style="width: 2%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($permissions)) {
                            foreach ($permissions as $permission) {
                        ?>
                                <tr>
                                    <td><?= $permission->id ?></td>
                                    <td><?= $permission->name ?></td>
                                    <td><?= $permission->module ?></td>
                                    <td><?= $permission->controller ?></td>
                                    <td><?= $permission->action ?></td>
                                    <td class="d-flex justify-content-around">
                                        <a class="btn btn-outline-warning" href="permission/<?= $permission->id ?>/edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a class="btn btn-outline-danger delete_item" href="permission/<?= $permission->id ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>