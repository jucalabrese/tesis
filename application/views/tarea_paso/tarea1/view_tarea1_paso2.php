<div>
    <h2>Tarea 1.2: Obtener los requisitos de calidad del producto</h2>
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
    $atributosSeleccionados = array();
    $cant = 0;
    if ($atributos_seleccionados <> null){
        foreach ($atributos_seleccionados as $atr){
            $atributosSeleccionados[$cant] = $atr;
            $cant++;
        }
    }
    ?>  
<div class="col-lg-12">
      <form class="form-horizontal" role="form">
        
        <div class="form-group">
            <div class="col-lg-12">
                    <span>     
                        Incluir un texto inicial:
                    </span>
                </div>
        </div>
          
        <div class="form-group">
            <div class="col-lg-12">
                <textarea class="form-control text_area" id="texto" rows="6" placeholder="Ingrese un texto inicial"><?php echo $texto?></textarea>
            </div>
        </div>
          
        <div class="form-group">
            <div class="col-lg-12">
                <span class="lead">Seleccione los atributos a utilizar en la evaluación: </span>
            </div>
        </div>
        <?php foreach ($atributos->result_array() as $atr){
            if ($atributosSeleccionados <> null){
                if (in_array($atr['idAtributo'], $atributosSeleccionados)){?>           
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" checked value="<?php echo $atr['idAtributo']?>" id="atributos" name="atributos">
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
                                <input type="checkbox" value="<?php echo $atr['idAtributo']?>" id="atributos" name="atributos">
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
                                <input type="checkbox" value="<?php echo $atr['idAtributo']?>" id="atributos" name="atributos">
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