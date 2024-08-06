# Database
done

# LoginSystem

Creacion de rutas Registro, login, logout.
Request de validacion, LoginPostRequest, RegistroPostRequest.
Rules personalizadas, ValidPasswordSymbol.
Layouts, Registro, login, schedule.

lang/es/validation.php
Archivo de las traducciones al español, junto a la modificacion del archivo .env.

- * Verificacion de telefono por SMS pendiente con TWILO.



# schedule

# falta:


- Recordatorios por Telegram.

- Autenticacion de registro de usuario, el telegram.
- verificador de telefono al registrar turno cliente.





# Repasar conceptos:
- Fetch javascript para conectar html con controller.
- Encriptacion


adm@adm.com

321321


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