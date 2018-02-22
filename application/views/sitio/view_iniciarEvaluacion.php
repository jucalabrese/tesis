<div class="col-lg-10 col-lg-offset-1 misEval_padding">
    <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url(); ?>" />
    <?php //Muestra cartel exito/error
        if ($this->session->flashdata('ExitoInicio')){ ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('ExitoInicio'); ?>
            </div>
        <?php } else { 
            if ($this->session->flashdata('ErrorInicio')){?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('ErrorInicio'); ?>    
                </div>
        <?php } 
        }
    ?>  
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" id="nombre_producto">Nombre del producto
                <small>Evaluación</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>/../inicio/index">Inicio</a>
                </li>
                <li class="active">Evaluación</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="list-group">
                <!-- <a href="#demo4" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">1. Establecer requisitos de la evaluación</a> -->
                <a id="definicion_producto" href="#" class="list-group-item list-group-item-danger" onclick="cargarVistaDefinicion()"><strong>Definición del producto</strong></a>
                <a href="#item1" class="list-group-item color_menu menu_index" data-parent="#MainMenu" data-toggle="collapse" onclick="cargarVistaTareas_1_0()"><strong>1. Establecer requisitos de la evaluación</strong></a>
                <div class="collapse" id="item1">
                    <a id="11" href="#" class="list-group-item" onclick="cargarVistaTareas_1_1()">- Propósito de la evaluación</a>
                    <a id="12" href="#" class="list-group-item" onclick="cargarVistaTareas_1_2()">- Características a evaluar</a>
                    <a id="13" href="#" class="list-group-item" onclick="cargarVistaTareas_1_3()">- Fase en la que se encuentra el producto</a>
                    <a id="14" href="#" class="list-group-item" onclick="cargarVistaTareas_1_4()">- Rigor de la evaluación</a>
                </div>
                <a href="#item2" class="list-group-item color_menu menu_index" data-parent="#MainMenu" data-toggle="collapse" onclick="cargarVistaTareas_2_0()"><strong>2. Especificar la evaluación</strong></a>
                <div class="collapse" id="item2">
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_2_1()">- Subcaracterísticas a evaluar</a>
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_2_2()">- Criterios de decisión de las subcaracterísticas</a>
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_2_3()">- Criterios de decisión de las características</a>
                </div>
                <a href="#item3" class="list-group-item color_menu menu_index" data-parent="#MainMenu" data-toggle="collapse" onclick="cargarVistaTareas_3_0()"><strong>3. Diseñar la evaluación</strong></a>
                <div class="collapse" id="item3">
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_3_1()">- Actividades de la evaluación</a>
                </div>
                <a href="#item4" class="list-group-item color_menu menu_index" data-parent="#MainMenu" data-toggle="collapse" onclick="cargarVistaTareas_4_0()"><strong>4. Ejecutar la evaluación</strong></a>
                <div class="collapse" id="item4">
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_4_1()">- Mediciones</a>
                </div>
                <a href="#item5" class="list-group-item color_menu menu_index" data-parent="#MainMenu" data-toggle="collapse" onclick="cargarVistaTareas_5_0()"><strong>5. Concluir la evaluación</strong></a>
                <div class="collapse" id="item5">
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_5_1()">- Informe de la evaluación</a>
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_5_2()">- Feedback de la evaluación</a>
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_5_3()">- Tratamiento de datos</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8" id="contenido">
            <?php echo $contenido; ?>
        </div>
    </div>
</div>