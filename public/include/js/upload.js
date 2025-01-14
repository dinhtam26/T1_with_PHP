$(document).ready(function () {
    const selectedFiles = new Map(); // Lưu trữ các file đã chọn

    $("#imageInput").on("change", function (event) {
        const files = event.target.files;
        const isMultiple = $(this).attr("multiple") !== undefined; // Kiểm tra có thuộc tính multiple hay không

        if (files.length > 0) {
            // Nếu không có multiple, xóa các ảnh cũ
            if (!isMultiple) {
                $("#preview").empty();
                selectedFiles.clear();
            }

            Array.from(files).forEach((file) => {
                if (file.type.startsWith("image/") && !selectedFiles.has(file.name)) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const imgContainer = $(`
                            <div class="image-container">
                                <img src="${e.target.result}" alt="Preview">
                                <button class="delete-btn">×</button>
                            </div>
                        `);

                        // Xử lý nút xóa
                        imgContainer.find(".delete-btn").on("click", function () {
                            selectedFiles.delete(file.name); // Xóa file khỏi Map
                            imgContainer.remove(); // Xóa ảnh khỏi giao diện
                            syncInputFiles(); // Đồng bộ lại input
                        });

                        $("#preview").append(imgContainer);
                        selectedFiles.set(file.name, file); // Thêm file vào Map
                        syncInputFiles(); // Đồng bộ lại input
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Reset input để có thể chọn lại cùng file
        $(this).val("");
    });

    function syncInputFiles() {
        // Tạo DataTransfer để quản lý danh sách tệp gửi đi
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach((file) => {
            dataTransfer.items.add(file);
        });

        // Gán danh sách file mới cho input
        $("#imageInput")[0].files = dataTransfer.files;
    }
});
