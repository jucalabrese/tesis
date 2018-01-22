<div>
    <h2>Propósito de la evaluación</h2>
</div>
<hr>
<?php //Muestra cartel exito/error
    if ($this->session->flashdata('ExitoProposito')){ ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('ExitoProposito'); ?>
        </div>
    <?php } else { 
        if ($this->session->flashdata('ErrorProposito')){?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('ErrorProposito'); ?>    
            </div>
    <?php } 
} ?>
<div class="col-lg-12">
    <form class="form-horizontal" role="form">
        
        <div class="form-group">
            <textarea class="form-control text_area" rows="10" id="proposito" placeholder="Ingrese el propósito por el cual la organización quiere evaluar la calidad de su producto de software."><?php echo $proposito?></textarea>      
            <span class="col-lg-12">Propósito:</span>
        </div>

      <div class="form-group">
        <div class="col-lg-7 col-lg-offset-4">
            <div class="btn-group">
                <button type="button" class="btn btn-danger">Atrás</button>
                <button type="button" class="btn btn-warning">Agregar nota</button>
                <button type="button" class="btn btn-success" id="guardar" onclick="guardar_1_1()">Guardar</button>
            </div>
        </div>
      </div>
          
    </form>
</div>