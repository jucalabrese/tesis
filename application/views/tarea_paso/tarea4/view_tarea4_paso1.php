<div>
    <h2>Mediciones</h2>
</div>
<hr>
<?php //Muestra cartel exito/error
    $cant = 1;
    $respuestas = array();
    if ($this->session->flashdata('ExitoMediciones')){ ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('ExitoMediciones'); ?>
        </div>
    <?php } else { 
        if ($this->session->flashdata('ErrorMediciones')){?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('ErrorMediciones'); ?>    
            </div>
    <?php } 
} ?>
<div>
    <div class="form-group">
        <span>Seleccione una característica:</span>
    </div>
    <div class="form-group">
        <select class="form-control" id="partes">
            <option value="0" onclick="cargarVistaTareas_4_1(0)">Seleccione una característica</option>
    <?php   foreach ($caracteristicas->result_array() as $c){ ?>
                <option value="<?php echo $c['idCaracteristica']?>" onclick="cargarPreguntas(<?php echo $c['idCaracteristica']?>)"><?php echo $c['nombre']?></option>      
    <?php       
            } ?>       
        </select>
    </div>
    <hr> 
    <div id="preguntas" style="display: none;">
        <div class="form-group">
            <span>Responda las siguientes preguntas asociadas a la característica <strong><?php echo $caracteristica?></strong>:</span>
        </div> 
        <div class="form-group">
            <table class="table table-bordered">
                <thead class="color_panel4">
                    <tr align="center">
                      <td class="tamaño_rigor_nivel" style="width: 1%">Número</td>
                      <td class="tamaño_rigor_nivel">Pregunta</td>
                      <td class="tamaño_rigor_nivel" style="width: 5%">Respuesta</td>
                    </tr>
                </thead>
                <tbody>
                     <?php if (!empty($preguntas)){
                     foreach ($preguntas->result_array() as $p){ ?>     
                    <tr>
                      <td align="center">
                        <?php echo $cant; 
                                $cant++?>
                      </td>
                      <td>
                          <?php echo $p['pregunta']?>
                      </td>
                      <td align="center">
                          <select id="respuestas" class="form-control" style="width: 70%">
                                <option></option>
                                <option>SI</option>
                                <option>NO</option>
                          </select>
                      </td>
                    </tr>
                     <?php }} ?> 
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-6 col-lg-offset-4">
                <div class="btn-group">
                        <button type="button" class="btn btn-danger">Atrás</button>
                        <button type="button" class="btn btn-warning">Agregar nota</button>
                        <button type="button" class="btn btn-success" id="guardar" onclick="guardar_4_1()">Guardar</button>
                </div>
        </div>
    </div>
</div>