$(document).ready(function () {
    $("input[name='permission']").on("click", function () {
        let data = $(this).val();
        let parts = data.split(":");
        let permission = parts[0];
        let userCatalogue = parts[1];

        if ($(this).prop("checked")) {
            let url = "/magento-ecommerce/admin/userCatalogue/storePermission";
            $.ajax({
                type: "GET",
                url: url,
                data: { permission: permission, userCatalogue: userCatalogue },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        toastr.success(response.message);
                    } else if (response.status === "error") {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                },
            });
        } else {
            let url = "/magento-ecommerce/admin/userCatalogue/deletePermission";
            $.ajax({
                type: "GET",
                url: url,
                data: { permission: permission, userCatalogue: userCatalogue },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        toastr.success(response.message);
                    } else if (response.status === "error") {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                },
            });
        }
    });
});
