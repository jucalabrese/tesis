<div>
    <h2>Feedback de la evaluación</h2>
</div>
<hr>
<?php //Muestra cartel exito/error
    if ($this->session->flashdata('ExitoFeedback')){ ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('ExitoFeedback'); ?>
        </div>
    <?php } else { 
        if ($this->session->flashdata('ErrorFeedback')){?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('ErrorFeedback'); ?>    
            </div>
    <?php } 
} ?>
<div class="col-lg-12">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <span>Ingrese el feedback de la evaluación:</span>
        </div>
        <div class="form-group">
            <textarea class="form-control text_area" rows="12" id="feedback" placeholder="Tener en cuenta blablabla"><?php echo $feedback?></textarea>      
        </div>

      <div class="form-group">
        <div class="col-lg-7 col-lg-offset-4">
            <div class="btn-group">
                <button type="button" class="btn btn-danger" onclick="cargarVistaTareas_5_1()">Atrás</button>
                <button type="button" class="btn btn-success" id="guardar" onclick="guardar_5_2()">Guardar</button>
            </div>
        </div>
      </div>
          
    </form>
</div>
