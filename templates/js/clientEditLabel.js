function clientEditLabelValidate(form) {
    var elems = form.elements;
    var error = false;
    resetError(elems.label.parentNode);

    if (elems.display_service_list.checked || elems.display_service_info.checked || elems.display_invoice_info.checked) {
        if (!elems.label.value) {
            showError(elems.label.parentNode, 'Это поле обязательно в случае если отмечена одна из галочек.');
            error = true;
        }
    }

    if (error === false) {
        form.submit();
    }
}


function showError(container, errorMessage) {
    container.className = 'form-group error';
    var msgElem = document.createElement('span');
    msgElem.className = "error-message";
    msgElem.innerHTML = errorMessage;
    container.appendChild(msgElem);
}

function resetError(container) {
    container.className = 'form-group';
    if (container.lastChild.className === "error-message") {
        container.removeChild(container.lastChild);
    }
}
