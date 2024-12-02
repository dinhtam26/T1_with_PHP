<section class="section-header">
    <h1>Create Permission</h1>
</section>
<section class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="http://localhost/magento-ecommerce/admin/permission" class="btn btn-light">Back</a>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">Create Normal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false">Create Fast</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade  active show" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="">
                                        </div>

                                        <div class="form-group">
                                            <label>Module <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="module" value="">
                                        </div>

                                        <div class="form-group">
                                            <label>Controller <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="controller" value="">
                                        </div>

                                        <div class="form-group">
                                            <label>Action <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="action" value="">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Create Fast</label>
                                            <input type="text" class="form-control" name="create_fast" value="" placeholder="Đinh dạng: admin-CRUD:users:Thành viên">
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>