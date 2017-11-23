<div>
    <h2>Tarea 1.4: Definir el rigor de la evaluación</h2>
</div>
<hr>
<div class="col-lg-12">

    <h4>Asignación de rigor de la evaluación</h4> <!-- TABLA DONDE SE ELIGE EL RIGOR -->
    <br>
    <table class="table table-bordered">
        <thead class="color_panel4">
            <tr align="center">
              <td class="tamaño_rigor_nivel">Aspecto de seguridad física</td>
              <td class="tamaño_rigor_nivel">Aspecto económico</td>
              <td class="tamaño_rigor_nivel">Aspecto de seguridad de acceso</td>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td align="center">
                  <select class="form-control tamaño_rigor_select">
                        <option>N/A</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                  </select>
              </td>
              <td align="center">
                  <select class="form-control tamaño_rigor_select">
                        <option>N/A</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                  </select>
              </td>
              <td align="center">
                  <select class="form-control tamaño_rigor_select">
                        <option>N/A</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                  </select>
              </td>
            </tr>
        </tbody>
    </table>
    <a href="#" onclick="ocultarTablasRigor()">Referencias - Anexo A (ISO 25040)</a>
    <div id="tablas" style="display: none; padding-top: 3%">
    <table class="table table-bordered">
        <thead class="color_panel1">
            <tr align="center">
              <td class="tamaño_rigor_aspecto">Aspecto</td>
              <td class="tamaño_rigor_nivel">Nivel de rigor de evaluación</td>
              <td>Consecuencias</td>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td rowspan="4" align="center">Seguridad física</td>
              <td align="center">A</td>
              <td>Las personas pueden morir</td>
            </tr>
            <tr>
              <td align="center">B</td>
              <td>Amenaza contra vidas humanas</td>
            </tr>
            <tr>
              <td align="center">C</td>
              <td>Daños materiales. Amenaza de daño a personas.</td>
            </tr>
            <tr>
              <td align="center">D</td>
              <td>Pequeños daños materiales. No hay riesgo para las personas.</td>
            </tr>
        </tbody>
    </table>
    
    <table class="table table-bordered">
        <thead class="color_panel2">
            <tr align="center">
              <td class="tamaño_rigor_aspecto">Aspecto</td>
              <td class="tamaño_rigor_nivel">Nivel de rigor de evaluación</td>
              <td>Consecuencias</td>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td rowspan="4" align="center">Económico</td>
              <td align="center">A</td>
              <td>Desastre financiero (la compañía no puede seguir funcionando)</td>
            </tr>
            <tr>
              <td align="center">B</td>
              <td>Pérdidas económicas importantes</td>
            </tr>
            <tr>
              <td align="center">C</td>
              <td>Pérdidas económicas significantes</td>
            </tr>
            <tr>
              <td align="center">D</td>
              <td>Pérdidas económicas insignificantes</td>
            </tr>
        </tbody>
    </table>
    
    <table class="table table-bordered">
        <thead class="color_panel3">
            <tr align="center">
              <td class="tamaño_rigor_aspecto">Aspecto</td>
              <td class="tamaño_rigor_nivel">Nivel de rigor de evaluación</td>
              <td>Consecuencias</td>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td rowspan="4" align="center">Seguridad de acceso</td>
              <td align="center">A</td>
              <td>Riesgo de protección de datos y servicios estratégicos</td>
            </tr>
            <tr>
              <td align="center">B</td>
              <td>Riesgo de protección de datos y servicios críticos</td>
            </tr>
            <tr>
              <td align="center">C</td>
              <td>Riesgo de protección de datos</td>
            </tr>
            <tr>
              <td align="center">D</td>
              <td>No se identifican riesgos</td>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="form-group">
        <div class="col-lg-6 col-lg-offset-4">
            <?php $this->load->view('tarea_paso/buttons', ''); ?>
        </div>
    </div>
</div>