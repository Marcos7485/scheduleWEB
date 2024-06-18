$(document).ready(function () {
    $('#disp-horaria').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        language: {
            info: "",
            infoEmpty: "",
        }
    });
});

function mostrarOcultarInput(selectorId, inputId1, inputId2) {
    var selector = document.getElementsByName(selectorId)[0]; // Obtener el primer elemento con el nombre especificado
    var input1 = document.getElementsByName(inputId1)[0]; // Obtener el primer elemento con el nombre especificado
    var input2 = document.getElementsByName(inputId2)[0]; // Obtener el primer elemento con el nombre especificado

    // Verificar si los elementos existen antes de intentar manipular sus estilos
    if (selector && input1 && input2) {
        if (selector.value === "Abierto") {
            input1.style.display = 'inline-block'; // Mostrar input1
            input1.style.display = 'inline-block'; // Mostrar input2
        } else {
            input1.style.display = 'none'; // Ocultar input1
            input1.style.display = 'none'; // Ocultar input2
        }
    } else {
        console.error("Uno o más elementos no fueron encontrados en el DOM.");
    }
}