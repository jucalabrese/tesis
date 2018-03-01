<div>
    <h2>Tratamiento de datos</h2>
</div>
<hr>
<div>
    <?php //Muestra cartel exito/error
        if ($this->session->flashdata('ExitoTratamiento')){ ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('ExitoTratamiento'); ?>
            </div>
        <?php } else { 
            if ($this->session->flashdata('ErrorTratamiento')){?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('ErrorTratamiento'); ?>    
                </div>
        <?php } 
        }
    ?>  
</div>
<div class="form-group">
    <div class="form-group">
        <span>Si desea archivar la evaluación, haga clic en el siguiente botón:</span>
    </div>
     <div class="col-lg-6 col-lg-offset-4">
        <div class="btn-group">
            <a class="btn btn-danger" id="archivar" href="guardado/5/3/" onclick="alert('¡La evaluación se ha archivado exitosamente!')">Archivar evaluación</a>
        </div>
    </div>

</div>