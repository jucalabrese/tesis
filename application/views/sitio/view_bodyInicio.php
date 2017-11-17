<div class="row"> 
    <div style="background-image: url(<?php echo base_url('assets/images/FacInfo.jpg')?>); height: 400px; background-size: cover"></div>
</div>
<div class="row">
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
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h1>Sistema de Evaluación de Producto</h1>
        <p>La norma ISO/IEC 25040 - Guía y modelo de referencia de evaluación: propone un modelo de referencia general para la evaluación, que considera las entradas al proceso de evaluación, las restricciones y los recursos necesarios para obtener las correspondientes salidas</p>
    </div>   
</div>
<hr>
<div class="row espacios">
    <div class="col-md-offset-3 col-md-3">
        <a href="http://weblidi.info.unlp.edu.ar/wp/" target="_blank"><img src="<?php echo base_url('assets/images/LogoLIDI.png')?>" class="img-thumbnail" alt="LIDI"></a>
    </div>   
    <div class="col-md-5">
        <a href="http://info.unlp.edu.ar/" target="_blank"><img src="<?php echo base_url('assets/images/LogoINFO.png')?>" class="img-thumbnail" alt="INFO"></a>
    </div>
</div>