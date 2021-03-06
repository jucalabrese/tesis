<div class="row"> 
    <div style="background-image: url(<?php echo base_url('assets/images/FacInfo.jpg')?>); height: 350px; background-size: cover"></div>
</div>
<div class="row">  
    <?php if (validation_errors()): ?>
            <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
            </div>
    <?php endif; ?>
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
<div class="col-md-6 col-md-offset-3">
    <div>
        <h3>Registro</h3>
    </div>
    <hr>
    <div class="form-group">
        <span>Complete los siguientes campos obligatorios:</span>
    </div>
    <div id="loginbox" style="margin-top: 2%" class="mainbox col-md-10 col-md-offset-1 col-sm-offset-2">                    
                <form method="post" action="<?php echo base_url() ?>inicio/registrarse" id="loginform" class="form-horizontal" role="form">
                    <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="nombre" required type="nombre" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo $nombre?>">                                        
                    </div>
                    
                    <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="apellido" required type="apellido" class="form-control" name="apellido" placeholder="Apellido" value="<?php echo $apellido?>">                                        
                    </div>
                    
                    <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="email" required type="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo $email?>">                                        
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="clave" required type="password" class="form-control" name="clave" placeholder="Contraseña">
                    </div>

                    <div style="margin-top:10px" class="form-group" >
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                          <input type="submit" id="btn-login" href="#" value="Registrarse" class="btn btn-warning center-block">
                        </div>
                    </div>   
                </form>      
    </div>
</div>