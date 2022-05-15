const $btnDescargar = document.querySelector("#btnDescargar"),
    $btnGenerarDocumento = document.querySelector("#btnGenerarDocumento");

// Escuchar clic del botón para descargar el canvas
$btnDescargar.onclick = () => {
    const enlace = document.createElement('a');
    // El título
    enlace.download = "Firma.jpeg";
    // Convertir la imagen a Base64 y ponerlo en el enlace
    enlace.href = $canvas.toDataURL("image/jpeg", 1);
    // Hacer click en él
    //enlace.click();
    document.getElementById("firmaImagen").value = enlace;
};

/*window.obtenerImagen = () => {
    return $canvas.toDataURL();
};*/