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
        <select class="form-control" id="partes" onchange="cargarPreguntas(value)">
            <option value="0" onclick="cargarVistaTareas_4_1(0)">Seleccione una característica</option>
    <?php   foreach ($caracteristicas->result_array() as $c){ 
                if ($idCaracteristica == $c['idCaracteristica']){ ?>
                    <option value="<?php echo $c['idCaracteristica']?>" selected><?php echo $c['nombre']?></option>   
                <?php }else{ ?>
                    <option value="<?php echo $c['idCaracteristica']?>"><?php echo $c['nombre']?></option>   
                <?php }   
            }   ?>    
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
                      <td class="tamaño_rigor_nivel" style="width: 5%">Estado</td>
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
                          <?php if ($p['respuesta'] <> null){ ?>   
                          <select name="respuestas" id="respuestas<?php echo $p['idPregunta']?>" onchange="cargarRespuesta(<?php echo $p['idPregunta']?>);" class="form-control miSelect" style="width: 70%">
                              <?php if ($p['respuesta'] == 'SI'){?>
                                <option selected><?php echo $p['respuesta']?></option>
                                <option>NO</option>
                              <?php }else{ ?>
                                <option selected><?php echo $p['respuesta']?></option>
                                <option>SI</option>
                             <?php } ?>
                          </select>
                        <?php }else{ ?>
                          <select name="respuestas" id="respuestas<?php echo $p['idPregunta']?>" onchange="cargarRespuesta(<?php echo $p['idPregunta']?>);" class="form-control miSelect" style="width: 70%">
                                <option id="sinrespuesta<?php echo $p['idPregunta']?>"></option>
                                <option>SI</option>
                                <option>NO</option>
                            </select>
                        <?php } ?>
                            
                      </td>
                      <td align="center">
                          <?php if ($p['respuesta'] <> null){ ?> 
                          <div id="respuesta<?php echo $p['idPregunta']?>"><span class='glyphicon glyphicon-ok' aria-hidden='true' style='color: green'></span></div>
                          <?php }else{ ?>
                          <div id="respuesta<?php echo $p['idPregunta']?>"><span>Sin responder</span></div>    
                          <?php } ?> 
                      </td>
                    </tr>
                    <?php }} ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>