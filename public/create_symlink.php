<?php
// Ruta al directorio de destino
$target = '../storage/app/public';

// Ruta al enlace simbólico
$link = 'storage';

// Verificar si el enlace simbólico ya existe
if (!file_exists($link)) {
    // Crear el enlace simbólico
    if (symlink($target, $link)) {
        echo "Enlace simbólico creado con éxito.";
    } else {
        echo "Error al crear el enlace simbólico.";
    }
} else {
    echo "El enlace simbólico ya existe.";
}
?>