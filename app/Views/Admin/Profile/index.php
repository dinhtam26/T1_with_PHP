<section class="section-header">
    <h1>Your Profile</h1>
</section>

<section class="section-body">
    <div class="row">

        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">
                    <form action="<?= ROOT_URL ?>admin/profile" method="post" class="needs-validation" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" class="form-control" value="<?= $user['fullname'] ?>" name="fullname">
                            <div class="invalid-feedback">
                                Please fill in the first name
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Avatar</label>
                            <div class="form-group">
                                <input type="file" class="form-control" name="avatar">
                            </div>

                            <figure class="avatar mr-2 avatar-xl">
                                <img style="object-fit: cover; width=100%" src="<?= UPLOAD_URL . "user/" . $user['avatar'] ?>" alt="...">
                            </figure>


                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="<?= $user['email'] ?>" name="email">
                            <div class="invalid-feedback">
                                Please fill in the email
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" class="form-control" value="<?= $user['phone'] ?>" name="phone">
                        </div>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="<?= ROOT_URL ?>admin/profile/changePassword" method="post" class="needs-validation" novalidate="">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-control" name="current_password">
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="new_password">
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password">
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





</section>
<?php
