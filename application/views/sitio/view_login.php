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
        <h3>Iniciar Sesión</h3>
    </div>
    <hr>
<div id="loginbox" style="margin-top: 3%" class="mainbox col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2">          
        <div style="padding-top:30px"  >
            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
            <form method="post" action="<?php echo base_url() ?>inicio/iniciar_sesion" id="loginform" class="form-horizontal" role="form">
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
                      <input type="submit" id="btn-login" href="#" value="Iniciar Sesión" class="btn btn-danger center-block">
                    </div>
                </div>   
            </form>     
    </div> 
    </div>
</div>
        