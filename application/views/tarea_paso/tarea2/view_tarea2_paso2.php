<div>
    <h2>Tarea 2.2: Definir los criterios de decisión para las métricas</h2>
</div>
<hr>
<script>
	function setInaceptable(){
		$inaceptable="1";
	}
</script>
<div class="col-lg-12">
	<table class="table table-bordered">
		<thead class="color_panel4">
			<tr align="center">
				<td class="tamaño_criterio_decision">Inaceptable</td>
				<td class="tamaño_criterio_decision">Mínimamente aceptable</td>
				<td class="tamaño_criterio_decision">Rango objetivo</td>
				<td class="tamaño_criterio_decision">Excede los requerimientos</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td align="center">
					0 .. <?php if (isset($inaceptable)) {echo $inaceptable ;} 
					else {?>
						<select class="form-control tamaño_criterio_decision" id="inaceptable"> 
							 <?php for ($i=1; $i<=9; $i++){?> 
								<option value="<?php echo $i;?>">0.<?php echo $i;?></option> 
							 <?php } ?>
						</select>
						<button type="button" class="btn btn-success" onclick="setInaceptable()">♫</button>
					<?php } ?>
				</td>
				<td align="center">
					
				</td>
				<td align="center">
					<select class="form-control tamaño_rigor_select" id="seguridad_acceso">
						<option value="N/A" <?php if ($seguridad_acceso == "N/A") {echo "selected";} ?>>N/A</option>
						<option value="A" <?php if ($seguridad_acceso == "A") {echo "selected";} ?>>A</option>
						<option value="B"<?php if ($seguridad_acceso == "B") {echo "selected";} ?>>B</option>
						<option value="C"<?php if ($seguridad_acceso == "C") {echo "selected";} ?>>C</option>
						<option value="D"<?php if ($seguridad_acceso == "D") {echo "selected";} ?>>D</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
    <!-- INICIO POP UP 
    
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
    
    FIN POP UP -->
</div>