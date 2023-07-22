const flashError = document.querySelector('.flash-error');
const errorMessage = flashError.dataset.error;

if (errorMessage) {

    toastr.error(errorMessage, "Oops..", {
        positionClass: "toast-top-left",
        timeOut: 5e3,
        closeButton: !0,
        debug: !1,
        newestOnTop: !0,
        progressBar: !0,
        preventDuplicates: !0,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        tapToDismiss: !1
    })
}

const flashSuccess = document.querySelector('.flash-success');
const successMessage = flashSuccess.dataset.success;

if (successMessage) {
    toastr.success(successMessage, "Success", {
        positionClass: "toast-top-left",
        timeOut: 5e3,
        closeButton: !0,
        debug: !1,
        newestOnTop: !0,
        progressBar: !0,
        preventDuplicates: !0,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        tapToDismiss: !1
    })
}




// LOGIN NOTIF
const flash = document.querySelector('.flash-error-login');
const message = flash.dataset.errorlogin;
if (message) {
    sweetAlert(
        "Oops...",
        message,
        "error"
    )
}
// LOGIN NOTIF








