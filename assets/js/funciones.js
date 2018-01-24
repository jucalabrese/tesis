
// INICIO DE LAS FUNCIONES QUE CARGAN VISTAS

function cargarVistaTareas_1_0(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/1/0',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_1_1(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/1/1',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_1_2(){
    var base_url = document.getElementById('baseurl').value;
    
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/1/2',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_1_3(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/1/3',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_1_4(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/1/4',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_2_0(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/2/0',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_2_1(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/2/1',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_2_2(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/2/2',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_2_3(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/2/3',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_3_0(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/3/0',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_3_1(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/3/1',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_4_0(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/4/0',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_4_1(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/4/1',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_4_2(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/4/2',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_4_3(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/4/3',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_5_0(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/5/0',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_5_1(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/5/1',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_5_2(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/5/2',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_5_3(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/5/3',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaTareas_5_4(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/tarea_paso/5/4',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaIntroducción(){
    var base_url = document.getElementById('baseurl').value;
    $.ajax({
        url: base_url+'/evaluacion/introduccion_evaluacion',
        type:'POST',
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
};

function cargarVistaDefinicion(nombre, descripcion){
    var base_url = document.getElementById('baseurl').value;
    //CREAR SESION SI NO EXISTE CON ID DE EVALUACION Y SI EXISTE DESTRUIRLA Y TMB CREAR NUEVA
    $.ajax({
        url: base_url+'/evaluacion/definicion_producto',
        type:'POST',
        data: {nombre: nombre, descripcion: descripcion},
        success: function(output_string){
            $('#contenido').html(output_string);
        } 
    });
    
};

// FIN DE LAS FUNCIONES QUE CARGAN VISTAS

function contenido(){
    $('[data-toggle="popover"]').popover();
};


function ocultarTablasRigor(){
    $("#tablas").slideToggle();
};

function guardar($tarea, $paso){
    var base_url = document.getElementById('baseurl').value;
    var nombre = document.getElementById('nombre').value;
    var descripcion = document.getElementById('descripcion').value;
    
    $.ajax({
        type:'POST',
        url: base_url+'/evaluacion/guardar'+$tarea+'/'+$paso,
        data: {nombre: nombre, descripcion: descripcion},

        success: function(output_string){
            $("#contenido").html(output_string);
        }
    });
}

function guardarProducto(){
    var base_url = document.getElementById('baseurl').value;
    var nombre = document.getElementById('nombre').value;
    var descripcion = document.getElementById('descripcion').value;

    $.ajax({
        type:'POST',
        url: base_url+'evaluacion/guardarProducto',
        data: {nombre: nombre, descripcion: descripcion},
        
        success: function(output_string){
            if (nombre!=''){
                $('#definicion_producto').attr({
                    'class': 'list-group-item list-group-item-success',
                });
                
//                $('.menu_index').attr({
//                    'data-toggle': 'collapse',
//                });  
                
                document.getElementById('nombre_producto').innerHTML = nombre + '<small> Evaluación</small>';  
            };
            $("#contenido").html(output_string);
            
        }
    });
};

function guardar_1_1(){
    var base_url = document.getElementById('baseurl').value;
    var proposito = document.getElementById('proposito').value;

    $.ajax({
        type:'POST',
        url: base_url+'evaluacion/guardado/1/1',
        data: {proposito: proposito},
        
        success: function(output_string){
            if (proposito!=''){
                $('#11').attr({
                    'class': 'list-group-item list-group-item-success',
                });
            };
            $("#contenido").html(output_string);
        }
    });
};

function guardar_1_2(){
    var base_url = document.getElementById('baseurl').value;
    var texto = document.getElementById('texto').value;
    var caracteristicas = [];
    
    
    $("#caracteristicas:checked").each(function(){
        if (this.checked){
            caracteristicas.push($(this).val());
        }
    }); 
    
    $.ajax({
        type:'POST',
        url: base_url+'evaluacion/guardado/1/2',
        data: {car: caracteristicas, text: texto},
        
        success: function(output_string){

            if (caracteristicas!=''){
                $('#12').attr({
                    'class': 'list-group-item list-group-item-success',
                });
            };

            $("#contenido").html(output_string);
        }
    });
};

function guardar_1_3(){
    var base_url = document.getElementById('baseurl').value;
    var parte = document.getElementById('partes').value;
	
    $.ajax({
        type:'POST',
        url: base_url+'evaluacion/guardado/1/3',
        data: {parte: parte},
        
        success: function(output_string){
            if (parte!=1){
                $('#13').attr({
                    'class': 'list-group-item list-group-item-success',
                });
            };
            $("#contenido").html(output_string);
        }
    });
};

function guardar_1_4(){
   var base_url = document.getElementById('baseurl').value;
    var seguridad_fisica = document.getElementById('seguridad_fisica').value;
    var economico = document.getElementById('economico').value;
    var seguridad_acceso = document.getElementById('seguridad_acceso').value;
	
    $.ajax({
        type:'POST',
        url: base_url+'evaluacion/guardado/1/4',
        data: {seguridad_fisica: seguridad_fisica,economico:economico,seguridad_acceso:seguridad_acceso},
        
        success: function(output_string){
            $('#14').attr({
                    'class': 'list-group-item list-group-item-success',
                });
            $("#contenido").html(output_string);
        }
    });
};

function guardar_niveles(subcaracteristica) {
    var base_url = document.getElementById('baseurl').value;
	var inaceptable = document.getElementById('inaceptable').value;
	var min_aceptable = document.getElementById('min_aceptable').value;
	var aceptable = document.getElementById('aceptable').value;
	var excede = document.getElementById('excede').value;
    $.ajax({
        type: 'POST',
        url: base_url + 'evaluacion/guardado/2/2',
        data: {subcaracteristica: subcaracteristica, inaceptable: inaceptable, min_aceptable: min_aceptable, aceptable: aceptable, excede: excede},
        success: function (output_string) {
			$('#22').attr({
                    'class': 'list-group-item list-group-item-success',
                });
            $("#contenido").html(output_string);
        }
    });
}
;