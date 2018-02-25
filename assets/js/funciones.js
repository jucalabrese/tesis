
// INICIO DE LAS FUNCIONES QUE CARGAN VISTAS

function cargarVistaTareas_1_0() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/1/0',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;


function cargarVistaTareas_1_2() {
    var base_url = document.getElementById('baseurl').value;

    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/1/2',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_1_3() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/1/3',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_1_4() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/1/4',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_2_0() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/2/0',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_2_1() {
    var base_url = document.getElementById('baseurl').value;
    
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/2/1',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_2_2() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/2/2',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarCriteriosSubcaracteristicas(carac) {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/2/2',
        type: 'POST',
        data: {carac: carac},
        success: function (output_string) {
            $("#criterios").slideUp('slow');
            $('#contenido').html(output_string);
            if (carac != 0) {
                $("#criterios").slideDown('slow');
            }
        }
    });
}
;

function cargarVistaTareas_2_3() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/2/3',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_3_0() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/3/0',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_3_1() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/3/1',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_4_0() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/4/0',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_4_1() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/4/1',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);

        }
    });
}
;

function cargarPreguntas(value) {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/4/1',
        type: 'POST',
        data: {valor: value},
        success: function (output_string) {
            $("#preguntas").slideUp('slow');
            $('#contenido').html(output_string);
            if (value != 0) {
                $("#preguntas").slideDown('slow');
            }
        }
    });
};

function cargarSubcaracteristicas(value) {
    var base_url = document.getElementById('baseurl').value;

    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/2/1',
        type: 'POST',
        data: {valor: value},
        success: function (output_string) {
            $("#subcaracteristicas").slideUp('slow');
            $('#contenido').html(output_string);
            if (value != 0) {
                $("#subcaracteristicas").slideDown('slow');
            }
        }
    });
};

function cargarVistaTareas_1_1() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/1/1',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_5_0() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/5/0',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_5_1() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/calculo_criterios/cargarResultadosCriterios',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_5_2() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/5/2',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_5_3() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/5/3',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaTareas_5_4() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/tarea_paso/5/4',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaIntroducción() {
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url + '/evaluacion/introduccion_evaluacion',
        type: 'POST',
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });
}
;

function cargarVistaDefinicion(nombre, descripcion) {
    var base_url = document.getElementById('baseurl').value;
    //CREAR SESION SI NO EXISTE CON ID DE EVALUACION Y SI EXISTE DESTRUIRLA Y TMB CREAR NUEVA
    $.ajax({
        url: base_url + '/evaluacion/definicion_producto',
        type: 'POST',
        data: {nombre: nombre, descripcion: descripcion},
        success: function (output_string) {
            $('#contenido').html(output_string);
        }
    });

}
;

// FIN DE LAS FUNCIONES QUE CARGAN VISTAS

function contenido() {
    $('[data-toggle="popover"]').popover();
}
;


function ocultarTablasRigor() {
    $("#tablas").slideToggle();
}
;

function guardar($tarea, $paso) {
    var base_url = document.getElementById('baseurl').value;
    var nombre = document.getElementById('nombre').value;
    var descripcion = document.getElementById('descripcion').value;

    $.ajax({
        type: 'POST',
        url: base_url + '/evaluacion/guardar' + $tarea + '/' + $paso,
        data: {nombre: nombre, descripcion: descripcion},

        success: function (output_string) {
            $("#contenido").html(output_string);
        }
    });
}

function guardarProducto() {
    var base_url = document.getElementById('baseurl').value;
    var nombre = document.getElementById('nombre').value;
    var descripcion = document.getElementById('descripcion').value;

    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardarProducto',
        data: {nombre: nombre, descripcion: descripcion},

        success: function (output_string) {
            if (nombre != '') {
                $('#definicion_producto').attr({
                    'class': 'list-group-item list-group-item-success',
                });

//                $('.menu_index').attr({
//                    'data-toggle': 'collapse',
//                });  

                document.getElementById('nombre_producto').innerHTML = nombre + '<small> Evaluación</small>';
            }
            ;
            $("#contenido").html(output_string);

        }
    });
}
;

function guardar_1_1() {
    var base_url = document.getElementById('baseurl').value;
    var proposito = document.getElementById('proposito').value;

    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardado/1/1',
        data: {proposito: proposito},

        success: function (output_string) {
            if (proposito != '') {
                $('#11').attr({
                    'class': 'list-group-item list-group-item-success',
                });
            }
            ;
            $("#contenido").html(output_string);
        }
    });
}
;

function guardar_1_2() {
    var base_url = document.getElementById('baseurl').value;
    var caracteristicas = [];

    $("#caracteristicas:checked").each(function () {
        if (this.checked) {
            caracteristicas.push($(this).val());
        }
    });

    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardado/1/2',
        data: {car: caracteristicas},

        success: function (output_string) {
            if (caracteristicas != '') {
                $('#12').attr({
                    'class': 'list-group-item list-group-item-success',
                });
            }
            ;
            $("#contenido").html(output_string);
        }
    });
}
;

function guardar_1_3(){
    var base_url = document.getElementById('baseurl').value;
    var parte = document.getElementById('parte').value;

    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardado/1/3',
        data: {parte: parte},

        success: function (output_string) {
            if (parte != 0) {
                $('#13').attr({
                    'class': 'list-group-item list-group-item-success',
                });
            }
            ;
            $("#contenido").html(output_string);
        }
    });
};

