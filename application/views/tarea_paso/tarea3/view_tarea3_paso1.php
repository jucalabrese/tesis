<div>
    <h2>Actividades de la evaluación</h2>
</div>
<hr>
<?php //Muestra cartel exito/error
    if ($this->session->flashdata('ExitoActividades')){ ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('ExitoActividades'); ?>
        </div>
    <?php } else { 
        if ($this->session->flashdata('ErrorActividades')){?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('ErrorActividades'); ?>    
            </div>
    <?php } 
} ?>
<div class="col-lg-12">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <span>Ingrese el plan de actividades de la evaluación:</span>
        </div>
        <div class="form-group">
            <textarea class="form-control text_area" rows="15" id="actividades" placeholder="Tener en cuenta blablabla"><?php //echo $proposito?></textarea>      
        </div>

      <div class="form-group">
        <div class="col-lg-7 col-lg-offset-4">
            <div class="btn-group">
                <button type="button" class="btn btn-danger">Atrás</button>
                <button type="button" class="btn btn-warning">Agregar nota</button>
                <button type="button" class="btn btn-success" id="guardar" onclick="guardar_3_1()">Guardar</button>
            </div>
        </div>
      </div>
          
    </form>
</div>