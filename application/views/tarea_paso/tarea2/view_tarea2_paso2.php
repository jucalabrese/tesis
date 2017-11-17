<div>
    <h2>Tarea 2.2: Definir los criterios de decisión para las métricas</h2>
</div>
<hr>
<div class="col-lg-12">
    <h4>Seleccione un atributo, una subcaracterística y luego una métrica:</h4>
    <br>
    <div>
        
        <?php if ($atributosTotales->num_rows() == 0){ ?>
        <div class="col-lg-4">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">No hay atributos para esta evaluación</a>
            </div>
        </div> 
        <?php } else { ?> 
        <div class="col-lg-4">
            <div class="list-group">
                <?php foreach ($atributosTotales->result_array() as $atr){ ?>
                    <a href="#" class="list-group-item list-group-item-action"><?php echo $atr['nombre']?></a>
                <?php }} ?>
            </div>
        </div> 
        
        <?php if ($subatributos->num_rows() == 0){ ?>
        <div class="col-lg-4">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">No hay atributos para esta evaluación</a>
            </div>
        </div> 
        <?php } else { ?> 
        <div class="col-lg-4">
            <div class="list-group">
                <?php foreach ($subatributos->result_array() as $subatr){ ?>
                    <a href="#" class="list-group-item list-group-item-action"><?php echo $subatr['nombre']?></a>
                <?php }} ?>
            </div>
        </div> 
        
        <?php if ($metricas->num_rows() == 0){ ?>
        <div class="col-lg-4">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">No hay atributos para esta evaluación</a>
            </div>
        </div> 
        <?php } else { ?> 
        <div class="col-lg-4">
            <div class="list-group">
                <?php foreach ($metricas->result_array() as $met){ ?>
                    <a href="#" class="list-group-item list-group-item-action"><?php echo $met['nombre']?></a>
                <?php }} ?>
            </div>
        </div> 
        
        
        
        
       <!-- <div class="col-lg-4">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">Métrica 1</a>
                <a href="#" class="list-group-item list-group-item-action">Métrica 2</a>
                <a href="#" class="list-group-item list-group-item-action">Métrica 3</a>
                <a href="#" class="list-group-item list-group-item-action">Métrica 4</a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">Métrica 1</a>
                <a href="#" class="list-group-item list-group-item-action">Métrica 2</a>
                <a href="#" class="list-group-item list-group-item-action">Métrica 3</a>
                <a href="#" class="list-group-item list-group-item-action">Métrica 4</a>
            </div>
            
        </div> -->
    </div>
    
    <div>
        <div class="col-lg-offset-4">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="#" data-toggle="modal" data-target="#agregarCriterio">Agregar criterio</a></li>
                    <li role="presentation" class="disabled"><a href="#">Editar criterio</a></li>
                </ul>
        </div>
    </div>
    
    <!-- INICIO POP UP -->
    
    <div id="agregarCriterio" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Agregar criterio de decisión</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-1">
                                <span>Atributo: Pepe</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-1">
                                <span>Subatributo: Juan</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-1">
                                <span>Métrica: Luis</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-1">
                                <input type="text" class="form-control" placeholder="Ingrese un rango/criterio de aceptación">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-1">
                                <textarea class="form-control text_area" rows="10" placeholder="Observaciones"></textarea>
                            </div>
                        </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="">Agregar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- FIN POP UP -->
    
        <div class="col-lg-6 col-lg-offset-3" style="padding-top: 2%">
            <?php $this->load->view('tarea_paso/buttons', ''); ?>
        </div>
</div>

