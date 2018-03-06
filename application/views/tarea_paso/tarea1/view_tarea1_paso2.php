<div>
    <h2>Características a evaluar del producto de software</h2>
</div>
<hr>
    <?php //Muestra cartel exito/error
            if ($this->session->flashdata('ExitoCar')){ ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('ExitoCar'); ?>
                </div>
            <?php } else { 
                if ($this->session->flashdata('ErrorCar')){?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('ErrorCar'); ?>    
                    </div>
            <?php } 
            }
    ?>  
<div class="col-lg-12">
      <form class="form-horizontal" role="form">
        <div class="form-group"> 
            <div class="form-group">
                <div class="col-lg-12">
                    <span>Seleccione una o más características a evaluar: </span>
                </div>
            </div>
            <?php foreach ($caracteristicas->result_array() as $atr){
                    if (in_array($atr['idCaracteristica'], $caracteristicas_seleccionadas)){?> <!-- SI LA CARACTERISTICA FUE UNA DE LAS ELEGIDAS POR EL USUARIO -->          
                        <div class="form-group">
                                <div class="checkbox col-md-12">
                                    <label> <!-- MARCARLA COMO SELECCIONADA -->
                                        <input type="checkbox" checked value="<?php echo $atr['idCaracteristica']?>" id="caracteristicas" name="caracteristicas">
                                        <?php echo $atr['nombre']?>
                                    </label>   
                            </div>
                        </div>
            <?php   }else{ ?>
                    <div class="form-group"> <!-- SI NO FUE ELEGIDA, MOSTRARLA NORMAL -->
                            <div class="checkbox col-md-12">
                                <label>
                                    <input type="checkbox" value="<?php echo $atr['idCaracteristica']?>" id="caracteristicas" name="caracteristicas">
                                    <?php echo $atr['nombre']?>
                                </label>
                            </div>    
                    </div>
            <?php }} ?> 

            <hr>
            <span>Nota: Las características se encuentran definidas en el modelo de calidad brindado por la norma ISO/IEC 25010.</span>
        </div>
        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-4">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger" onclick="cargarVistaTareas_1_1()">Atrás</button>
                    <button type="button" class="btn btn-success" id="guardar" onclick="guardar_1_2()">Guardar</button>
                </div>
            </div>
        </div>
          
    </form>
</div>