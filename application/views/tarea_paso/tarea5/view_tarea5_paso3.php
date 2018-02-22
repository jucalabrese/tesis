<div>
    <h2>Tratamiento de datos</h2>
</div>
<hr>
<div>
    <?php //Muestra cartel exito/error
        if ($this->session->flashdata('ExitoTratamiento')){ ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('ExitoTratamiento'); ?>
            </div>
        <?php } else { 
            if ($this->session->flashdata('ErrorTratamiento')){?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('ErrorTratamiento'); ?>    
                </div>
        <?php } 
        }
    ?>  
</div>
<div class="form-group">
    <div class="form-group">
        <span>Seleccione la opción deseada para el tratamiento de los datos de la evaluación:</span>
    </div>
    <div class="form-group">
        <select class="form-control" id="tratamiento">
            <option value="0">Seleccione una opción</option>
    <?php   foreach ($estados->result_array() as $e){ 
                if (($idTratamiento == $e['idEstadoEvaluacion']) & ($e['idEstadoEvaluacion'] <> 1)){ ?>
                    <option value="<?php echo $e['idEstadoEvaluacion']?>" selected><?php echo $e['estado']?></option>   
                <?php }else{
                    if (($e['idEstadoEvaluacion'] <> 1)){ ?>
                        <option value="<?php echo $e['idEstadoEvaluacion']?>"><?php echo $e['estado']?></option>
           <?php    }}} ?>
        </select>
    </div>
    <hr>
    <div class="form-group">
        <div class="col-lg-6 col-lg-offset-4">
            <div class="btn-group">
                <button type="button" class="btn btn-danger">Atrás</button>
                <button type="button" class="btn btn-success" id="guardar" onclick="guardar_5_3()">Guardar</button>
            </div>
        </div>
    </div>

</div>