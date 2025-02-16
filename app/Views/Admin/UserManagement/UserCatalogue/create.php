<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thêm mới nhóm người dùng</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Quản lý nhóm người dùng</a>
                    </li>
                    <li class="breadcrumb-item active">Thêm mới</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card" id="customerList">
            <div class="card-header">
                <a href="http://localhost/magento-ecommerce/admin/userCatalogue" class="btn btn-light">Back</a>
            </div>
            <div class="card-body">
                <form name="form-submit" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-6">
                            <!-- Full name -->
                            <div class="mt-3">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="">
                            </div>

                            <div class="mt-3">
                                <label for="" class="form-label">Status</label>
                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                    <input type="checkbox" class="form-check-input" name="publish" value="1" checked id="publish">
                                    <label class="form-check-label" for="publish">Public</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mt-3"> <label>Description</label>
                                <textarea name="description" class="form-control" rows="5" id=""></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary" id="submit-all">Create</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!--end col-->
</div>