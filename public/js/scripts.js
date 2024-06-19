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


function mostrarOcultarInput(selectorId, inputId1, inputId2, inputId3, inputId4) {
    var selector = document.getElementsByName(selectorId)[0]; // Obtener el primer elemento con el nombre especificado
    var input1 = document.getElementsByName(inputId1)[0]; // Obtener el primer elemento con el nombre especificado
    var input2 = document.getElementsByName(inputId2)[0]; // Obtener el primer elemento con el nombre especificado
    var input3 = document.getElementsByName(inputId3)[0]; // Obtener el primer elemento con el nombre especificado
    var input4 = document.getElementsByName(inputId4)[0]; // Obtener el primer elemento con el nombre especificado

    // Verificar si los elementos existen antes de intentar manipular sus estilos
    if (selector && input1 && input2) {
        if (selector.value === "Abierto") {
            input1.disabled = false; // Mostrar input1
            input2.disabled = false; // Mostrar input2
            input3.disabled = false; // Mostrar input2
            input4.disabled = false; // Mostrar input2
        } else {
            input1.disabled = true; // Ocultar input1
            input2.disabled = true; // Ocultar input2
            input3.disabled = true; // Ocultar input2
            input4.disabled = true; // Ocultar input2
        }
    } else {
        console.error("Uno o más elementos no fueron encontrados en el DOM.");
    }
}

