const inputs = document.querySelectorAll(".input");


function addcl() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remcl() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        parent.classList.remove("focus");
    }
}


inputs.forEach(input => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
});

function fileChoose(event, element) {
    if (event.target.files.length > 0) {
        //element.nextElementSibling.setAttribute('data-after', event.target.files[0].name);
        element.nextElementSibling.setAttribute('data-after', 'Credencial.pdf');
    }
}


// limitar tamaño del telefono

function maxlengthNumber(obj) {
    if (obj.value.length > obj.maxLength) {
        obj.value = obj.value.slice(0, obj.maxLength);
    }
}

function confirmar() {
    var pass = document.getElementById("contrasena");
    var pass2 = document.getElementById("contrasenaConfirm");
    var check = document.getElementById("check");

    if (pass2.value != pass.value) {
        check.disabled = true;
    } else {
        check.disabled = false;
    }
}