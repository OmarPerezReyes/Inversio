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