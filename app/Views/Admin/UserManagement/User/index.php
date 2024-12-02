<section class="section-header">
    <h1>User List</h1>
</section>

<section class="section-body">
    <div class="card" style="width: 100%">
        <div class="card-header">
            <div class="card-header d-flex justify-content-end">
                <a class="btn btn-primary" href="<?php ROOT_PATH ?>user/create">Create User</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped dataTable no-footer" id="table-2" role="grid" aria-describedby="table-2_info" style="width: 100%">
                    <thead>
                        <tr role="row">
                            <th class="text-center sorting_asc" style="width: 5%">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                </div>
                            </th>
                            <th style="width: 5%">ID</th>
                            <th style="width: 15%">Full Name</th>
                            <th style="width: 15%">Email</th>
                            <th style="width: 10%">Phone</th>
                            <th style="width: 10%">Role admin</th>
                            <th style="width: 10%">Publish</th>
                            <th style="width: 5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($listUser)) {
                            foreach ($listUser as $key => $user) {


                        ?>
                                <tr role="row" class="odd" id="#item<?= $user['id'] ?>">
                                    <td class="sorting_1 text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td style="text-align: center;"><?= $user['id'] ?></td>
                                    <td><?= $user['fullname'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['phone'] ?></td>
                                    <td style="text-align: center;">
                                        <?= ($user['user_catalogue']['code'] == 'admin') ? '<span class="badge badge-primary">Admin</span>' : '<span class="badge badge-success">Member</span>' ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="publish" value="<?= $user['publish'] ?>" <?= ($user['publish'] == 1) ? "checked" : ""  ?> class="custom-switch-input" onchange="changeStatus(<?php echo $user['id']; ?>, 'user')">
                                            <span class="custom-switch-indicator"></span>
                                        </label>

                                    </td>
                                    <td class="d-flex justify-content-around">
                                        <a class="btn btn-outline-warning" href="user/<?= $user['id'] ?>/edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a class="btn btn-outline-danger delete_item" href="user/<?= $user['id'] ?>">
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