function guardar_1_4() {
    var base_url = document.getElementById('baseurl').value;
    var seguridad_fisica = document.getElementById('seguridad_fisica').value;
    var economico = document.getElementById('economico').value;
    var seguridad_acceso = document.getElementById('seguridad_acceso').value;

    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardado/1/4',
        data: {seguridad_fisica: seguridad_fisica, economico: economico, seguridad_acceso: seguridad_acceso},

        success: function (output_string) {
            $('#14').attr({
                'class': 'list-group-item list-group-item-success',
            });
            $("#contenido").html(output_string);
        }
    });
}
;

function guardar_niveles(subcaracteristica,caracteristica) {
    var base_url = document.getElementById('baseurl').value;
    var inaceptable = document.getElementById('inaceptable').value;
    var min_aceptable = document.getElementById('min_aceptable').value;
    var aceptable = document.getElementById('aceptable').value;
    var excede = document.getElementById('excede').value;
    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardado/2/2',
        data: {subcaracteristica: subcaracteristica, caracteristica:caracteristica, inaceptable: inaceptable, min_aceptable: min_aceptable, aceptable: aceptable, excede: excede},
        success: function (output_string) {
            $('#22').attr({
                'class': 'list-group-item list-group-item-success',
            });
            $("#contenido").html(output_string);
            $("#criterios").show();
        }
    });
}
;

function mostrarPreguntas(value) {
    $("#preguntas").slideUp('slow');
    if (value != 0) {
        $("#preguntas").slideDown('slow');
    }
    ;
}
;

function guardar_2_1(caracteristica) {
    var base_url = document.getElementById('baseurl').value;
    var subcaracteristicas = [];

    $("#subcaracteristicas:checked").each(function () {
        if (this.checked) {
            subcaracteristicas.push($(this).val());
        }
    });

    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardarSubcaracteristicas',
        data: {subcar: subcaracteristicas, car: caracteristica},

        success: function (output_string){
        }
    });
}
;

function guardar_3_1() {
    var base_url = document.getElementById('baseurl').value;
    var actividades = document.getElementById('actividades').value;

    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardado/3/1',
        data: {actividades: actividades},
        success: function (output_string){
            $("#contenido").html(output_string);
        }
    });
}
;

function guardar_4_1() {
    var base_url = document.getElementById('baseurl').value;

    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardado/4/1',
        success: function (output_string) {
            $("#contenido").html(output_string);
        }
    });
}
;

function guardar_5_2() {
    var base_url = document.getElementById('baseurl').value;
    var feedback = document.getElementById('feedback').value;

    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardado/5/2',
        data: {feedback: feedback},
        success: function (output_string){
            $("#contenido").html(output_string);
        }
    });
}
;


function guardar_5_3() {
    var base_url = document.getElementById('baseurl').value;
    var tratamiento = document.getElementById('tratamiento').value;

    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardado/5/3',
        data: {tratamiento: tratamiento},
        success: function (output_string){
            $("#contenido").html(output_string);
        }
    });
}
;

function cargarRespuesta(pregunta) {
    var base_url = document.getElementById('baseurl').value;
    var respuesta = $("#respuestas" + pregunta).val();
    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardarRespuesta',
        data: {idPregunta: pregunta, respuesta: respuesta},
        success: function (output_string) {
            $("#sinrespuesta" + pregunta).remove();
            $("#respuesta" + pregunta).html("<span class='glyphicon glyphicon-ok' aria-hidden='true' style='color: green'></span>");
        }
    });
};

function cargarInaceptable(subcaracteristica) {
    var base_url = document.getElementById('baseurl').value;
    var nivel = $("#inaceptable" + subcaracteristica).val();
    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardarInaceptable',
        data: {idSubcaracteristica: subcaracteristica, nivel_inac: nivel},
        success: function (output_string) {
            $("#sin_inaceptable" + subcaracteristica).remove();
            $("#i" + subcaracteristica).attr({'style': 'background-color: #dff0d8;', }); 
        }
    });
};

function cargarMinAceptable(subcaracteristica) {
    var base_url = document.getElementById('baseurl').value;
    var nivel = $("#min_aceptable" + subcaracteristica).val();
    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardarMinAceptable',
        data: {idSubcaracteristica: subcaracteristica, nivel_minac: nivel},
        success: function (output_string) {
            $("#sin_minaceptable" + subcaracteristica).remove();
            $("#m" + subcaracteristica).attr({'style': 'background-color: #dff0d8;', });
        }
    });
};

function cargarAceptable(subcaracteristica) {
    var base_url = document.getElementById('baseurl').value;
    var nivel = $("#aceptable" + subcaracteristica).val();
    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardarAceptable',
        data: {idSubcaracteristica: subcaracteristica, nivel_acep: nivel},
        success: function (output_string) {
            $("#sin_aceptable" + subcaracteristica).remove();
             $("#a" + subcaracteristica).attr({'style': 'background-color: #dff0d8;', });
        }
    });
};

function cargarExcede(subcaracteristica) {
    var base_url = document.getElementById('baseurl').value;
    var nivel = $("#excede" + subcaracteristica).val();
    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardarExcede',
        data: {idSubcaracteristica: subcaracteristica, nivel_excede: nivel},
        success: function (output_string) {
            $("#sin_excede" + subcaracteristica).remove();
             $("#e" + subcaracteristica).attr({'style': 'background-color: #dff0d8;', });
        }
    });
};
