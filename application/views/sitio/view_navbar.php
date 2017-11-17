<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url('inicio/principal')?>">SEP</a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    $estado = $this->session->userdata('logueado');
                     if ($estado == TRUE){ ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('nombre');?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url()?>evaluacion/evaluaciones">Mis evaluaciones</a></li>
                                <li><a href="#">Ver mis datos</a></li>
                                <li><a href="<?php echo base_url()?>inicio/cerrar_sesion">Cerrar sesión</a></li>
                            </ul>
                        </li>     
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo base_url('inicio/login')?>">Iniciar Sesión</a>
                        </li>
                    <?php } ?>
            </ul>
        </div>
    </div>
</nav>