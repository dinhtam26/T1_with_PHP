<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thêm mới quyền</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Quản lý quyền</a>
                    </li>
                    <li class="breadcrumb-item active">Thêm mới</li>
                </ol>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="http://localhost/magento-ecommerce/admin/permission" class="btn btn-light">Back</a>
            </div>
            <div class="card-body">

                <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                    <li class="nav-item waves-effect waves-light" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#pill-justified-home-1" role="tab" aria-selected="true">
                            Thêm mới bình thường
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light" role="presentation">
                        <a class="nav-link " data-bs-toggle="tab" href="#pill-justified-profile-1" role="tab" aria-selected="false">
                            Thêm mới nhanh
                        </a>
                    </li>

                </ul>
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <div class="tab-pane active show" id="pill-justified-home-1" role="tabpanel">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group mt-3">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="">
                            </div>

                            <div class="form-group mt-3">
                                <label>Module <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="module" value="">
                            </div>

                            <div class="form-group mt-3">
                                <label>Controller <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="controller" value="">
                            </div>

                            <div class="form-group mt-3">
                                <label>Action <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="action" value="">
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="pill-justified-profile-1" role="tabpanel">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group mt-3">
                                <label>Thêm nhanh</label>
                                <input type="text" class="form-control" name="create_fast" value="" placeholder="Đinh dạng: admin-CRUD:users:Thành viên">
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>

                </div>

                <!-- <div class="col-6">
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
                </div> -->

            </div>
        </div>
    </div>

</div>