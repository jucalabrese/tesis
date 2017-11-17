<div>
    <h2>Tarea 1.3: Identificar las partes del producto que se deben evaluar</h2>
</div>
<hr>
<?php //Muestra cartel exito/error
    if ($this->session->flashdata('ExitoPart')){ ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('ExitoPart'); ?>
        </div>
    <?php } else { 
        if ($this->session->flashdata('ErrorPart')){?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('ErrorPart'); ?>    
            </div>
    <?php } 
    }
?>  
<div class="col-lg-12">
      <form class="form-horizontal" role="form">
        
        <div class="form-group">
            <div class="col-lg-12">
               <span >Parte del producto a evaluar: </span>
            </div>
        </div>                 
        <div class="form-group">
            <div class="col-lg-12">
                <select class="form-control" id="partes">
                    <?php foreach ($partes->result_array() as $p){ 
                        if (($p['idParte']) == $parte_seleccionada){?>
                            <option value="<?php echo $p['idParte']?>" selected><?php echo $p['parte']?></option>
                    <?php }else{ ?>
                            <option value="<?php echo $p['idParte']?>"><?php echo $p['parte']?></option>
                    <?php }} ?>
                </select>    
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-lg-12">
               <span >Funcionalidades: </span>
            </div>
        </div>
        
        <table class="table table-bordered table-hover">
        <tr class="danger" align="center"> 
            <td><strong>Código</strong></td>
            <td><strong>Funcionalidad</strong></td>
            <td><strong>Descripción</strong></td>
            <td><strong>Editar</strong></td>
            <td><strong>Eliminar</strong></td>
        </tr>
        <?php if ($funcionalidades->num_rows() == 0){ ?>
        <tr>
            <td colspan="5" align="center">No hay ninguna funcionalidad cargada para esta evaluación</td>
        </tr>    
        <?php } else {
        foreach ($funcionalidades->result_array() as $func){ ?>
        <tr>
            <td width="5%" align="center"><?php echo $func['codigoFuncionalidad']?></td>
            <td class="nombre"><?php echo $func['nombre']?></td>
            <td width="15%" align="center"><a href="#" data-toggle="popover" data-trigger="focus" title="Holi" data-content="Chauchi" role="button">Ver detalle</a></td>
            <td width="15%" align="center"><a href="">Editar</a></td>
            <td width="15%" align="center"><a href="">Eliminar</a></td>
        </tr>
        <?php }} ?>
        </table>
        
        <div class="form-group">
            <div class="col-lg-12">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="#" data-toggle="modal" data-target="#agregarFuncionalidad">Agregar nueva funcionalidad</a></li>
                </ul>
            </div>
        </div>
        
        <div id="agregarFuncionalidad" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Agregar funcionalidad</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <input type="text" class="form-control" placeholder="Ingrese un código de funcionalidad">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese una funcionalidad">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <textarea class="form-control text_area" id="descripcion" rows="5" placeholder="Ingrese una descripción de la funcionalidad"></textarea>
                                </div>
                            </div>  
                        </form>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="agregarFuncionalidad()">Agregar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                    
                </div>
            </div>
        </div>
          
        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-4">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Atrás</button>
                    <button type="button" class="btn btn-warning">Agregar nota</button>
                    <button type="button" class="btn btn-success" id="guardar" onclick="guardar_1_3()">Guardar</button>
                </div>
            </div>
        </div>  
    </form>
</div>