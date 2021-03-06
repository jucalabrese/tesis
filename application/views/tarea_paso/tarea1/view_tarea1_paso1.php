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
            <span>Ingrese el propósito por el cual la organización quiere evaluar la calidad de su producto de software:</span>
        </div>
        <div class="form-group">
            <textarea class="form-control text_area" rows="10" id="proposito" placeholder="Ejemplo: asegurar la calidad del producto, decidir si se acepta un producto, determinar la viabilidad del proyecto en desarrollo, comparar la calidad del producto con productos de la competencia, etc."><?php echo $proposito?></textarea>      
        </div>

      <div class="form-group">
        <div class="col-lg-7 col-lg-offset-4">
            <div class="btn-group">
                <button type="button" class="btn btn-danger" onclick="cargarVistaDefinicion()">Atrás</button>
                <button type="button" class="btn btn-success" id="guardar" onclick="guardar_1_1()">Guardar</button>
            </div>
        </div>
      </div>
          
    </form>
</div>