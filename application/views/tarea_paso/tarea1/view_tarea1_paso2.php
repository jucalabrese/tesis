<div>
    <h2>Características a evaluar</h2>
</div>
<hr>
    <?php //Muestra cartel exito/error
            if ($this->session->flashdata('ExitoAtr')){ ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('ExitoAtr'); ?>
                </div>
            <?php } else { 
                if ($this->session->flashdata('ErrorAtr')){?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('ErrorAtr'); ?>    
                    </div>
            <?php } 
            }
    $caracteristicasSeleccionadas = array();
    $cant = 0;
    if ($caracteristicas_seleccionadas <> null){
        foreach ($caracteristicas_seleccionadas as $atr){
            $caracteristicasSeleccionadas[$cant] = $atr;
            $cant++;
        }
    }
    ?>  
<div class="col-lg-12">
      <form class="form-horizontal" role="form">
        <div class="form-group">
            <div class="col-lg-12">
                <span class="lead">Seleccione las características a utilizar en la evaluación: </span>
            </div>
        </div>
        <?php foreach ($caracteristicas->result_array() as $atr){
            if ($caracteristicasSeleccionadas <> null){
                if (in_array($atr['idCaracteristica'], $caracteristicasSeleccionadas)){?>           
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" checked value="<?php echo $atr['idCaracteristica']?>" id="caracteristicas" name="caracteristicas">
                                    <?php echo $atr['nombre']?>
                                </label>
                            </div>    
                        </div>
                    </div>
        <?php }else{ ?>
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="<?php echo $atr['idCaracteristica']?>" id="caracteristicas" name="caracteristicas">
                                <?php echo $atr['nombre']?>
                            </label>
                        </div>    
                    </div>
                </div>
        <?php }}else{ ?>
            <div class="form-group">
                    <div class="col-lg-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="<?php echo $atr['idCaracteristica']?>" id="caracteristicas" name="caracteristicas">
                                <?php echo $atr['nombre']?>
                            </label>
                        </div>    
                    </div>
            </div>
        <?php }} ?> 

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-4">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Atrás</button>
                    <button type="button" class="btn btn-warning">Agregar nota</button>
                    <button type="button" class="btn btn-success" id="guardar" onclick="guardar_1_2()">Guardar</button>
                </div>
            </div>
        </div>
          
    </form>
</div>