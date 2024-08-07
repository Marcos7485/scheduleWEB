# Work Methodology

- base de datos:
active -> default 1
softdeletes  cuando ver necesario

- controller:
uso de servicios para funciones del controlador
querys -> active = 1 siempre.



# falta:


- Recordatorios por Telegram.

- Autenticacion de registro de usuario, el telegram.
- verificador de telefono al registrar turno cliente.


# ERRORS:

Storage: en el host no aparecian las imagenes, y el link ya existia.
lo solucione borrando la carpeta storage dentro del public_html, luego crear un archivo create_symlink.php, en la carpeta public_html, con los siguientes codigos:

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


lo ejecute con el link de la pagina y listo.

no olvidar que el llamado de la imagen ahora es: src="{{ asset('storage/' . $trabajador->image) }}"





# SUBIR:

Comprobar DATABASE.

Guardar Storage fuera del PUBLIC_HTML -> mantener archivos
Guardar .ENV -> mantener configuracion

Cargar zip fuera de PUBLIC_HTML

Borrar la carpeta Storage dentro del PUBLIC_HTML
Modificar la configuracion de EMAIL en .ENV

EJECUTAR: agendasoftware.online/create_symlink.php