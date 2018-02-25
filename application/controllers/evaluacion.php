<?php

class Evaluacion extends CI_Controller {

    public function iniciar_evaluacion() {
        $evaluacion_data = array(
            'idEvaluacion' => null,
            'creada' => false,
        );
        $datos = array('nombre' => '', 'descripcion' => '');
        $this->session->set_userdata($evaluacion_data);
        $contenido = array('contenido' => $this->load->view('sitio/view_definicionProducto', $datos, true));
        $datos["cuerpo"] = $this->load->view('sitio/view_iniciarEvaluacion', $contenido, true);
        $this->load->view('sitio/view_index', $datos);
    }

    public function introduccion_evaluacion() {
        $this->load->view('sitio/view_introduccionEvaluacion', '');
    }

    public function evaluaciones() {

        $this->load->model('model_evaluacion');
        $this->load->library('pagination');

        $opciones = array();
        $desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $opciones['per_page'] = 10;
        $opciones['base_url'] = base_url() . 'evaluacion/evaluaciones/';
//$opciones['use_page_numbers'] = true;
        $opciones['total_rows'] = $this->model_evaluacion->cantEvaluaciones();
        $opciones['num_links'] = 3;
        $opciones['uri_segment'] = 3;

        $opciones['full_tag_open'] = '<ul class="pagination">';
        $opciones['full_tag_close'] = '</ul>';
        $opciones['first_link'] = 'Primero';
        $opciones['first_tag_open'] = '<li>';
        $opciones['first_tag_close'] = '</li>';
        $opciones['last_link'] = 'Ultimo';
        $opciones['last_tag_open'] = '<li>';
        $opciones['last_tag_close'] = '</li>';
        $opciones['next_link'] = '&gt;';
        $opciones['next_tag_open'] = '<li>';
        $opciones['next_tag_close'] = '</li>';
        $opciones['prev_link'] = '&lt;';
        $opciones['prev_tag_open'] = '<li>';
        $opciones['prev_tag_close'] = '</li>';
        $opciones['cur_tag_open'] = '<li class="active"><a><b>';
        $opciones['cur_tag_close'] = '</b></a></li>';
        $opciones['num_tag_open'] = '<li>';
        $opciones['num_tag_close'] = '</li>';

        $this->pagination->initialize($opciones);

        $datos_listado['evaluaciones'] = $this->model_evaluacion->getEvaluacionesPaginadas($opciones['per_page'], $desde);
        $str_links = $this->pagination->create_links();
        $datos_listado['links'] = explode('&nbsp;', $str_links);

        $datos["cuerpo"] = $this->load->view('sitio/view_evaluaciones', $datos_listado, true);
        $this->load->view('sitio/view_index', $datos);
    }

    public function definicion_producto() {
        $this->load->model('model_evaluacion');
        $nombre = '';
        $descripcion = '';
        if ($this->session->userdata('idEvaluacion') <> null) {
            $idEvaluacion = $this->session->userdata('idEvaluacion');
            $data = $this->model_evaluacion->cargarProducto($idEvaluacion);
            foreach ($data->result_array() as $dato) {
                $nombre = $dato['nombre'];
                $descripcion = $dato['descripcion'];
            }
        }
        $datos = array('nombre' => $nombre, 'descripcion' => $descripcion);
        $this->load->view('sitio/view_definicionProducto', $datos);
    }

    public function guardarRespuesta() {
        $this->load->model('model_evaluacion');
        $idEvaluacion = $this->session->userdata('idEvaluacion');
        $idPregunta = $this->input->post('idPregunta');
        $respuesta = $this->input->post('respuesta');
        $existe = $this->model_evaluacion->getRespuesta($idEvaluacion, $idPregunta);
        if ($existe == false) {
            $this->model_evaluacion->cargarRespuesta($idEvaluacion, $idPregunta, $respuesta);
        } else {
            $this->model_evaluacion->editarRespuesta($idEvaluacion, $idPregunta, $respuesta);
        }
    }

