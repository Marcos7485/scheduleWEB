// $(document).ready(function () {
//     $('#disp-horaria').DataTable({
//         paging: false,
//         searching: false,
//         ordering: false,
//         language: {
//             info: "",
//             infoEmpty: "",
//         }
//     });
// });

$(document).ready(function () {
    $('#turnos-delete').DataTable({
        paging: true,
        pageLength: 5,
        lengthChange: false, // Deshabilita la opción para cambiar el número de entradas por página
        searching: true,
        ordering: false,
        language: {
            info: "",
            infoEmpty: "",
        }
    });
});

$(document).ready(function () {
    $('#turnos-list').DataTable({
        paging: true,
        pageLength: 5,
        lengthChange: false, // Deshabilita la opción para cambiar el número de entradas por página
        searching: false,
        ordering: false,
        language: {
            info: "",
            infoEmpty: "",
        }
    });
});

$(document).ready(function () {
    $('#turnos-hoycel').DataTable({
        paging: true,
        pageLength: 5,
        lengthChange: false, // Deshabilita la opción para cambiar el número de entradas por página
        searching: false,
        ordering: false,
        language: {
            info: "",
            infoEmpty: "",
        }
    });
});

$(document).ready(function () {
    $('#turnos-week').DataTable({
        paging: true,
        pageLength: 5,
        lengthChange: false, // Deshabilita la opción para cambiar el número de entradas por página
        searching: false,
        ordering: true,
        order: [[0, 'asc']], // Ordenar por la segunda columna (índice 1) de forma ascendente
        language: {
            info: "",
            infoEmpty: "",
        }
    });
});

$(document).ready(function () {
    $('#turnos-weekcel').DataTable({
        paging: true,
        pageLength: 5,
        lengthChange: false, // Deshabilita la opción para cambiar el número de entradas por página
        searching: false,
        ordering: false,
        order: [[0, 'asc']], // Ordenar por la segunda columna (índice 1) de forma ascendente
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



