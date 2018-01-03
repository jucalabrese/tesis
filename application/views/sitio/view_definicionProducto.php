<?php //Muestra cartel exito/error
        if ($this->session->flashdata('Exito')){ ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('Exito'); ?>
            </div>
        <?php } else { 
            if ($this->session->flashdata('Error')){?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('Error'); ?>    
                </div>
        <?php } 
} ?>
<div>
    <h2>Definición del producto</h2>
</div>
<hr>
<div class="col-lg-12">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <span class="col-lg-2">Nombre:</span>
            <div class="col-lg-10">
                <input id="nombre" type="text" class="form-control" placeholder="Ingrese un nombre de producto" value="<?php echo $nombre?>">
            </div>
        </div>
        
        <div class="form-group">
            <span class="col-lg-2">Descripción:</span>
            <div class="col-lg-10">
                <textarea id="descripcion" class="form-control text_area" rows="8" placeholder="Ingrese una descripción"><?php echo $descripcion?></textarea>
            </div>
        </div>

      <div class="form-group">
        <div class="col-lg-5 col-lg-offset-5">
            <div class="btn-group">
                <button type="button" class="btn btn-success" id="guardar" onclick="guardarProducto()">Guardar</button>
                <button type="button" class="btn btn-default" id="volver" onclick="window.location.href='<?php echo base_url()?>evaluacion/evaluaciones'">Regresar</button>
            </div>
        </div>
      </div>
    </form>
</div>