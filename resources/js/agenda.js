
//funcionalidad de calendar

document.addEventListener('DOMContentLoaded', function () {

    let formulario = document.querySelector("#formularioEventos"); //busca el formulario por su id

    var calendarEl = document.getElementById('agenda'); //busca el div y lo convierte en una agenda
    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',



        //opciones de calendario
        locale: "es", //idioma español
        displayEventTime: false, //muestra la hora del evento

        headerToolbar: {
            left: 'prev,next today', //botones de navegación
            center: 'title', //titulo del calendario
            right: 'dayGridMonth,' //vistas del calendario
        },


        //events: "http://localhost/TerAmiWeb/public/evento/mostrar", //url para obtener los eventos del calendario
//es lo mismo pero con el metodo POST
        eventSources:{
            url: baseURL + "/evento/mostrar", //url para obtener los eventos del calendario
            method:'POST', //metodo para obtener los eventos del calendario
            extraParams:{
                _token: formulario._token.value, //token para la seguridad del formulario
            }
        },



        // Abrir modal para aoprimir el dia del calendario
        dateClick: function (info) {

            formulario.reset(); //resetea el formulario

            formulario.start.value = info.dateStr; //asigna la fecha seleccionada al input start
            formulario.end.value = info.dateStr; //asigna la fecha seleccionada al input end

            //esta es la funcionalidad de oprimir el recuadro y aparece el formulario
            var modalEl = document.getElementById('evento'); //Obtiene el elemento del DOM que tiene el id "evento" (ese debe ser tu modal)
            var modal = new bootstrap.Modal(modalEl); //Crea una nueva instancia del modal Bootstrap usando ese elemento
            modal.show();  //Muestra el modal en pantalla
            // intrucciones del calendario $("#evento").modal("show"); //muestra el modal, pero no me funciono

        },

        //funcionalidad para editar el evento

        eventClick: function (info) {

            var evento = info.event; //obtiene el evento
            console.log(evento); //muestra el evento en la consola


            axios.post(baseURL+"/evento/editar/" + info.event.id). //envia los datos al servidor utilizando un parametro info.event.id porque es el post id 
                then(
                    (respuesta) => {
                        //recupera los datos del evento
                        formulario.id.value = respuesta.data.id;
                        formulario.title.value = respuesta.data.title

                        formulario.descripcion.value = respuesta.data.descripcion;

                        formulario.start.value = respuesta.data.start;
                        formulario.end.value = respuesta.data.end;

                        var modalEl = document.getElementById('evento'); //Obtiene el elemento del DOM que tiene el id "evento" (ese debe ser tu modal)
                        var modal = new bootstrap.Modal(modalEl); //Crea una nueva instancia del modal Bootstrap usando ese elemento
                        modal.show();
                    }
                ).catch(
                    error => {
                        if (error.response) {
                            console.log(error.response.data); //muestra el error en la consola
                        }
                    }
                )

        }//funcionalidad de editar evento

    }); // intrucciones del calendario

    calendar.render(); //mostrar el calendario



    document.getElementById('btnGuardar').addEventListener("click", function () {

        enviarDatos("/evento/agregar"); //la ruta de guardar

    }); //boton guardar


    document.getElementById('btnEliminar').addEventListener("click", function () {

        enviarDatos("/evento/borrar/" + formulario.id.value); //la ruta de eliminar

    }); //boton eliminar

    document.getElementById('btnModificar').addEventListener("click", function () {

        enviarDatos("/evento/actualizar/" + formulario.id.value); //la ruta de actualizar

    }); //boton actualizar

    function enviarDatos(url) {

        const datos = new FormData(formulario); //obtiene los datos del formulario

        const nuevaURL = baseURL + url; //obtiene la url base(baseURL) del proyecto para adicionar las otras, asi queda un solo url

        axios.post(nuevaURL, datos). //envia los datos al servidor 
            then(
                (respuesta) => {
                    calendar.refetchEvents(); //recarga los eventos
                    const modalEl = document.getElementById('evento');//modalEl → significa “modal element”.
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    modal.hide();//oculta el modal 
                }
            ).catch(
                error => {
                    if (error.response) { console.log(error.response.data); }//muestra el error en la consola
                }
            )

    }


}); //esta funcion se ejecuta cuando el DOM se ha cargado completamente, 