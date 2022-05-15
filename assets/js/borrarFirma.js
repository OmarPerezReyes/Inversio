const $canvas = document.querySelector("#signature-canvas"),
    $btnLimpiar = document.querySelector("#btnLimpiar");
const contexto = $canvas.getContext("2d");

const limpiarCanvas = () => {
    contexto.fillStyle = "white";
    contexto.fillRect(0, 0, $canvas.width, $canvas.height);
};
limpiarCanvas();
$btnLimpiar.onclick = limpiarCanvas;