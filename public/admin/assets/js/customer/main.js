$(document).ready(function () {
    $(".custom-switch-input").on("change", function () {
        // Cập nhật giá trị của checkbox hiện tại
        $(this).val($(this).prop("checked") ? "1" : "0");
        let value = $(this).val();

        // Lấy name của checkbox hiện tại
        let name = $(this).attr("name");
        // Tìm phần mô tả liên quan đến checkbox này
        let description = $(this).closest(".custom-switch").find(".custom-switch-description");

        // Xử lý dựa trên giá trị name
        if (name === "publish") {
            // Xử lý riêng cho "publish"
            if (value === "1") {
                description.text(" Active");
            } else {
                description.text(" Inactive");
            }
        } else if (name === "is_feature") {
            // Xử lý riêng cho "is_feature"
            if (value === "1") {
                description.text(" Active");
            } else {
                description.text(" Inactive");
            }
        }
    });
});
