<?php

class Calculo_criterios extends CI_Controller{
    
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
         redirect(base_url("evaluacion/tarea_paso/5/1"));
    }
        
}
