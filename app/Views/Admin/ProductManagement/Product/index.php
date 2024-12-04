<section class="section-header">
    <h1>Product List</h1>
</section>

<section class="section-body">



    <div class="card" style="width: 100%">
        <div class="card-header">
            <div class="card-header d-flex justify-content-end">
                <a class="btn btn-primary" href="<?php ROOT_PATH ?>product/create">Create Product</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped dataTable no-footer" id="table-2" role="grid" aria-describedby="table-2_info" style="width: 100%">
                    <thead>
                        <tr role="row">
                            <th style="width: 2%">ID</th>
                            <th style="width: 5%">Type</th>
                            <th style="width: 15%">Name</th>
                            <th style="width: 4%">Publish</th>
                            <th style="width: 1%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="item-">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="publish" value="" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </td>

                            <td class="d-flex justify-content-around">
                                <a class="btn btn-outline-warning" href="product//edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a class="btn btn-outline-danger delete_item" href="product/">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
<?php
