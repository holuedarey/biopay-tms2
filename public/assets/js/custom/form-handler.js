(function ($) {
    "use strict";

    $(document).on('submit', '.my-form', function(e) {
        e.preventDefault();

        let form = this;
        let button = $(form).find('[type=submit]');

        let spinnerColor = $(button).hasClass('spinner-dark') ? 'black' : 'white';

        let spinner = `
           <svg width="18" viewBox="-2 -2 42 42" xmlns="http://www.w3.org/2000/svg" stroke="${spinnerColor}" class="ml-2 spinner">
                <g fill="none" fill-rule="evenodd">
                    <g transform="translate(1 1)" stroke-width="4">
                        <circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle>
                        <path d="M36 18c0-9.94-8.06-18-18-18">
                            <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"></animateTransform>
                        </path>
                    </g>
                </g>
            </svg>`;

        $(button).addClass('d-flex align-items-center justify-content-center gap-1').append(spinner).attr('disabled', true);

        setTimeout(function () {
            form.submit();
        }, 1000)
    })
})(jQuery)