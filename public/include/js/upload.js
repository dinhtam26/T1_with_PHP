$(document).ready(function () {
    const selectedFilesMap = new Map(); // Lưu trữ file đã chọn cho từng input

    $(document).on("change", "input[type='file']", function (event) {
        const files = event.target.files;
        const inputId = $(this).attr("id"); // Lấy id của input hiện tại
        const previewId = $(this).data("preview"); // Lấy id của vùng preview tương ứng
        const previewContainer = $("#" + previewId); // Tìm vùng preview đúng
        const isMultiple = $(this).attr("multiple") !== undefined; // Kiểm tra multiple

        if (!selectedFilesMap.has(inputId)) {
            selectedFilesMap.set(inputId, new Map()); // Nếu chưa có, tạo Map riêng cho input này
        }
        const selectedFiles = selectedFilesMap.get(inputId); // Lấy danh sách file của input này

        if (!isMultiple) {
            previewContainer.empty();
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
                        selectedFiles.delete(file.name);
                        imgContainer.remove();
                        syncInputFiles(inputId);
                    });

                    previewContainer.append(imgContainer);
                    selectedFiles.set(file.name, file);
                    syncInputFiles(inputId);
                };
                reader.readAsDataURL(file);
            }
        });

        $(this).val(""); // Reset input để có thể chọn lại cùng file
    });

    function syncInputFiles(inputId) {
        const dataTransfer = new DataTransfer();
        const selectedFiles = selectedFilesMap.get(inputId);
        selectedFiles.forEach((file) => {
            dataTransfer.items.add(file);
        });

        $("#" + inputId)[0].files = dataTransfer.files;
    }
});
