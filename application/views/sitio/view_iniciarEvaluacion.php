<div class="col-lg-10 col-lg-offset-1 misEval_padding">
    <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url(); ?>" />
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
                <a href="#" class="list-group-item color_menu" onclick="cargarVistaIntroducción()"><strong>Introducción - Norma ISO/IEC 25040</strong></a>
                <a id="definicion_producto" href="#" class="list-group-item list-group-item-danger" onclick="cargarVistaDefinicion()"><strong>Definición del producto</strong></a>
                <a href="#item1" class="list-group-item color_menu menu_index" data-parent="#MainMenu" onclick="cargarVistaTareas_1_0()"><strong>1. Establecer requisitos de la evaluación</strong></a>
                <div class="collapse" id="item1">
                    <a id="11" href="#" class="list-group-item" onclick="cargarVistaTareas_1_1()">1.1. Establecer el propósito de la evaluación</a>
                    <a id="12" href="#" class="list-group-item" onclick="cargarVistaTareas_1_2()">1.2. Obtener los requisitos de calidad del producto</a>
                    <a id="13" href="#" class="list-group-item" onclick="cargarVistaTareas_1_3()">1.3. Identificar las partes del producto que se deben evaluar</a>
                    <a id="14" href="#" class="list-group-item" onclick="cargarVistaTareas_1_4()">1.4. Definir el rigor de la evaluación</a>
                </div>
                <a href="#item2" class="list-group-item color_menu menu_index" data-parent="#MainMenu" onclick="cargarVistaTareas_2_0()"><strong>2. Especificar la evaluación</strong></a>
                <div class="collapse" id="item2">
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_2_1()">2.1. Seleccionar los módulos de evaluación</a>
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_2_2()">2.2. Definir los criterios de decisión para las métricas</a>
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_2_3()">2.3. Definir los criterios de decisión de la evaluación</a>
                </div>
                <a href="#item3" class="list-group-item color_menu menu_index" data-parent="#MainMenu" onclick="cargarVistaTareas_3_0()"><strong>3. Diseñar la evaluación</strong></a>
                <div class="collapse" id="item3">
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_3_1()">3.1. Planificar las actividades de la evaluación</a>
                </div>
                <a href="#item4" class="list-group-item color_menu menu_index" data-parent="#MainMenu" onclick="cargarVistaTareas_4_0()"><strong>4. Ejecutar la evaluación</strong></a>
                <div class="collapse" id="item4">
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_4_1()">4.1. Realizar las mediciones</a>
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_4_2()">4.2. Aplicar los criterios de decisión para las métricas</a>
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_4_3()">4.3. Aplicar los criterios de decisión de la evaluación</a>
                </div>
                <a href="#item5" class="list-group-item color_menu menu_index" data-parent="#MainMenu" onclick="cargarVistaTareas_5_0()"><strong>5. Concluir la evaluación</strong></a>
                <div class="collapse" id="item5">
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_5_1()">5.1. Revisar los resultados de la evaluación</a>
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_5_2()">5.2. Crear el informe de evaluación</a>
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_5_3()">5.3. Revisar la calidad de la evaluación y obtener feedback</a>
                    <a href="#" class="list-group-item" onclick="cargarVistaTareas_5_4()">5.4. Tratar los datos de la evaluación</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8" id="contenido">
            <?php echo $contenido; ?>
        </div>
    </div>
</div>