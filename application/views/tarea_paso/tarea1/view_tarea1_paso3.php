<div>
    <h2>Fase en la que se encuentra el producto</h2>
</div>
<hr>
<?php //Muestra cartel exito/error
    if ($this->session->flashdata('ExitoPart')){ ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('ExitoPart'); ?>
        </div>
    <?php } else { 
        if ($this->session->flashdata('ErrorPart')){?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('ErrorPart'); ?>    
            </div>
    <?php } 
    }
?>  
<div class="col-lg-12">
      <form class="form-horizontal" role="form">
        <div class="form-group">  
            <div class="form-group">
                <div class="col-lg-12">
                    <span>Seleccione la fase en la que se encuentra el producto a evaluar: </span>
                </div>
            </div>                 
            <div class="form-group col-lg-12">
                <select class="form-control" id="partes">
                    <option value="0">Seleccione la fase del proyecto</option>
                    <?php foreach ($partes->result_array() as $p){ 
                        if (($p['idParte']) == $parte_seleccionada){?>
                            <option value="<?php echo $p['idParte']?>" selected><?php echo $p['parte']?></option>
                  <?php }else{ ?>
                            <option value="<?php echo $p['idParte']?>"><?php echo $p['parte']?></option>
                    <?php }} ?>
                </select>    
            </div>
        </div>
          
        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-4">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Atrás</button>
                    <button type="button" class="btn btn-warning">Agregar nota</button>
                    <button type="button" class="btn btn-success" id="guardar" onclick="guardar_1_3()">Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>