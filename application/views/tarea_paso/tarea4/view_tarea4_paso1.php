<div>
    <h2>Mediciones</h2>
</div>
<hr>
<?php //Muestra cartel exito/error
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
    <?php   foreach ($caracteristicas as $c){ ?>
                <option value="<?php echo $c['idCaracteristica']?>"><?php echo $c['nombre']?></option>      
    <?php       
            } ?>       
        </select>
    </div>
    <hr> 
    <div class="form-group">
        <span>Responda las siguientes preguntas asociadas a la característica (nombre característica):</span>
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
                 <?php   foreach ($preguntas->result_array() as $p){ ?>     
                <tr>
                  <td align="center">
                    1
                  </td>
                  <td>
                      <?php echo $p['pregunta']?>
                  </td>
                  <td align="center">
                      <select class="form-control">
                            <option>N/A</option>
                            <option>SI</option>
                            <option>NO</option>
                      </select>
                  </td>
                </tr>
            <?php } ?> 
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <div class="col-lg-6 col-lg-offset-4">
                <div class="btn-group">
                        <button type="button" class="btn btn-danger">Atrás</button>
                        <button type="button" class="btn btn-warning">Agregar nota</button>
                        <button type="button" class="btn btn-success" id="guardar" onclick="guardar_1_4()">Guardar</button>
                </div>
        </div>
    </div>
</div>