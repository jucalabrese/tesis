<?php

class Evaluacion extends CI_Controller {

    public function iniciar_evaluacion() {
        if ($this->session->userdata('logueado') == false){
            $this->session->set_flashdata('Error', 'Debe iniciar sesión en el sitio para realizar esta acción');
            redirect(base_url("inicio/login"));
        }
        if (($this->session->userdata('idEvaluacion')) == null) {
            $nombre = '';
            $descripcion = '';
            $existe = false;
        } else {
            $idEvaluacion = $this->session->userdata('idEvaluacion');
            $this->load->model('model_evaluacion');
            $idUsuario = $this->session->userdata('id');
            if (!$this->model_evaluacion->esPropietario($idUsuario,$idEvaluacion)){
                $this->session->set_flashdata('ErrorPermisos', 'Usted no tiene permisos para realizar esta acción');
                redirect(base_url("evaluacion/evaluaciones"));
            }
            $producto = $this->model_evaluacion->cargarProducto($idEvaluacion);
            foreach ($producto->result_array() as $p) {
                $nombre = $p['nombre'];
                $descripcion = $p['descripcion'];
            }
            $existe = true;
        }
        $datos = array('nombre' => $nombre, 'descripcion' => $descripcion, 'existe' => $existe);
        $contenido = array('contenido' => $this->load->view('sitio/view_definicionProducto', $datos, true));
        $datos["cuerpo"] = $this->load->view('sitio/view_iniciarEvaluacion', $contenido, true);
        $this->load->view('sitio/view_index', $datos);
    }

    public function ver_evaluacion($idEvaluacion) {
        $evaluacion_data = array(
            'idEvaluacion' => $idEvaluacion,
            'creada' => true,
        );
        $this->session->set_userdata($evaluacion_data);
        $this->iniciar_evaluacion();
    }

    public function evaluaciones() {
        if ($this->session->userdata('logueado') == false){
            $this->session->set_flashdata('Error', 'Debe iniciar sesión en el sitio para realizar esta acción');
            redirect(base_url("inicio/login"));
        }
        $evaluacion_data = array(
            'idEvaluacion' => null,
            'creada' => false,
        );
        $this->session->set_userdata($evaluacion_data);
        $this->load->model('model_evaluacion');
        $this->load->library('pagination');
        
        $idUsuario = $this->session->userdata('id');
        
        $opciones = array();
        $desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $opciones['per_page'] = 10;
        $opciones['base_url'] = base_url() . 'evaluacion/evaluaciones/';
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

        $datos_listado['evaluaciones'] = $this->model_evaluacion->getEvaluacionesPaginadas($opciones['per_page'], $desde, $idUsuario);
        $str_links = $this->pagination->create_links();
        $datos_listado['links'] = explode('&nbsp;', $str_links);

        $datos["cuerpo"] = $this->load->view('sitio/view_evaluaciones', $datos_listado, true);
        $this->load->view('sitio/view_index', $datos);
    }

    public function definicion_producto() {
        $this->load->model('model_evaluacion');
        $nombre = '';
        $descripcion = '';
        $existe = false;
        if ($this->session->userdata('idEvaluacion') <> null) {
            $idEvaluacion = $this->session->userdata('idEvaluacion');
            $data = $this->model_evaluacion->cargarProducto($idEvaluacion);
            foreach ($data->result_array() as $dato) {
                $nombre = $dato['nombre'];
                $descripcion = $dato['descripcion'];
            }
        }
        $datos = array('nombre' => $nombre, 'descripcion' => $descripcion, 'existe' => $existe);
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
            $existe = false;
            $datos = array('nombre' => $nombre, 'descripcion' => $descripcion, 'existe' => $existe);
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
                        $cSeleccionada = '';
                        $valor = 0;
                        if ($this->input->post()) {
                            $valor = $this->input->post('valor');
                            $preguntas = $this->model_evaluacion->obtenerPreguntas($valor, $idEvaluacion);
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
                        break;
                    case 2:
                        $feedback = '';
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
                        if ($subcaracteristicas <> null) {
                            $existe = $this->model_evaluacion->existe_2_1($idEvaluacion); //SI EXISTE AL MENOS UNA SUBCARACTERISTICA EN LA BASE
                            if ($existe) { //SI EXISTE, ES UNA EDICIÓN
                                $this->model_evaluacion->eliminarSubcaracteristicas($idEvaluacion, $idCaracteristica);
                                $this->model_evaluacion->eliminarCriterios($idEvaluacion, $idCaracteristica);
                            }
                            foreach ($subcaracteristicas as $c) { //POR CADA CARACTERISTICA SELECCIONADA POR EL USUARIO
                                $this->model_evaluacion->guardarSubcaracteristicas($c, $idEvaluacion); //LOS ACTUALIZA
                                $criterios = $this->model_evaluacion->getCriterios($c);
                                foreach ($criterios->result_array() as $cri) {
                                    $this->model_evaluacion->altaCriterios($idEvaluacion, $cri['idCriterio']);
                                }
                            }
                        } else {
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
                            foreach ($existe->result_array() as $e) {
                                if ($e['feedback'] <> null) { //SE FIJA SI ES UNA EDICIÓN O LA PRIMERA VEZ
                                    $this->session->set_flashdata('ExitoFeedback', '¡Se editaron los datos exitosamente!');
                                } else {
                                    $this->session->set_flashdata('ExitoFeedback', '¡Se cargó el feedback exitosamente!');
                                }
                            }
                            $feedback = $this->model_evaluacion->agregarFeedback($f, $idEvaluacion);
                        }

                        $datos = array('feedback' => $feedback);
                        break;
                    case 3:
                            $this->model_evaluacion->agregarTratamiento(3, $idEvaluacion);
                            
                        $datos = array();
                        redirect(base_url("evaluacion/evaluaciones")); 
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
