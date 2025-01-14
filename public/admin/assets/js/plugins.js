if (
    document.querySelectorAll("[toast-list]").length > 0 ||
    document.querySelectorAll("[data-choices]").length > 0 ||
    document.querySelectorAll("[data-provider]").length > 0
) {
    // Hàm tải script động
    function loadScript(src) {
        const script = document.createElement("script");
        script.type = "text/javascript";
        script.src = src;
        document.head.appendChild(script); // Chèn vào <head> hoặc <body> tùy ý
    }

    // Tải các script cần thiết
    loadScript("https://cdn.jsdelivr.net/npm/toastify-js");
    loadScript("magento-ecommerce/public/admin/assets/libs/choices.js/public/assets/scripts/choices.min.js");
    loadScript("magento-ecommerce/public/admin/assets/libs/flatpickr/flatpickr.min.js");
}
