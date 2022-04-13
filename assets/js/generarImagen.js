const $btnDescargar = document.querySelector("#btnDescargar"),
    $btnGenerarDocumento = document.querySelector("#btnGenerarDocumento");

// Escuchar clic del botón para descargar el canvas
$btnDescargar.onclick = () => {
    const enlace = document.createElement('a');
    // El título
    enlace.download = "Firma.png";
    // Convertir la imagen a Base64 y ponerlo en el enlace
    enlace.href = $canvas.toDataURL();
    // Hacer click en él
    document.getElementById("firmaImagen").value = enlace;
};

/*window.obtenerImagen = () => {
    return $canvas.toDataURL();
};*/