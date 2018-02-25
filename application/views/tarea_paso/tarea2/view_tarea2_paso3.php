<div>
    <h2>Criterios de decisión de las características</h2>
</div>
<hr>
<div class="col-lg-12">
    <?php
    if (!empty($caracteristicas)) {
        foreach ($caracteristicas as $c) {
            ?>
            <table class="table table-bordered">
                <thead class="color_panel4">
                    <tr align="center">
                        <td colspan="<?php echo $c['cantidad']+1; ?>"><?php echo $c['nombre']; ?></td>
                    </tr>
                    <tr align="center">
                        <td></td>
                        <?php foreach ($c['subcaracteristicas']->result_array() as $s) { ?>
                            <td style="font-size:80%;"><?php echo $s['nombre']; ?></td>
        <?php } ?>  
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td align="center" style="vertical-align: middle;">Inaceptable</td>
        <?php foreach ($c['subcaracteristicas']->result_array() as $s) { ?>
                            <td align="center" id="i<?php echo $s['idSubcaracteristica']; ?>" >
                                <select class="form-control" id="inaceptable<?php echo $s['idSubcaracteristica']; ?>" onchange="cargarInaceptable(<?php echo $s['idSubcaracteristica']?>)" > 
                                   <option id="sin_inaceptable<?php echo $s['idSubcaracteristica']?>">---</option>
                                   <option value="1" <?php if ($c['asignado_inac'.$s['idSubcaracteristica']]){ if ($c['inaceptable'.$s['idSubcaracteristica']]==1){ echo "selected";}} ?>>Inac.</option>
                                   <option value="2" <?php if ($c['asignado_inac'.$s['idSubcaracteristica']]){ if ($c['inaceptable'.$s['idSubcaracteristica']]==2){ echo "selected";}} ?>>Min. Ac.</option>
                                   <option value="3" <?php if ($c['asignado_inac'.$s['idSubcaracteristica']]){ if ($c['inaceptable'.$s['idSubcaracteristica']]==3){ echo "selected";}} ?>>Rango Obj.</option>
                                   <option value="4" <?php if ($c['asignado_inac'.$s['idSubcaracteristica']]){ if ($c['inaceptable'.$s['idSubcaracteristica']]==4){ echo "selected";}} ?>>Excede</option>
                                </select>
                            </td>
        <?php } ?>  
                    </tr>
                    <tr>
                        <td align="center" style="vertical-align: middle;">Minimamente aceptable</td>
        <?php foreach ($c['subcaracteristicas']->result_array() as $s) { ?>
                            <td align="center" id="m<?php echo $s['idSubcaracteristica']; ?>" >
                                <select class="form-control" id="min_aceptable<?php echo $s['idSubcaracteristica']; ?>" onchange="cargarMinAceptable(<?php echo $s['idSubcaracteristica']?>)" > 
                                   <option id="sin_minaceptable<?php echo $s['idSubcaracteristica']?>" value="0">---</option>
                                   <option value="1" <?php if ($c['asignado_minac'.$s['idSubcaracteristica']]){ if ($c['min_aceptable'.$s['idSubcaracteristica']]==1){ echo "selected";}} ?>>Inac.</option>
                                   <option value="2" <?php if ($c['asignado_minac'.$s['idSubcaracteristica']]){ if ($c['min_aceptable'.$s['idSubcaracteristica']]==2){ echo "selected";}} ?>>Min. Ac.</option>
                                   <option value="3" <?php if ($c['asignado_minac'.$s['idSubcaracteristica']]){ if ($c['min_aceptable'.$s['idSubcaracteristica']]==3){ echo "selected";}} ?>>Rango Obj.</option>
                                   <option value="4" <?php if ($c['asignado_minac'.$s['idSubcaracteristica']]){ if ($c['min_aceptable'.$s['idSubcaracteristica']]==4){ echo "selected";}} ?>>Excede</option>
                                </select>
                            </td>
        <?php } ?>  
                    </tr>
                    <tr>
                        <td align="center" style="vertical-align: middle;">Rango objetivo</td>
        <?php foreach ($c['subcaracteristicas']->result_array() as $s) { ?>
                            <td align="center" id="a<?php echo $s['idSubcaracteristica']; ?>" >
                                <select class="form-control" id="aceptable<?php echo $s['idSubcaracteristica']; ?>" onchange="cargarAceptable(<?php echo $s['idSubcaracteristica']?>)" > 
                                   <option id="sin_aceptable<?php echo $s['idSubcaracteristica']?>" value="0">---</option>
                                   <option value="1" <?php if ($c['asignado_acep'.$s['idSubcaracteristica']]){ if ($c['aceptable'.$s['idSubcaracteristica']]==1){ echo "selected";}} ?>>Inac.</option>
                                   <option value="2" <?php if ($c['asignado_acep'.$s['idSubcaracteristica']]){ if ($c['aceptable'.$s['idSubcaracteristica']]==2){ echo "selected";}} ?>>Min. Ac.</option>
                                   <option value="3" <?php if ($c['asignado_acep'.$s['idSubcaracteristica']]){ if ($c['aceptable'.$s['idSubcaracteristica']]==3){ echo "selected";}} ?>>Rango Obj.</option>
                                   <option value="4" <?php if ($c['asignado_acep'.$s['idSubcaracteristica']]){ if ($c['aceptable'.$s['idSubcaracteristica']]==4){ echo "selected";}} ?>>Excede</option>
                                </select>
                            </td>
        <?php } ?>  
                    </tr>
                    <tr>
                        <td align="center" style="vertical-align: middle;">Excede los requerimientos</td>
        <?php foreach ($c['subcaracteristicas']->result_array() as $s) { ?>
                            <td align="center" id="e<?php echo $s['idSubcaracteristica']; ?>" >
                                <select class="form-control" id="excede<?php echo $s['idSubcaracteristica']; ?>" onchange="cargarExcede(<?php echo $s['idSubcaracteristica']?>)" > 
                                   <option id="sin_excede<?php echo $s['idSubcaracteristica']?>" value="0">---</option>
                                   <option value="1" <?php if ($c['asignado_excede'.$s['idSubcaracteristica']]){ if ($c['excede'.$s['idSubcaracteristica']]==1){ echo "selected";}} ?>>Inac.</option>
                                   <option value="2" <?php if ($c['asignado_excede'.$s['idSubcaracteristica']]){ if ($c['excede'.$s['idSubcaracteristica']]==2){ echo "selected";}} ?>>Min. Ac.</option>
                                   <option value="3" <?php if ($c['asignado_excede'.$s['idSubcaracteristica']]){ if ($c['excede'.$s['idSubcaracteristica']]==3){ echo "selected";}} ?>>Rango Obj.</option>
                                   <option value="4" <?php if ($c['asignado_excede'.$s['idSubcaracteristica']]){ if ($c['excede'.$s['idSubcaracteristica']]==4){ echo "selected";}} ?>>Excede</option>
                                </select>
                            </td>
        <?php } ?>  
                    </tr>
                </tbody>
                
            </table>
    <hr>
        <?php }
    } else {
        ?>
        <div class="form-group">
            <span>No se ha elegido ninguna característica completa para evaluar</span>
        </div> 
<?php } ?>
    <hr>
    <div class="form-group">
        <div class="col-lg-6 col-lg-offset-5">
                <div class="btn-group">
                        <button type="button" class="btn btn-danger" onclick="cargarVistaTareas_2_2()">Atrás</button>
                </div>
        </div>
    </div>
</div>