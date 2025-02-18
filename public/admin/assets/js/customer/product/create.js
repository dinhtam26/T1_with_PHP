$(document).ready(function () {
    let typeProduct = $("select[name='type']").val();
    $("select[name='type']").on("change", function () {
        typeProduct = $("select[name='type']").val();
        // Kích hoạt sự kiện change cho attribute_select
        $(".attribute_select").trigger("change");

        if (typeProduct == "variant") {
            $("#product_variants-tab4").css({
                display: "block",
            });
            $("#product_variants4").css({
                display: "block",
            });
        } else {
            $("#product_variants-tab4").css({
                display: "none",
            });
            $("#product_variants4").css({
                display: "none",
            });
        }
    });

    // Biến lưu trữ các giá trị thuộc tính đã chọn
    let selectedValues = {};

    $(".attribute_select").on("change", function () {
        let attributeID = $(this).val();
        let url = "/magento-ecommerce/admin/product/create";

        // Lưu lại các giá trị đã chọn trước khi làm mới giao diện
        $(".attribute_value_select").each(function () {
            let attributeName = $(this).closest(".form-group").find("label").text().trim(); // Lấy tên thuộc tính (Màu, Dung lượng)
            selectedValues[attributeName] = $(this).val(); // Lưu giá trị đã chọn
        });

        if (attributeID && attributeID.length > 0) {
            $.ajax({
                type: "GET",
                url: url,
                data: { loadAttributeID: attributeID },
                dataType: "json",
                success: function (response) {
                    let html = "";
                    $.each(response.attribute, function (key, value) {
                        let xhtml = `<div class="form-check form-switch form-switch-md ms-3" dir="ltr">
                                            <input type="checkbox" class="form-check-input" name="enable_variant[${key}]" id="${key}">
                                            <label class="form-check-label" for=""></label>
                                        </div>
                                    `;
                        html += `
                                <div class="form-group d-flex justify-content-between align-items-center mt-3">
                                    <label style="width:100px" for="">${value.attribute_name}</label>
                                    <select style="width: 450px;" data-name="${value.attribute_name}" name="attribute_value[${key}][]" id="attribute_value_select-${key}"
                                        class="form-control select2 attribute_value_select" 
                                        multiple="" tabindex="1" aria-hidden="false" 
                                    aria-placeholder="Choose class shipping">`;

                        $.each(value.attribute_values, function (id, name) {
                            html += `<option value="${id}">${name}</option>`;
                        });

                        html +=
                            `</select>
                                    <div class="col-auto">` +
                            (typeProduct == "variant" ? xhtml : "") +
                            `</div>
                                 </div>`;
                    });

                    $("#attribute_values").html(html);
                    $("#attribute_values .select2").select2();

                    // Khôi phục giá trị đã chọn cho các thuộc tính không bị xóa
                    $("#attribute_values .attribute_value_select").each(function () {
                        let attributeName = $(this).closest(".form-group").find("label").text().trim();
                        if (selectedValues.hasOwnProperty(attributeName)) {
                            // Khôi phục nếu thuộc tính không bị xóa
                            $(this).val(selectedValues[attributeName]).trigger("change");
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                },
            });
        } else {
            $("#attribute_values").empty();
            $(".save_attribute").css({
                display: "none",
            });
        }
    });

    // Sự kiện change cho các giá trị thuộc tính
    $(document).on("change", ".attribute_value_select", function () {
        let attribute = $("select[name='attribute']").val();
        let attributeValue = $(this).val();
        console.log(attributeValue);

        if (attributeValue.length > 0) {
            $(".save_attribute").css({
                cursor: "pointer",
                display: "inline-block",
            });
            $(".save_attribute").addClass("btn-primary");
        } else {
            $(".save_attribute").css({
                display: "none",
            });
        }
    });

    // Gửi thuộc tính để làm biến thể
    $(".save_attribute").on("click", function () {
        let url = "/magento-ecommerce/admin/product/create";
        let attribute_value = {};
        let attribute = $("select[name='attribute']").val();

        $.each(attribute, function (key, value) {
            let enableVariant = $(`input[id=${value}]`).is(":checked");
            // Kiểm tra xem input enable_variant được chọn chưa

            let selectedValues = $(`select[name='attribute_value[${value}][]']`).val(); // Lấy các giá trị được chọn
            let selectedName = $(`select[name='attribute_value[${value}][]']`).data("name");
            attribute_value[value] = attribute_value[value] || {};
            attribute_value[value]["name"] = selectedName;
            attribute_value[value]["values"] = selectedValues || [];
            attribute_value[value]["enable_variant"] = enableVariant;
        });

        $.ajax({
            type: "GET",
            url: url,
            data: { attribute: attribute, attribute_value: attribute_value },
            dataType: "json",
            success: function (response) {
                console.log(response);

                if (response.attribute_values.attribute_variant != "") {
                    toastr.success("Lưu thuộc tính thành công");
                    $("#generateProductVariant").removeAttr("style");
                    $("#generateProductVariant").addClass("btn-primary");

                    $("#generateProductVariant").on("click", function () {
                        // console.log(response.attribute_values.attribute_variant);
                        let variants = generateProductVariant(response.attribute_values.attribute_variant);
                        let xhtml = "";
                        $.each(variants, function (key, value) {
                            let price = $("input[name='price']").val();
                            let priceSale = $("input[name='sale_price']").val();
                            let priceCost = $("input[name='cost_price']").val();
                            let stock = $("input[name='stock']").val();
                            let low_stock_amount = $("input[name='low_stock_amount']").val();

                            xhtml += `
                          
<div class="accordion accordion-flush mt-3" id="default-accordion-example">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading-${value}">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-${key}" aria-expanded="true" aria-controls="collapse-${key}">
               #${key + 1}  <b class="ms-3 text-primary" style="ms-3">${value}</b>
            </button>
        </h2>
        <div id="collapse-${key}" class="accordion-collapse collapse" aria-labelledby="flush-heading-${key}" data-bs-parent="#default-accordion-example">
            <div class="accordion-body" id="panel-body-${key}">
                   <p class="text-center text-primary mt-4">Ảnh chính sản phẩm</p>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mt-3">
                                <label for="imageInput${key + 3}">Ảnh mô tả sản phẩm ${key + 3}</label>
                                <div class="d-flex">
                                    <div class="file-upload-container">
                                        <input type="file" name="image_variant[]" id="imageInput${key + 3}" data-preview="preview${key + 3}">
                                        <label for="imageInput${key + 3}" class="file-upload-label">
                                            <i class="fas fa-upload"></i>
                                            <span>Ảnh mô tả sản phẩm</span>
                                        </label>
                                    </div>
                                    <div style="margin-left:20px" id="preview${key + 3}"></div>
                                </div>
                        </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Sku</label>
                                <input type="text" class="form-control" name="sku[]">
                            </div>
                        </div>                          
                    </div>
                    
                           
                   <p class="text-center text-primary mt-4 p-1" style="border-top: 1px solid #ddd">Thư viện ảnh sản phẩm</p>
                   <div class="row " >
                        <div class="col-2">
                            <span style="display:block;text-align:center"><b>Thư viện ảnh</b></span>
                            <span style="text-align: center;display: inline-block;width: 100px;">
                                (Mặc định sẽ lấy ảnh thư viện sản phẩm)
                            </span>
                        </div>
                        <div class="col-10">
                            <div class="form-group mt-3">
                                <label for="imageInput${key + 20}">Ảnh album sản phẩm ${key + 20}</label>
                                <div class="d-flex">
                                    <div class="file-upload-container">
                                        <input type="file" name="album_variant[${key}][]" multiple  id="imageInput${key + 20}" data-preview="preview${
                                key + 20
                            }">
                                        <label for="imageInput${key + 20}" class="file-upload-label">
                                            <i class="fas fa-upload"></i>
                                            <span>Ảnh mô tả sản phẩm</span>
                                        </label>
                                    </div>
                                    <div style="margin-left:20px" id="preview${key + 20}"></div>
                                </div>
                            </div>
                        </div>
                   </div>

                   <p class="text-center text-primary mt-4 p-1" style="border-top: 1px solid #ddd">Giá sản phẩm sản phẩm</p>
                   <div class="row" >
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Giá bán</label>
                                <input type="text" class="form-control" name="price[]" value=${price}>     
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Giá sale</label>
                                <input type="text" class="form-control" placeholder="Nhập giá so sánh với giá vốn" name="sale_price[]" value="${priceSale}">
                            </div>
                        </div>
                        <div class="col-4">
                           <div class="form-group">
                                <label for="">Giá vốn</label>
                                <input type="text" class="form-control" name="cost_price[]" value="${priceCost}">
                            </div>
                        </div>
                   </div>

                   <p class="text-center text-primary mt-4 p-1" style="border-top: 1px solid #ddd">Kiểm kê kho hàng</p>
                   <div class="row " >
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Số lượng</label>
                                <input type="text" class="form-control" name="stock[]" value="${stock}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Số lượng ngưỡng</label>
                                <input type="text" class="form-control" name="low_stock_amount[]" value"${low_stock_amount}">
                            </div>
                        </div>
                        
                   </div>

                   <p class="text-center text-primary mt-4 p-1" style="border-top: 1px solid #ddd">Giao hàng</p>
                   <div class="row " >
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Cân nặng (g)</label>
                                <input type="text" class="form-control" name="weight[]" value"">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Dài (cm)</label>
                                <input type="text" class="form-control" name="length[]" value"">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Rộng (cm)</label>
                                <input type="text" class="form-control" name="width[]" value"">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Cao (cm)</label>
                                <input type="text" class="form-control" name="height[]" value"">
                            </div>
                        </div>
                        
                   </div>
            </div>
        </div>
            <div >
                <a class="btn btn-outline-danger delete_item" href="product/">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </div>
        </div>
        </div>
    
</div>
                             `;
                        });
                        $("#accordion").html(xhtml);
                    });
                }
            },
        });
    });

    function generateProductVariant(attributes) {
        let keys = Object.keys(attributes); // Lấy danh sách ID thuộc tính
        let result = []; // Mảng để lưu các biến thể

        function combine(index, current) {
            // Nếu đã kết hợp hết các thuộc tính
            if (index === keys.length) {
                result.push(current.trim()); // Thêm biến thể vào danh sách
                return;
            }

            let key = keys[index]; // Lấy ID thuộc tính hiện tại
            let attribute = attributes[key]; // Lấy thông tin thuộc tính

            // Lặp qua từng giá trị của thuộc tính
            attribute.values.forEach((value) => {
                combine(index + 1, `${current} ${value} -`);
            });
        }

        combine(0, ""); // Bắt đầu từ thuộc tính đầu tiên
        return result.map((item) => item.slice(0, -2)); // Loại bỏ dấu "-" cuối cùng
    }

    $("input[name='price']").on("change", function () {
        let stock = $(this).val();
        $("input[name='price[]']").each(function () {
            $(this).val(stock);
        });
    });

    function handleFileInput(inputElement, previewArea, allowMultiple = true) {
        const selectedFiles = [];
        inputElement.on("change", function (e) {
            const files = e.target.files;
            // Nếu không cho phép nhiều file, xóa ảnh cũ
            if (!allowMultiple) {
                previewArea.empty();
            }
            // Duyệt qua các file được chọn
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                selectedFiles.push(file);

                const reader = new FileReader();

                reader.onload = function (event) {
                    // Tạo container cho ảnh xem trước
                    const imageContainer = $('<div style="margin-right:15px" class="image-container"></div>');
                    const img = $("<img />").attr("src", event.target.result);
                    const removeBtn = $('<button class="remove-btn">X</button>');

                    // CSS cho ảnh
                    img.css({
                        height: "80px",
                        width: "80px",
                        "object-fit": "cover",
                        "border-radius": "5px",
                        border: "1px solid #ddd",
                    });

                    // CSS cho nút xóa
                    removeBtn.css({
                        position: "relative",
                        top: "-50px",
                        right: "-30px",
                        "background-color": "red",
                        color: "white",
                        border: "none",
                        "border-radius": "50%",
                        width: "20px",
                        height: "20px",
                        "font-size": "14px",
                        "font-weight": "bold",
                        cursor: "pointer",
                        display: "flex",
                        "align-items": "center",
                        "justify-content": "center",
                    });

                    // Xử lý nút xóa
                    removeBtn.on("click", function () {
                        imageContainer.remove();
                        selectedFiles.splice(selectedFiles.indexOf(file), 1); // Loại bỏ file khỏi mảng
                    });

                    // Thêm ảnh và nút vào container
                    imageContainer.append(img).append(removeBtn);
                    previewArea.append(imageContainer);
                };

                reader.readAsDataURL(file);
            }
        });
        return selectedFiles;
    }

    // Tạo biến lưu trữ cho các file được chọn từ từng input
    const albumInput = $("#album");
    const albumPreviewArea = $("#preview-area");
    const albumFiles = handleFileInput(albumInput, albumPreviewArea, true); // Album cho phép nhiều ảnh

    const imageInput = $("#image");
    const imagePreviewArea = $("#image-preview-area");
    const imageFiles = handleFileInput(imageInput, imagePreviewArea, false); // Ảnh chính chỉ cho phép 1 ảnh

    // Xử lý khi form được submit
    // $("#uploadForm").on("submit", function (e) {
    //     e.preventDefault(); // Ngăn form submit mặc định

    //     const formData = new FormData();

    //     // Append các dữ liệu khác (text input, select, v.v.) từ form trừ input file
    //     $(this)
    //         .find("input, select, textarea")
    //         .not('input[type="file"]')
    //         .each(function () {
    //             // formData.append($(this).attr("name"), $(this).val());
    //             const name = $(this).attr("name");
    //             const value = $(this).is(":checkbox") ? ($(this).is(":checked") ? 1 : 0) : $(this).val();
    //             formData.append(name, value);
    //         });

    //     // Append các file từ albumFiles vào FormData
    //     albumFiles.forEach((file) => {
    //         formData.append("album[]", file);
    //     });

    //     // Append file từ imageFiles vào FormData (nếu có file được chọn)
    //     if (imageFiles.length > 0) {
    //         formData.append("image", imageFiles[0]); // Chỉ lấy file đầu tiên
    //     }

    //     // Append các file từ albumFiles vào FormData

    //     $(".image_variant").each(function () {
    //         const files = $(this)[0].files; // Get the files for this input
    //         if (files.length > 0) {
    //             formData.append("image_variant[]", files[0]); // Only append the first file
    //         }
    //     });

    //     $(".album_variant").each(function () {
    //         const files = $(this)[0].files; // Lấy danh sách file của input hiện tại
    //         const id = $(this).data("id");
    //         console.log(id);

    //         if (files.length > 0) {
    //             for (let i = 0; i < files.length; i++) {
    //                 // Gửi file kèm ID
    //                 formData.append(`album_variant[${id}][]`, files[i]);
    //             }
    //         }
    //     });

    //     // Gửi dữ liệu qua AJAX
    //     $.ajax({
    //         url: $(this).attr("action"), // URL được lấy từ thuộc tính action của form
    //         method: $(this).attr("method"), // Phương thức được lấy từ thuộc tính method của form
    //         data: formData,
    //         processData: false,
    //         contentType: false,
    //         success: function (response) {
    //             console.log(response);

    //             // setTimeout(function () {
    //             //     window.location.href = "http://localhost/magento-ecommerce/admin/product";
    //             // }, 2500);
    //             // toastr.success("Create Product Successfully");
    //         },
    //         error: function (xhr) {
    //             console.error(xhr.responseText);
    //         },
    //     });
    // });

    // Xử lý attribute
});
