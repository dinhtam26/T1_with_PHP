var previewTemplate,
    dropzone,
    dropzonePreviewNode = document.querySelector("#dropzone-preview-list"),
    inputMultipleElements =
        ((dropzonePreviewNode.id = ""),
        dropzonePreviewNode &&
            ((previewTemplate = dropzonePreviewNode.parentNode.innerHTML),
            dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode),
            (dropzone = new Dropzone(".dropzone", {
                paramName: "avatar",
                url: "/magento-ecommerce/admin/user/create",
                method: "post",
                previewTemplate: previewTemplate,
                previewsContainer: "#dropzone-preview",

                uploadMultiple: true, // Gửi nhiều tệp trong một request
                parallelUploads: 10, // Số lượng tệp gửi song song
            }))));
