
    function disableSubmitButton() {
        var submitButton = document.getElementById("submit-button");
        submitButton.disabled = true;
        submitButton.innerHTML = "Loading...";
    }

    $.fn.modal.Constructor.prototype.enforceFocus = function () {};
