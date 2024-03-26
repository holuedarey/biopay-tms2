/**
 * A simple extension of toastify to easily call notification with a function from anywhere.
 *
 * @author Lyte Onyema
 * @link https://github.com/teqbylyte
 */

(function () {
    const notification = $("#my-notification");

    const successDuration = 3500;
    const defaultDuration = 5500;

    if(notification.length) {
        let msg = notification.data('msg');
        let type = notification.data('type')
        let duration = type === 'error' ? defaultDuration : successDuration;

        return notify(type, msg, duration)
    }


    window.addEventListener('success', event => {
        notify('success', event.detail.message, successDuration)
    })

    window.addEventListener('danger', event => {
        notify('error', event.detail.message)
    })

    window.addEventListener('info', event => {
        notify('info', event.detail.message)
    })
})()

const defaultDuration = 5500;

function notify(title, message, duration = defaultDuration) {
    $.notify(message, {
        type: title === 'error' ? 'danger' : title,
        allow_dismiss: true,
        delay: duration,
        timer: 300,
        animate: {
            enter: "animated fadeInDown",
            exit: "animated fadeOutUp",
        },
    });
}
