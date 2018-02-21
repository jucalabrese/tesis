<div>
    <h2>Subcaracterísticas a evaluar</h2>
</div>
<hr>
<?php //Muestra cartel exito/error
    if ($this->session->flashdata('ExitoSubcar')){ ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('ExitoSubcar'); ?>
        </div>
    <?php } else { 
        if ($this->session->flashdata('ErrorSubcar')){?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('ErrorSubcar'); ?>    
            </div>
    <?php } 
    }
?>  
<div>
    <div class="form-group">
        <span>Seleccione una característica:</span>
    </div>
    <div class="form-group">
        <select class="form-control" id="caracteristica" onchange="cargarSubcaracteristicas(value)">
            <option value="0" onclick="cargarVistaTareas_2_1(0)">Seleccione una característica</option>
    <?php   foreach ($caracteristicas->result_array() as $c){ ?>
                <option value="<?php echo $c['idCaracteristica']?>"><?php echo $c['nombre']?></option>      
    <?php   } ?>       
        </select>
    </div>
    <div id="subcaracteristicas" style="display: none;">
        <div class="form-group">
            <div class="col-lg-12">
                <span>Seleccione una o más subcaracterísticas a evaluar: </span>
            </div>
        </div>
        <?php if (!empty($subcaracteristicas)){
        foreach ($subcaracteristicas->result_array() as $sub){
                if (in_array($sub['idSubcaracteristica'], $scseleccionadas)){?> <!-- SI LA CARACTERISTICA FUE UNA DE LAS ELEGIDAS POR EL USUARIO -->          
                    <div class="form-group">
                            <div class="checkbox col-md-12">
                                <label> <!-- MARCARLA COMO SELECCIONADA -->
                                    <input type="checkbox" checked value="<?php echo $sub['idSubcaracteristica']?>" id="subcaracteristicas" name="subcaracteristicas">
                                    <?php echo $sub['nombre']?>
                                </label>   
                            </div>
                    </div>
        <?php   }else{ ?>
                <div class="form-group"> <!-- SI NO FUE ELEGIDA, MOSTRARLA NORMAL -->
                        <div class="checkbox col-md-12">
                            <label>
                                <input type="checkbox" value="<?php echo $sub['idSubcaracteristica']?>" id="subcaracteristicas" name="subcaracteristicas">
                                <?php echo $sub['nombre']?>
                            </label>
                        </div>    
                </div>
        <?php }}} ?> 

        <hr>
        <span>Nota: Las subcaracterísticas se encuentran definidas en el modelo de calidad brindado por la norma ISO/IEC 25010.</span>
    </div>
<div class="form-group">
    <div class="col-lg-6 col-lg-offset-4">
        <div class="btn-group">
            <button type="button" class="btn btn-danger">Atrás</button>
            <button type="button" class="btn btn-warning">Agregar nota</button>
            <button type="button" class="btn btn-success" id="guardar" onclick="guardar_2_1()">Guardar</button>
        </div>
    </div>
</div>
</div>

