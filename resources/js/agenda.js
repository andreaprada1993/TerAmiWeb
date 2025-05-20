
//funcionalidad de calendar


document.addEventListener('DOMContentLoaded', function () {

    let formulario = document.querySelector("form"); //busca el formulario por su id

    var calendarEl = document.getElementById('agenda'); //busca el div y lo convierte en una agenda
    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',



        //opciones de calendario
        locale: "es", //idioma español

        headerToolbar: {
            left: 'prev,next today', //botones de navegación
            center: 'title', //titulo del calendario
            right: 'dayGridMonth,timeGridWeek,listWeek' //vistas del calendario
        },

        // Abrir modal para aoprimir el dia del calendario
        dateClick: function (info) {
            var modalEl = document.getElementById('evento'); //Obtiene el elemento del DOM que tiene el id "evento" (ese debe ser tu modal)
            var modal = new bootstrap.Modal(modalEl); //Crea una nueva instancia del modal Bootstrap usando ese elemento
            modal.show();  //Muestra el modal en pantalla
        }

    }); // intrucciones del calendario

    calendar.render(); //mostrar el calendario

    document.getElementById('btnGuardar').addEventListener('click', function () {
        const datos = new FormData(formulario); //obtiene los datos del formulario

        console.log(datos); //muestra los datos en la consola
        console.log(formulario.title.value); //muestra el valor del input title en la consola

        axios.post("http://localhost/TerAmiWeb/public/evento/agregar", datos). //envia los datos al servidor
            then(
                (respuesta) => {
                    modal.hide(); //oculta el modal, // aqui quede ojo andrea el error es 422 y no te deja guardar
                }
            ).catch(
                error => {
                    if (error.response) {
                        console.log(error.response.data); //muestra el error en la consola
                    }
                }
            )
    }); //boton guardar

});