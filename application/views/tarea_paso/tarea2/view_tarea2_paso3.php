<div>
    <h2>Criterios de decisión de las características</h2>
</div>
<hr>
<?php
//Muestra cartel exito/error
if ($this->session->flashdata('ExitoNivelesCar')) {
    ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('ExitoNivelesCar'); ?>
    </div>
    <?php
} else {
    if ($this->session->flashdata('ErrorNivelesCar')) {
        ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('ErrorNivelesCar'); ?>    
        </div>
        <?php
    }
}
?>
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
                            <td align="center">
                                <select class="form-control" id="inaceptable<?php echo $s['idSubcaracteristica']; ?>"> 
                                   <option value="0">---</option>
                                   <option value="1">Inac.</option>
                                   <option value="2">Min. Ac.</option>
                                   <option value="3">Rango Obj.</option>
                                   <option value="4">Excede</option>
                                </select>
                            </td>
        <?php } ?>  
                    </tr>
                    <tr>
                        <td align="center" style="vertical-align: middle;">Minimamente aceptable</td>
        <?php foreach ($c['subcaracteristicas']->result_array() as $s) { ?>
                            <td align="center">
                                <select class="form-control" id="min_aceptable<?php echo $s['idSubcaracteristica']; ?>"> 
                                   <option value="0">---</option>
                                   <option value="1">Inac.</option>
                                   <option value="2">Min. Ac.</option>
                                   <option value="3">Rango Obj.</option>
                                   <option value="4">Excede</option>
                                </select>
                            </td>
        <?php } ?>  
                    </tr>
                    <tr>
                        <td align="center" style="vertical-align: middle;">Rango objetivo</td>
        <?php foreach ($c['subcaracteristicas']->result_array() as $s) { ?>
                            <td align="center">
                                <select class="form-control" id="aceptable<?php echo $s['idSubcaracteristica']; ?>"> 
                                   <option value="0">---</option>
                                   <option value="1">Inac.</option>
                                   <option value="2">Min. Ac.</option>
                                   <option value="3">Rango Obj.</option>
                                   <option value="4">Excede</option>
                                </select>
                            </td>
        <?php } ?>  
                    </tr>
                    <tr>
                        <td align="center" style="vertical-align: middle;">Excede los requerimientos</td>
        <?php foreach ($c['subcaracteristicas']->result_array() as $s) { ?>
                            <td align="center">
                                <select class="form-control" id="excede<?php echo $s['idSubcaracteristica']; ?>"> 
                                   <option value="0">---</option>
                                   <option value="1">Inac.</option>
                                   <option value="2">Min. Ac.</option>
                                   <option value="3">Rango Obj.</option>
                                   <option value="4">Excede</option>
                                </select>
                            </td>
        <?php } ?>  
                    </tr>
                </tbody>
                
            </table>
    <button type="button" class="btn btn-success btn-sm" id="guardar" onclick="#">Guardar</button>
    <hr>
        <?php }
    } else {
        ?>
        <div class="form-group">
            <span>No se ha elegido ninguna característica completa para evaluar</span>
        </div> 
<?php } ?>
</div>