    public function generarInforme() {

        $this->load->model('model_evaluacion');
        $idEvaluacion = $this->session->userdata('idEvaluacion');
        global $nombreProd;
        $producto = $this->model_evaluacion->cargarProducto($idEvaluacion);
        foreach ($producto->result_array() as $p) {
            $nombreProd = utf8_decode($p['nombre']);
            $descripcionProd = utf8_decode($p['descripcion']);
        }
        $evaluacion = $this->model_evaluacion->cargarProposito($idEvaluacion);
        foreach ($evaluacion->result_array() as $e) {
            $proposito = utf8_decode($e['proposito']);
            $parte = $this->model_evaluacion->getParte($e['idParte']);
            foreach ($parte->result_array() as $p) {
                $fase = $p['parte'];
            }
            $rigor = $this->model_evaluacion->getEvaluacionRigor($e['idEvaluacionRigor']);
            foreach ($rigor->result_array() as $r) {
                $seguridad_fisica = $r['seguridad_fisica'];
                $economico = $r['economico'];
                $seguridad_acceso = $r['seguridad_acceso'];
            }
        }
        $caracteristicas = $this->model_evaluacion->getCaracteristicasEvaluacion($idEvaluacion);
        switch ($seguridad_fisica) {
            case 'A':
                $seguridad_fisica = utf8_decode('A: Las personas pueden morir          ');
                break;
            case 'B':
                $seguridad_fisica = utf8_decode('B: Amenaza contra vidas humanas         ');
                break;
            case 'C':
                $seguridad_fisica = utf8_decode('C: Daños materiales. Amenaza de daño a personas');
                break;
            case 'D':
                $seguridad_fisica = utf8_decode('D: Pequeños daños materiales. No hay riesgo para las personas');
                break;
            case 'N/A':
                $seguridad_fisica = 'N/A                                                    ';
                break;
        }
        switch ($economico) {
            case 'A':
                $economico = utf8_decode('A: Desastre financiero              ');
                break;
            case 'B':
                $economico = utf8_decode('B: Pérdidas económicas importantes');
                break;
            case 'C':
                $economico = utf8_decode('C: Pérdidas económicas significantes');
                break;
            case 'D':
                $economico = utf8_decode('D: Pérdidas económicas insignificantes');
                break;
            case 'N/A':
                $economico = 'N/A                                                    ';
                break;
        }
        switch ($seguridad_acceso) {
            case 'A':
                $seguridad_acceso = utf8_decode('A: Riesgo de protección de datos y servicios estratégicos');
                break;
            case 'B':
                $seguridad_acceso = utf8_decode('B: Riesgo de protección de datos y servicios críticos');
                break;
            case 'C':
                $seguridad_acceso = utf8_decode('C: Riesgo de protección de datos                    ');
                break;
            case 'D':
                $seguridad_acceso = utf8_decode('D: No se identifican riesgos                         ');
                break;
            case 'N/A':
                $seguridad_acceso = 'N/A                                                    ';
                break;
        }
        $datosRigor = array($seguridad_fisica, $economico, $seguridad_acceso);

        $this->load->library('PDF');
        $this->pdf = new PDF();

        $this->pdf->AliasNbPages();
        $this->pdf->AddPage('P', 'A4'); //Vertical, A4
        $this->pdf->SetTitle('Informe');
        $this->pdf->Ln(10);
        if ($descripcionProd != '') {
            $this->pdf->SetFont('Arial', 'B', 12); //Arial,negrita, 12 puntos
            $this->pdf->Write(5, utf8_decode('Descripción: '));
            $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
            $this->pdf->Write(5, $descripcionProd);
            $this->pdf->Ln(10);
        }
        $this->pdf->SetFont('Arial', 'B', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Propósito: '));
        $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
        $this->pdf->Write(5, $proposito);
        $this->pdf->Ln(10);

        $this->pdf->SetFont('Arial', 'B', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Características: '));
        $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
        if ($caracteristicas->num_rows() == 1) {
            $this->pdf->Write(5, utf8_decode('Se evaluará la característica '));
        } else {
            $this->pdf->Write(5, utf8_decode('Se evaluarán las características '));
        }
        foreach ($caracteristicas->result_array() as $c) {
            $this->pdf->SetFont('Arial', 'IU', 12); //Arial, italica, subrayada, 12 puntos
            $this->pdf->Write(5, utf8_decode($c['nombre']));
            $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
            if ($c != $caracteristicas->result_array()[$caracteristicas->num_rows() - 1]) {
                $this->pdf->Write(5, ' - ');
            } else {
                $this->pdf->Write(5, '.');
            }
        }
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Arial', 'B', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, 'Fase en la que se encuentra el producto: ');
        $this->pdf->SetFont('Arial', '', 12); //Arial, 12 puntos
        $this->pdf->Write(5, utf8_decode($fase));
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Arial', 'B', 12); //Arial,negrita, 12 puntos
        $this->pdf->Write(5, utf8_decode('Rigor de la evaluación: '));
        $this->pdf->Ln(10);
        $cabecera = array(utf8_decode("Aspecto de seguridad física"), utf8_decode("Aspecto económico"), utf8_decode("Aspecto de seguridad de acceso"));
        $cuerpo = array($datosRigor);
        $this->pdf->FancyTableRigor($cabecera, $cuerpo);
//  FORMATO TABLA
//  $cabecera = array("Apellido", "Nombre","Matrícula","Usuario","Mail");
//  $pdf->FancyTableWithNItems($cabecera,$usuarios,$votos,38); //Método que integra a cabecera y datos
        $this->pdf->Output('informe.pdf', 'I'); //Salida al navegador del pdf
    }

    public function guardarInaceptable() {
        $this->load->model('model_evaluacion');
        $idEvaluacion = $this->session->userdata('idEvaluacion');
        $nivel_inac = $this->input->post('nivel_inac');
        $idSubcaracteristica = $this->input->post('idSubcaracteristica');
        $subc = $this->model_evaluacion->getEvaluacionSubcaracteristica($idEvaluacion, $idSubcaracteristica);
        foreach ($subc->result_array() as $s) {
            $subcaracteristica = $s['idEvaluacionSubcaracteristica'];
        }
        $this->model_evaluacion->cargarInaceptable($subcaracteristica, $nivel_inac);
    }

    public function guardarMinAceptable() {
        $this->load->model('model_evaluacion');
        $idEvaluacion = $this->session->userdata('idEvaluacion');
        $nivel_minac = $this->input->post('nivel_minac');
        $idSubcaracteristica = $this->input->post('idSubcaracteristica');
        $subc = $this->model_evaluacion->getEvaluacionSubcaracteristica($idEvaluacion, $idSubcaracteristica);
        foreach ($subc->result_array() as $s) {
            $subcaracteristica = $s['idEvaluacionSubcaracteristica'];
        }
        $this->model_evaluacion->cargarMinAceptable($subcaracteristica, $nivel_minac);
    }

    public function guardarAceptable() {
        $this->load->model('model_evaluacion');
        $idEvaluacion = $this->session->userdata('idEvaluacion');
        $nivel_acep = $this->input->post('nivel_acep');
        $idSubcaracteristica = $this->input->post('idSubcaracteristica');
        $subc = $this->model_evaluacion->getEvaluacionSubcaracteristica($idEvaluacion, $idSubcaracteristica);
        foreach ($subc->result_array() as $s) {
            $subcaracteristica = $s['idEvaluacionSubcaracteristica'];
        }
        $this->model_evaluacion->cargarAceptable($subcaracteristica, $nivel_acep);
    }

    public function guardarExcede() {
        $this->load->model('model_evaluacion');
        $idEvaluacion = $this->session->userdata('idEvaluacion');
        $nivel_excede = $this->input->post('nivel_excede');
        $idSubcaracteristica = $this->input->post('idSubcaracteristica');
        $subc = $this->model_evaluacion->getEvaluacionSubcaracteristica($idEvaluacion, $idSubcaracteristica);
        foreach ($subc->result_array() as $s) {
            $subcaracteristica = $s['idEvaluacionSubcaracteristica'];
        }
        $this->model_evaluacion->cargarExcede($subcaracteristica, $nivel_excede);
    }

    public function guardarProducto() {
        $this->load->model('model_evaluacion');
        if ($this->input->post()) {
            $nombre = $this->input->post('nombre');
            $descripcion = $this->input->post('descripcion');

            if ($nombre == '') {
                unset($_SESSION['Exito']);
                $this->session->set_flashdata('Error', 'El nombre del producto no puede estar vacío');
                $resul = $this->model_evaluacion->cargarProducto($this->session->userdata('idEvaluacion'));
                foreach ($resul->result_array() as $r) {
                    $nombre = $r['nombre'];
                }
            } else {
                if ($this->session->userdata('idEvaluacion') <> null) {
                    $idEvaluacion = $this->session->userdata('idEvaluacion');
                    $this->model_evaluacion->editarDefinicion($nombre, $descripcion, $idEvaluacion);
                    $this->session->set_flashdata('Exito', '¡Se editaron los datos exitosamente!');
                } else {
                    $guardarDefinicion = $this->model_evaluacion->guardarDefinicion($nombre, $descripcion);
                    if ($guardarDefinicion) {
                        $evaluacion_data = array(
                            'idEvaluacion' => $guardarDefinicion,
                            'creada' => true,
                        );
                        $this->session->set_userdata($evaluacion_data);
                        $this->session->set_flashdata('Exito', '¡Se guardaron los datos exitosamente! Los ítems de la evaluación se encuentran habilitados.');
                    } else {
                        $this->session->set_flashdata('Error', 'Ocurrió un error al guardar los datos');
                    }
                }
            }

            $datos = array('nombre' => $nombre, 'descripcion' => $descripcion);
            $this->load->view('sitio/view_definicionProducto', $datos);
        }
    }

    public function tarea_paso($tarea, $paso) {
        $datos = null;
        $datos2 = null;
        $idEvaluacion = $this->session->userdata('idEvaluacion');
        $this->load->model('model_evaluacion');
        switch ($tarea) {
            case 1:
                switch ($paso) {
                    case 0:
                        break;
                    case 1:
                        $proposito = '';
                        $data = $this->model_evaluacion->cargarProposito($idEvaluacion);
                        foreach ($data->result_array() as $dato) {
                            $proposito = $dato['proposito'];
                        }
                        $datos = array('proposito' => $proposito);
                        break;
                    case 2:
                        $cant = 0;
                        $caracteristicas = $this->model_evaluacion->getCaracteristicas(); //TODAS LAS CARACTERISTICAS
                        $arregloCaracteristicas = array(); //ARREGLO CON CARACTERISTICAS ELEGIDAS POR EL USUARIO
                        $data = $this->model_evaluacion->cargar_1_2($idEvaluacion); //TRAE TODAS LAS CARACTERISTICAS ELEGIDAS POR EL USUARIO
                        foreach ($data->result_array() as $dato) {
                            $arregloCaracteristicas[$cant] = $dato['idCaracteristica'];
                            $cant++;
                        };
                        $datos = array('caracteristicas' => $caracteristicas, 'caracteristicas_seleccionadas' => $arregloCaracteristicas);
                        break;
                    case 3:
                        $partes = $this->model_evaluacion->getPartes();
                        $parteSeleccionada = $this->model_evaluacion->getParteSeleccionada($idEvaluacion);
                        foreach ($parteSeleccionada->result_array() as $p) {
                            $idParte = $p['idParte'];
                        }
                        $datos = array('partes' => $partes, 'parte_seleccionada' => $idParte); //Guardo el resultado de la consulta en un arreglo para pasar a la vista
                        break;
                    case 4:
                        $seguridad_fisica = 'N/A';
                        $economico = 'N/A';
                        $seguridad_acceso = 'N/A';
                        $data = $this->model_evaluacion->cargarRigor($idEvaluacion);
                        foreach ($data->result_array() as $dato) {
                            $rigor = $dato['idEvaluacionRigor'];
                        }
                        if ($rigor <> 0) {
                            $evaluacionRigor = $this->model_evaluacion->getEvaluacionRigor($rigor);
                            foreach ($evaluacionRigor->result_array() as $r) {
                                $seguridad_fisica = $r['seguridad_fisica'];
                                $economico = $r['economico'];
                                $seguridad_acceso = $r['seguridad_acceso'];
                            }
                        }

                        $datos = array('seguridad_fisica' => $seguridad_fisica, 'economico' => $economico, 'seguridad_acceso' => $seguridad_acceso);
                        break;
                };
                break;
            case 2:
                switch ($paso) {
                    case 0:

                        break;
                    case 1:
                        $cant = 0;
                        $subcaracteristicas = array();
                        $scseleccionadas = array();
                        $cSeleccionada = '';
                        $idCaracteristica = 0;
                        $caracteristicas = $this->model_evaluacion->getCaracteristicasEvaluacion($idEvaluacion); //TRAE LAS CARACTERISTICAS DE LA EVALUACIÓN
                        if ($this->input->post()) {
                            $idCaracteristica = $this->input->post('valor');
                            $subcaracteristicas = $this->model_evaluacion->getSubcaracteristicas_Caracteristica($idCaracteristica); //TODAS LAS SUBC DE ESA CARACT
                            $data = $this->model_evaluacion->getSubcaracteristicasEvaluacionCaracteristica($idEvaluacion, $idCaracteristica); //TODAS LAS SUBC SELECCIONADAS SI HAY
                            foreach ($data->result_array() as $dato) {
                                $scseleccionadas[$cant] = $dato['idSubcaracteristica']; //ARREGLO DE SUBCARACT. SELECCIONADAS
                                $cant++;
                            };
                            $data = $this->model_evaluacion->getCaracteristica($idCaracteristica);
                            foreach ($data->result_array() as $dato) {
                                $cSeleccionada = $dato['nombre']; //GUARDA NOMBRE DE CARAC. SELECCIONADA
                            }
                        }
                        $datos = array('caracteristicas' => $caracteristicas, 'cSeleccionada' => $cSeleccionada, 'subcaracteristicas' => $subcaracteristicas, 'scseleccionadas' => $scseleccionadas, 'idCaracteristica' => $idCaracteristica);
                        break;
                    case 2:
                        unset($_SESSION['ExitoNiveles']);
                        unset($_SESSION['ErrorNiveles']);
                        $caracteristicas = $this->model_evaluacion->getCaracteristicasEvaluacion($idEvaluacion);
                        $caracteristica = '';
                        $subcaracteristicas = array();
                        $inaceptable = '';
                        $min_aceptable = '';
                        $aceptable = '';
                        $excede = '';
                        $asignado = array();
                        if ($this->input->post()) {
                            $carac = $this->input->post('carac');
                            $car = $this->model_evaluacion->getCaracteristica($carac);
                            foreach ($car->result_array() as $c) {
                                $caracteristica = $c;
                            }
                            $subcaracteristicas = $this->model_evaluacion->getSubcaracteristicasEvaluacionCaracteristica($idEvaluacion, $carac);
                            foreach ($subcaracteristicas->result_array() as $s) {
                                $p = array();
                                $p['id'] = $s['idSubcaracteristica'];
                                $subcar = $this->model_evaluacion->getEvaluacionSubcaracteristica($idEvaluacion, $s['idSubcaracteristica']);
                                foreach ($subcar->result_array() as $sub) {
                                    $subc_nivel = $this->model_evaluacion->getSubcaracteristicaNivel($sub['idEvaluacionSubcaracteristica']);
                                }
                                if (!empty($subc_nivel->result_array())) {
                                    $p['asignado'] = true;
                                    foreach ($subc_nivel->result_array() as $sn) {
                                        switch ($sn['idNivel']) {
                                            case 1:
                                                $p['inaceptable'] = $sn['valorMaximo'];
                                                break;
                                            case 2:
                                                $p['min_aceptable'] = $sn['valorMaximo'];
                                                break;
                                            case 3:
                                                $p['aceptable'] = $sn['valorMaximo'];
                                                break;
                                            case 4:
                                                $p['excede'] = $sn['valorMaximo'];
                                                break;
                                        }
                                    }
                                } else {
                                    $p['asignado'] = false;
                                }
                                $asignado[] = $p;
                            }
                        }

                        $datos = array('subcaracteristicas' => $subcaracteristicas, 'caracteristicas' => $caracteristicas, 'caracteristica' => $caracteristica, 'asignado' => $asignado, 'inaceptable' => $inaceptable, 'min_aceptable' => $min_aceptable, 'aceptable' => $aceptable, 'excede' => $excede);
                        break;
                    case 3:
                        $caracteristicas = array();
                        $car = $this->model_evaluacion->getCaracteristicasEvaluacion($idEvaluacion);
                        foreach ($car->result_array() as $c) {
                            $c['subcaracteristicas'] = $this->model_evaluacion->getSubcaracteristicasEvaluacionCaracteristica($idEvaluacion, $c['idCaracteristica']);
                            $cant = 0;
                            foreach ($c['subcaracteristicas']->result_array() as $s) {
                                $c['asignado_inac' . $s['idSubcaracteristica']] = false;
                                $c['asignado_minac' . $s['idSubcaracteristica']] = false;
                                $c['asignado_acep' . $s['idSubcaracteristica']] = false;
                                $c['asignado_excede' . $s['idSubcaracteristica']] = false;
                                $cant += 1;
                                $subc = $this->model_evaluacion->getEvaluacionSubcaracteristica($idEvaluacion, $s['idSubcaracteristica']);
                                foreach ($subc->result_array() as $su) {
                                    $sub = $su;
                                }
                                if ($sub['nivel_inac'] != null) {
                                    $c['asignado_inac' . $s['idSubcaracteristica']] = true;
                                    $c['inaceptable' . $s['idSubcaracteristica']] = $sub['nivel_inac'];
                                }
                                if ($sub['nivel_minac'] != null) {
                                    $c['asignado_minac' . $s['idSubcaracteristica']] = true;
                                    $c['min_aceptable' . $s['idSubcaracteristica']] = $sub['nivel_minac'];
                                }
                                if ($sub['nivel_acep'] != null) {
                                    $c['asignado_acep' . $s['idSubcaracteristica']] = true;
                                    $c['aceptable' . $s['idSubcaracteristica']] = $sub['nivel_acep'];
                                }
                                if ($sub['nivel_excede'] != null) {
                                    $c['asignado_excede' . $s['idSubcaracteristica']] = true;
                                    $c['excede' . $s['idSubcaracteristica']] = $sub['nivel_excede'];
                                }
                            }
                            switch ($c['idCaracteristica']) {
                                case 1:
                                    if ($cant == 3) {
                                        $c['cantidad'] = $cant;
                                        $caracteristicas[] = $c;
                                    }
                                    break;
                                case 2:
                                    if ($cant == 3) {
                                        $c['cantidad'] = $cant;
                                        $caracteristicas[] = $c;
                                    }
                                    break;
                                case 3:
                                    if ($cant == 2) {
                                        $c['cantidad'] = $cant;
                                        $caracteristicas[] = $c;
                                    }
                                    break;
                                case 4:
                                    if ($cant == 6) {
                                        $c['cantidad'] = $cant;
                                        $caracteristicas[] = $c;
                                    }
                                    break;
                                case 5:
                                    if ($cant == 4) {
                                        $c['cantidad'] = $cant;
                                        $caracteristicas[] = $c;
                                    }
                                    break;
                                case 6:
                                    if ($cant == 5) {
                                        $c['cantidad'] = $cant;
                                        $caracteristicas[] = $c;
                                    }
                                    break;
                                case 7:
                                    if ($cant == 5) {
                                        $c['cantidad'] = $cant;
                                        $caracteristicas[] = $c;
                                    }
                                    break;
                                case 8:
                                    if ($cant == 3) {
                                        $c['cantidad'] = $cant;
                                        $caracteristicas[] = $c;
                                    }
                                    break;
                            }
                        }
                        $datos = array('caracteristicas' => $caracteristicas);
                        break;
                };
                break;
            case 3:
                switch ($paso) {
                    case 0:

                        break;
                    case 1:
                        $actividades = '';
                        $resul = $this->model_evaluacion->getActividades($idEvaluacion);
                        foreach ($resul->result_array() as $a) {
                            $actividades = $a['actividades'];
                        }
                        $datos = array('actividades' => $actividades);
                        break;
                };
                break;
            case 4:
                switch ($paso) {
                    case 0:
                        break;
                    case 1:
                        $preguntas = array();
//$resp = array();
                        $cSeleccionada = '';
                        $valor = 0;
                        if ($this->input->post()) {
                            $valor = $this->input->post('valor');
                            $preguntas = $this->model_evaluacion->obtenerPreguntas($valor, $idEvaluacion);
//$resp = $this->model_evaluacion->obtenerRespuestas($idEvaluacion);
                            $data = $this->model_evaluacion->getCaracteristica($valor);
                            foreach ($data->result_array() as $dato) {
                                $cSeleccionada = $dato['nombre'];
                            }
                        }
                        $caracteristicas = $this->model_evaluacion->getCaracteristicasEvaluacion($idEvaluacion); //PONER IDEVALUACION
                        $datos = array('caracteristicas' => $caracteristicas, 'preguntas' => $preguntas, 'caracteristica' => $cSeleccionada, 'idCaracteristica' => $valor);
                        break;
                };
                break;
            case 5:
                switch ($paso) {
                    case 0:

                        break;
                    case 1:
                        $this->cargarResultadosCriterios();
                        break;
                    case 2:
                        $feedback = '';
//                        if ($this->input->post()) {
//                            $feedback = $this->input->post('feedback');
//                            $this->model_evaluacion->agregarFeedback($feedback, $idEvaluacion);
//                        }
                        $resul = $this->model_evaluacion->getFeedback($idEvaluacion);
                        foreach ($resul->result_array() as $f) {
                            $feedback = $f['feedback'];
                        }
                        $datos = array('feedback' => $feedback);
                        break;
                    case 3:
                        $idTratamiento = '';
                        if ($this->input->post()) {
                            $idTratamiento = $this->input->post('tratamiento');
                        }
                        $estados = $this->model_evaluacion->getEstados();
                        $datos = array('estados' => $estados, 'idTratamiento' => $idTratamiento);
                        break;
                };
                break;
        }

        if ($datos == null) {
            $this->load->view('tarea_paso/tarea' . $tarea . '/view_tarea' . $tarea . '_paso' . $paso, $datos2);
        } else {
            $this->load->view('tarea_paso/tarea' . $tarea . '/view_tarea' . $tarea . '_paso' . $paso, $datos);
        }
    }

    public function cargarResultadosCriterios() {
        $this->load->model('model_evaluacion');
        $idEvaluacion = $this->session->userdata('idEvaluacion');
        $subcaracteristicas = $this->model_evaluacion->getSubcaracteristicasEvaluacion($idEvaluacion);
        foreach ($subcaracteristicas->result_array() as $s) {
            $valorSubcaracteristica = 0;
            $respuestas = array();
            $criterios = $this->model_evaluacion->getCriterios($s['idSubcaracteristica']);
            foreach ($criterios->result_array() as $c) {
                $preguntas = $this->model_evaluacion->getPreguntasCriterio($c['idCriterio']);
                foreach ($preguntas->result_array() as $p) {
                    $respuesta = $this->model_evaluacion->getRespuestaPregunta($idEvaluacion, $p['idPregunta']);
                    foreach ($respuesta->result_array() as $r) {
                        $respuestas[$r['idPregunta']] = $r['respuesta'];
                    }
                }
            }
            switch ($s['idSubcaracteristica']) {
                case 9:
                    if ($respuestas[66] == "SI") {
                        $valorSubcaracteristica += 1;
                    }
                    if (($respuestas[58] == "SI") || ($respuestas[60] == "NO") || ($respuestas[61] == "SI")) {
                        $valorSubcaracteristica += 1;
                    }
                    if ((($respuestas[62] == "SI") || ($respuestas[63] == "SI") || ($respuestas[64] == "SI")) && ($respuestas[65] == "SI")) {
                        $valorSubcaracteristica += 1;
                    }
                    break;
                case 10:
                    if (($respuestas[44] == "SI") && ($respuestas[45] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if ($respuestas[44] == "SI") {
                            $valorSubcaracteristica += 0.75;
                        } else {
                            if ($respuestas[45] == "SI") {
                                $valorSubcaracteristica += 0.5;
                            }
                        }
                    }
                    if (($respuestas[62] == "SI") || ($respuestas[63] == "SI") || ($respuestas[64] == "SI")) {
                        $valorSubcaracteristica += 1;
                    }
                    if ($respuestas[59] == "SI") {
                        $valorSubcaracteristica += 1;
                    }
                    if (($respuestas[58] == "SI") && ($respuestas[60] == "NO") && ($respuestas[61] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if (($respuestas[60] == "NO") && ($respuestas[61] == "SI")) {
                            $valorSubcaracteristica += 0.75;
                        } else {
                            if (($respuestas[60] == "NO") || ($respuestas[61] == "SI")) {
                                $valorSubcaracteristica += 0.5;
                            } else {
                                if ($respuestas[58] == "SI") {
                                    $valorSubcaracteristica += 0.25;
                                }
                            }
                        }
                    }
                    if (($respuestas[54] == "SI") && ($respuestas[55] == "SI") && ($respuestas[56] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if (($respuestas[54] == "SI") && ($respuestas[55] == "SI")) {
                            $valorSubcaracteristica += 0.75;
                        } else {
                            if (($respuestas[54] == "SI") || ($respuestas[55] == "SI")) {
                                $valorSubcaracteristica += 0.5;
                            }
                        }
                    }
                    break;
                case 11:
                    if ((($respuestas[62] == "SI") || ($respuestas[63] == "SI") || ($respuestas[64] == "SI")) && ($respuestas[66] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if (($respuestas[62] == "SI") || ($respuestas[63] == "SI") || ($respuestas[64] == "SI")) {
                            $valorSubcaracteristica += 0.75;
                        }
                    }
                    if (($respuestas[51] == "SI") && ($respuestas[52] == "SI") && ($respuestas[53] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if (($respuestas[51] == "SI") || ($respuestas[52] == "SI") || ($respuestas[53] == "SI")) {
                            $valorSubcaracteristica += 0.5;
                        }
                    }
                    if ($respuestas[40] == "SI") {
                        $valorSubcaracteristica += 1;
                    }
                    if ($respuestas[43] == "SI") {
                        $valorSubcaracteristica += 1;
                    }
                    if (($respuestas[37] == "NO") && ($respuestas[38] == "NO") && ($respuestas[39] == "NO")) {
                        $valorSubcaracteristica += 1;
                    }
                    if ((($respuestas[46] == "NO") && ($respuestas[48] == "SI")) || ($respuestas[57] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if (($respuestas[46] == "NO") || ($respuestas[48] == "SI")) {
                            $valorSubcaracteristica += 0.5;
                        } else {
                            if ((($respuestas[46] == "SI") && ($respuestas[48] == "NO")) && ($respuestas[57] == "SI")) {
                                $valorSubcaracteristica += 0.25;
                            }
                        }
                    }
                    if ((($respuestas[44] == "SI") || ($respuestas[45] == "SI")) && ($respuestas[50] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if ($respuestas[50] == "SI") {
                            $valorSubcaracteristica += 0.75;
                        } else {
                            if (($respuestas[44] == "SI") || ($respuestas[45] == "SI")) {
                                $valorSubcaracteristica += 0.5;
                            }
                        }
                    }
                    break;
                case 12:
                    if ($respuestas[56] == "SI") {
                        $valorSubcaracteristica += 1;
                    }
                    if ($respuestas[59] == "SI") {
                        $valorSubcaracteristica += 1;
                    }
                    if (($respuestas[58] == "SI") && ($respuestas[60] == "NO") && ($respuestas[61] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if (($respuestas[60] == "NO") && ($respuestas[61] == "SI")) {
                            $valorSubcaracteristica += 0.75;
                        } else {
                            if (($respuestas[60] == "NO") || ($respuestas[61] == "SI")) {
                                $valorSubcaracteristica += 0.5;
                            } else {
                                if ($respuestas[58] == "SI") {
                                    $valorSubcaracteristica += 0.25;
                                }
                            }
                        }
                    }
                    if (($respuestas[54] == "SI") && ($respuestas[55] == "SI") && ($respuestas[56] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if (($respuestas[54] == "SI") && ($respuestas[55] == "SI")) {
                            $valorSubcaracteristica += 0.75;
                        } else {
                            if (($respuestas[54] == "SI") || ($respuestas[55] == "SI")) {
                                $valorSubcaracteristica += 0.5;
                            }
                        }
                    }
                    break;
                case 13:
                    if ($respuestas[49] == "NO") {
                        $valorSubcaracteristica += 1;
                    }
                    if (($respuestas[43] == "SI") && ($respuestas[47] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if ($respuestas[43] == "SI") {
                            $valorSubcaracteristica += 0.75;
                        } else {
                            if ($respuestas[47] == "SI") {
                                $valorSubcaracteristica += 0.25;
                            }
                        }
                    }
                    if ((($respuestas[46] == "NO") && ($respuestas[48] == "SI")) || ($respuestas[57] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if (($respuestas[46] == "NO") || ($respuestas[48] == "SI")) {
                            $valorSubcaracteristica += 0.5;
                        } else {
                            if ((($respuestas[46] == "SI") && ($respuestas[48] == "NO")) && ($respuestas[57] == "SI")) {
                                $valorSubcaracteristica += 0.25;
                            }
                        }
                    }
                    if (($respuestas[37] == "NO") && ($respuestas[38] == "NO") && ($respuestas[39] == "NO")) {
                        $valorSubcaracteristica += 1;
                    }
                    if (($respuestas[48] == "SI") && ($respuestas[51] == "SI") && ($respuestas[66] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if ((($respuestas[51] == "SI") || ($respuestas[66] == "SI")) && ($respuestas[48] == "SI")) {
                            $valorSubcaracteristica += 0.75;
                        } else {
                            if ($respuestas[48] == "SI") {
                                $valorSubcaracteristica += 0.5;
                            } else {
                                if (($respuestas[51] == "SI") || ($respuestas[66] == "SI")) {
                                    $valorSubcaracteristica += 0.25;
                                }
                            }
                        }
                    }
                    break;
                case 14:
                    if ($respuestas[52] == "SI") {
                        $valorSubcaracteristica += 1;
                    }
                    if (($respuestas[41] == "NO") && ($respuestas[42] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if (($respuestas[41] == "NO") || ($respuestas[42] == "SI")) {
                            $valorSubcaracteristica += 0.75;
                        }
                    }
                    if (($respuestas[34] == "SI") && ($respuestas[35] == "SI") && ($respuestas[36] == "SI")) {
                        $valorSubcaracteristica += 1;
                    } else {
                        if ((($respuestas[34] == "SI") || ($respuestas[35] == "SI")) && ($respuestas[36] == "SI")) {
                            $valorSubcaracteristica += 0.75;
                        } else {
                            if ($respuestas[36] == "SI") {
                                $valorSubcaracteristica += 0.5;
                            } else {
                                if (($respuestas[34] == "SI") || ($respuestas[35] == "SI")) {
                                    $valorSubcaracteristica += 0.25;
                                }
                            }
                        }
                    }
                    break;
                case 19:
                    break;
                case 20:
                    break;
                case 21:
                    break;
                case 22:
                    break;
                case 23:
                    break;
            }
            $valorTotal = $valorSubcaracteristica / $s['puntajeTotal'];
            $this->model_evaluacion->asignarValorSubcaracteristica($s['idSubcaracteristica'], $idEvaluacion, $valorTotal);
        }
    }

    public function guardarFuncionalidad() {
        $this->load->model('model_evaluacion');
        $idEvaluacion = $this->session->userdata('idEvaluacion');
        if ($this->input->post()) { //SE RECIBEN DATOS
            $nombre = $this->input->post('name');
            $descripcion = $this->input->post('description');
            $parte = $this->input->post('parte');
            unset($_SESSION['ExitoAtr']);
            unset($_SESSION['ErrorAtr']);
        }

        $partes = $this->model_evaluacion->getPartes();

        $datos = array('partes' => $partes, 'parte_seleccionada' => $parte);
        $this->load->view('tarea_paso/tarea1/view_tarea1_paso3', $datos);
    }

    public function guardado($tarea, $paso) {
        unset($_SESSION['Exito']);
        $this->load->model('model_evaluacion');
        $idEvaluacion = $this->session->userdata('idEvaluacion');
        switch ($tarea) {
            case 1:
                switch ($paso) {
                    case 0:
                        break;
                    case 1:
                        unset($_SESSION['ExitoProposito']);
                        unset($_SESSION['ErrorProposito']);
                        if ($this->input->post()) {
                            $proposito = $this->input->post('proposito');

                            if ($proposito == '') {
                                $this->session->set_flashdata('ErrorProposito', 'El propósito no puede estar vacío');
                                $resul = $this->model_evaluacion->cargarProposito($idEvaluacion);
                                foreach ($resul->result_array() as $e) {
                                    $proposito = $e['proposito'];
                                }
                            } else {
                                $existeProposito = $this->model_evaluacion->existeProposito($idEvaluacion);
                                if ($existeProposito) { //SE FIJA SI ES UNA EDICIÓN O LA PRIMERA VEZ
                                    $this->model_evaluacion->editarProposito($proposito, $idEvaluacion);
                                    $this->session->set_flashdata('ExitoProposito', '¡Se editaron los datos exitosamente!');
                                } else {
                                    $this->model_evaluacion->guardarProposito($proposito, $idEvaluacion);
                                    $this->session->set_flashdata('ExitoProposito', '¡Se cargó el propósito exitosamente!');
                                }
                            }
                        }

                        $datos = array('proposito' => $proposito);

                        break;
                    case 2:
                        unset($_SESSION['ExitoCar']);
                        unset($_SESSION['ErrorCar']);
                        $arregloCaracteristicas = array();
                        $cant = 0;
                        if ($this->input->post()) { //SE RECIBEN DATOS
                            $caracteristicas = $this->input->post('car');
                            $existe = $this->model_evaluacion->existe_1_2($idEvaluacion); //SI EXISTE AL MENOS UNA CARACTERISTICA EN LA BASE
                            if ($existe) { //SI EXISTE, ES UNA EDICIÓN
                                $this->model_evaluacion->eliminarCaracteristicas($idEvaluacion);
                                $this->session->set_flashdata('ExitoCar', '¡Se editaron los datos exitosamente!');
                            } else { //SI NO EXISTE, ES LA PRIMERA VEZ
                                $this->session->set_flashdata('ExitoCar', '¡Se cargaron los datos exitosamente!');
                            }
                            foreach ($caracteristicas as $c) { //POR CADA CARACTERISTICA SELECCIONADA POR EL USUARIO
                                $this->model_evaluacion->guardarCaracteristicas($c, $idEvaluacion); //LOS ACTUALIZA
                            }
                        } else {
                            $this->session->set_flashdata('ErrorCar', 'Debe seleccionar al menos una característica');
                        }

                        $resul = $this->model_evaluacion->cargar_1_2($idEvaluacion);
                        foreach ($resul->result_array() as $e) {
                            $arregloCaracteristicas[$cant] = $e['idCaracteristica'];
                            $cant++;
                        }

                        $caracteristicas = $this->model_evaluacion->getCaracteristicas();
                        $datos = array('caracteristicas' => $caracteristicas, 'caracteristicas_seleccionadas' => $arregloCaracteristicas);
                        break;
                    case 3:
                        unset($_SESSION['ExitoPart']);
                        unset($_SESSION['ErrorPart']);
                        if ($this->input->post()) { //SE RECIBEN DATOS
                            $parte = $this->input->post('parte');
                            if ($parte == 0) {
                                $this->session->set_flashdata('ErrorPart', 'Debe seleccionar la parte del sistema a evaluar');
                            } else {
                                $evaluacion = $this->model_evaluacion->agregarParte($parte, $idEvaluacion);
                                $this->session->set_flashdata('ExitoPart', '¡Se actualizaron los datos exitosamente!');
                            }
                        }

                        $partes = $this->model_evaluacion->getPartes();
                        $datos = array('partes' => $partes, 'parte_seleccionada' => $parte);

                        break;
                    case 4:
                        $seguridad_fisica = '';
                        $economico = '';
                        $seguridad_acceso = '';
                        if ($this->input->post()) { //SE RECIBEN DATOS
                            $seguridad_fisica = $this->input->post('seguridad_fisica');
                            $economico = $this->input->post('economico');
                            $seguridad_acceso = $this->input->post('seguridad_acceso');
                            unset($_SESSION['ExitoRigor']);
                            $data = $this->model_evaluacion->cargarRigor($idEvaluacion);
                            foreach ($data->result_array() as $dato) {
                                $rigor = $dato['idEvaluacionRigor'];
                            }
                            if ($rigor <> 0) {
                                $evaluacion = $this->model_evaluacion->modificarRigor($rigor, $seguridad_fisica, $economico, $seguridad_acceso);
                                $this->session->set_flashdata('ExitoRigor', '¡Se modificaron los datos exitosamente!');
                            } else {
                                $evaluacion = $this->model_evaluacion->agregarRigor($idEvaluacion, $seguridad_fisica, $economico, $seguridad_acceso);
                                $this->session->set_flashdata('ExitoRigor', '¡Se agregaron los datos exitosamente!');
                            }
                        }

                        $datos = array('seguridad_fisica' => $seguridad_fisica, 'economico' => $economico, 'seguridad_acceso' => $seguridad_acceso);
                        break;
                };
                break;
            case 2:
                switch ($paso) {
                    case 0:

                        break;
                    case 1:
                        unset($_SESSION['ErrorSubcar']);
                        $cant = 0;
                        $subcaracteristicas = array();
                        $scseleccionadas = array();
                        $idCaracteristica = 0;
                        $this->load->model('model_evaluacion');
                        $idEvaluacion = $this->session->userdata('idEvaluacion');
                        $idCaracteristica = $this->input->post('car');
                        $subcaracteristicas = $this->input->post('subcar');
                        if ($subcaracteristicas<>null){
                            $existe = $this->model_evaluacion->existe_2_1($idEvaluacion); //SI EXISTE AL MENOS UNA CARACTERISTICA EN LA BASE
                            if ($existe) { //SI EXISTE, ES UNA EDICIÓN
                                $this->model_evaluacion->eliminarSubcaracteristicas($idEvaluacion, $idCaracteristica);
                            }
                            foreach ($subcaracteristicas as $c) { //POR CADA CARACTERISTICA SELECCIONADA POR EL USUARIO
                                $this->model_evaluacion->guardarSubcaracteristicas($c, $idEvaluacion); //LOS ACTUALIZA
                                $criterios = $this->model_evaluacion->getCriterios($c);
                                foreach($criterios->result_array() as $cri){
                                    $this->model_evaluacion->altaCriterios($idEvaluacion, $cri['idCriterio']);
                                }
                            }
                        }else{
                            $this->session->set_flashdata('ErrorSubcar', 'Debe seleccionar al menos una subcaracterística');
                        }
                        $caracteristicas = $this->model_evaluacion->getCaracteristicasEvaluacion($idEvaluacion); //TRAE LAS CARACTERISTICAS DE LA EVALUACIÓN
                        $subcaracteristicas = $this->model_evaluacion->getSubcaracteristicas_Caracteristica($idCaracteristica); //TODAS LAS SUBC DE ESA CARACT
                        $data = $this->model_evaluacion->getSubcaracteristicasEvaluacionCaracteristica($idEvaluacion, $idCaracteristica); //TODAS LAS SUBC SELECCIONADAS SI HAY
                        foreach ($data->result_array() as $dato) {
                            $scseleccionadas[$cant] = $dato['idSubcaracteristica']; //ARREGLO DE SUBCARACT. SELECCIONADAS
                            $cant++;
                        };
                        $datos = array('caracteristicas' => $caracteristicas, 'idCaracteristica' => $idCaracteristica, 'subcaracteristicas' => $subcaracteristicas, 'scseleccionadas' => $scseleccionadas);
                        
                        break;
                    case 2:
                        if ($this->input->post()) { //SE RECIBEN DATOS
                            unset($_SESSION['ExitoNiveles']);
                            unset($_SESSION['ErrorNiveles']);
                            $inaceptable = $this->input->post('inaceptable');
                            $min_aceptable = $this->input->post('min_aceptable');
                            $aceptable = $this->input->post('aceptable');
                            $excede = $this->input->post('excede');
                            if (($inaceptable >= $min_aceptable) || ($min_aceptable >= $aceptable)) {
                                $this->session->set_flashdata('ErrorNiveles', 'Los niveles no deben solaparse');
                            } else {
                                $subcaracteristica = $this->input->post('subcaracteristica');
                                $data = $this->model_evaluacion->getEvaluacionSubcaracteristica($idEvaluacion, $subcaracteristica);
                                foreach ($data->result_array() as $d) {
                                    $evaluacion_subcaracteristica = $d['idEvaluacionSubcaracteristica'];
                                }
                                $subc_nivel = $this->model_evaluacion->getSubcaracteristicaNivel($evaluacion_subcaracteristica);
                                if (empty($subc_nivel->result_array())) {
                                    $this->model_evaluacion->agregarNivelInaceptableSub($evaluacion_subcaracteristica, $inaceptable);
                                    $this->model_evaluacion->agregarNivelMinAceptableSub($evaluacion_subcaracteristica, $min_aceptable);
                                    $this->model_evaluacion->agregarNivelAceptableSub($evaluacion_subcaracteristica, $aceptable);
                                    $this->model_evaluacion->agregarNivelExcedeSub($evaluacion_subcaracteristica, $excede);
                                    $this->session->set_flashdata('ExitoNiveles', '¡Se agregaron los datos exitosamente!');
                                } else {
                                    $this->model_evaluacion->modificarNivelInaceptableSub($evaluacion_subcaracteristica, $inaceptable);
                                    $this->model_evaluacion->modificarNivelMinAceptableSub($evaluacion_subcaracteristica, $min_aceptable);
                                    $this->model_evaluacion->modificarNivelAceptableSub($evaluacion_subcaracteristica, $aceptable);
                                    $this->model_evaluacion->modificarNivelExcedeSub($evaluacion_subcaracteristica, $excede);
                                    $this->session->set_flashdata('ExitoNiveles', '¡Se modificaron los datos exitosamente!');
                                }
                            }
                        }
                        $caracteristicas = $this->model_evaluacion->getCaracteristicasEvaluacion($idEvaluacion);
                        $carac = $this->input->post('caracteristica');
                        $car = $this->model_evaluacion->getCaracteristica($carac);
                        foreach ($car->result_array() as $c) {
                            $caracteristica = $c;
                        }
                        $subcaracteristicas = $this->model_evaluacion->getSubcaracteristicasEvaluacionCaracteristica($idEvaluacion, $carac);
                        $asignado = array();
                        foreach ($subcaracteristicas->result_array() as $s) {
                            $p = array();
                            $p['id'] = $s['idSubcaracteristica'];
                            $subcar = $this->model_evaluacion->getEvaluacionSubcaracteristica($idEvaluacion, $s['idSubcaracteristica']);
                            foreach ($subcar->result_array() as $sub) {
                                $subc_nivel = $this->model_evaluacion->getSubcaracteristicaNivel($sub['idEvaluacionSubcaracteristica']);
                            }
                            if (!empty($subc_nivel->result_array())) {
                                $p['asignado'] = true;
                                foreach ($subc_nivel->result_array() as $sn) {
                                    switch ($sn['idNivel']) {
                                        case 1:
                                            $p['inaceptable'] = $sn['valorMaximo'];
                                            break;
                                        case 2:
                                            $p['min_aceptable'] = $sn['valorMaximo'];
                                            break;
                                        case 3:
                                            $p['aceptable'] = $sn['valorMaximo'];
                                            break;
                                        case 4:
                                            $p['excede'] = $sn['valorMaximo'];
                                            break;
                                    }
                                }
                            } else {
                                $p['asignado'] = false;
                            }
                            $asignado[] = $p;
                        }
                        $datos = array('subcaracteristicas' => $subcaracteristicas, 'caracteristicas' => $caracteristicas, 'caracteristica' => $caracteristica, 'asignado' => $asignado, 'inaceptable' => $inaceptable, 'min_aceptable' => $min_aceptable, 'aceptable' => $aceptable, 'excede' => $excede);
                        break;
                    case 3:

                        break;
                };
                break;
            case 3:
                switch ($paso) {
                    case 0:

                        break;
                    case 1:
                        $actividades = '';
                        unset($_SESSION['ExitoActividades']);
                        unset($_SESSION['ErrorActividades']);
                        if ($this->input->post()) {
                            $a = $this->input->post('actividades');
                            $existe = $this->model_evaluacion->getActividades($idEvaluacion);
                            if ($a <> null) {
                                foreach ($existe->result_array() as $e) {
                                    if ($e['actividades'] <> null) { //SE FIJA SI ES UNA EDICIÓN O LA PRIMERA VEZ
                                        $this->session->set_flashdata('ExitoActividades', '¡Se editaron los datos exitosamente!');
                                    } else {
                                        $this->session->set_flashdata('ExitoActividades', '¡Se cargó el plan de actividades exitosamente!');
                                    }
                                    $actividades = $this->model_evaluacion->agregarActividades($a, $idEvaluacion);
                                }
                            } else {
                                $this->session->set_flashdata('ErrorActividades', 'Debe ingresar el plan de actividades');
                                $existe = $this->model_evaluacion->getActividades($idEvaluacion);
                                foreach ($existe->result_array() as $e) {
                                    $actividades = $e['actividades'];
                                }
                            }
                        }
                        $datos = array('actividades' => $actividades);
                        break;
                };
                break;
            case 4:
                switch ($paso) {
                    case 0:

                        break;
                    case 1:

                        $preguntas = array();
                        $cSeleccionada = '';
                        if ($this->input->post()) {
                            $valor = $this->input->post('valor');
                            $preguntas = $this->model_evaluacion->obtenerPreguntas($valor);
                            $data = $this->model_evaluacion->getCaracteristica($valor);
                            foreach ($data->result_array() as $dato) {
                                $cSeleccionada = $dato['nombre'];
                            }
                        }
                        $caracteristicas = $this->model_evaluacion->getCaracteristicasEvaluacion($idEvaluacion); //PONER IDEVALUACION
                        $datos = array('caracteristicas' => $caracteristicas, 'preguntas' => $preguntas, 'caracteristica' => $cSeleccionada, 'idCaracteristica' => $valor);
                        break;
                    case 2:

                        break;
                    case 3:

                        break;
                };
                break;
            case 5:
                switch ($paso) {
                    case 0:

                        break;
                    case 1:

                        break;
                    case 2:
                        $feedback = '';
                        unset($_SESSION['ExitoFeedback']);
                        unset($_SESSION['ErrorFeedback']);
                        if ($this->input->post()) {
                            $f = $this->input->post('feedback');
                            $existe = $this->model_evaluacion->getFeedback($idEvaluacion);
                            if ($f <> null) {
                                foreach ($existe->result_array() as $e) {
                                    if ($e['feedback'] <> null) { //SE FIJA SI ES UNA EDICIÓN O LA PRIMERA VEZ
                                        $this->session->set_flashdata('ExitoFeedback', '¡Se editaron los datos exitosamente!');
                                    } else {
                                        $this->session->set_flashdata('ExitoFeedback', '¡Se cargó el feedback exitosamente!');
                                    }
                                    $feedback = $this->model_evaluacion->agregarFeedback($f, $idEvaluacion);
                                }
                            } else {
                                $this->session->set_flashdata('ErrorFeedback', 'Debe ingresar el feedback');
                            }
                        }
                        $datos = array('feedback' => $feedback);
                        break;
                    case 3:
                        if ($this->input->post()) {
                            $idTratamiento = $this->input->post('tratamiento');
                            $this->model_evaluacion->agregarTratamiento($idTratamiento, $idEvaluacion);
                            switch ($idTratamiento) {
                                case 2:
                                    $this->session->set_flashdata('ExitoTratamiento', '¡Se finalizó la evaluación exitosamente! Los datos seguirán disponibles para su modificación.');
                                    break;
                                case 3:
//BLOQUEAR TODAS LAS SECCIONES MENOS LA DEL INFORME
                                    $this->session->set_flashdata('ExitoTratamiento', '¡Se archivó la evaluación exitosamente! Los datos no podrán modificarse.');
                                    break;
                            }
                        }
                        $estados = $this->model_evaluacion->getEstados();
                        $datos = array('estados' => $estados, 'idTratamiento' => $idTratamiento);
                        break;
                    case 4:

                        break;
                }
                break;
        }

        if ($datos == null) {
            $this->load->view('tarea_paso/tarea' . $tarea . '/view_tarea' . $tarea . '_paso' . $paso, $datos2);
        } else {
            $this->load->view('tarea_paso/tarea' . $tarea . '/view_tarea' . $tarea . '_paso' . $paso, $datos);
        }
    }

}
