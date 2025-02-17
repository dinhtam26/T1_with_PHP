$(document).ready(function () {
    $(".dtr-control").on("click", function () {
        let id = $(this).data("id");

        // Nếu chưa có, gửi yêu cầu Ajax
        urlPath = "/magento-ecommerce/admin/getAttributeValue/" + id;
        $.ajax({
            type: "GET",
            url: urlPath,
            dataType: "json",
            success: function (response) {
                let attributeValues = response.attributeValue.map((attr) => attr.name).join(", ");

                // Cập nhật nội dung của phần tử
                $(".attribute-value-" + id).html(attributeValues);
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    });
});
