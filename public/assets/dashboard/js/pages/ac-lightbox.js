'use strict';
(function () {
    // [ lightbox ]
    $(document).on('click', '[data-bs-toggle="lightbox"]', function (event) {
        $(this).ekkoLightbox();
    });
})();