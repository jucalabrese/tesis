<?php

class Inicio extends CI_Controller {

	public function index()
	{
            $datos["cuerpo"] = $this->load->view('sitio/view_bodyInicio', '', true);
            $this->load->view('sitio/view_index', $datos);
	}
        
        public function login_datos($email)
	{
            $data = array('email' => $email);
            $datos["cuerpo"] = $this->load->view('sitio/view_login', $data, true);
            $this->load->view('sitio/view_index', $datos);
	}
        
        public function login()
	{
            $data = array('email' => '', true);
            $datos["cuerpo"] = $this->load->view('sitio/view_login', $data, true);
            $this->load->view('sitio/view_index', $datos);
	}
        
        public function principal()
	{
            redirect(base_url("inicio/index"));
	}
        
        //APARTE
                
        public function iniciar_sesion() {
            if ($this->input->post()){
                $email = $this->input->post('email');
                $clave = $this->input->post('clave');
                $this->form_validation->set_rules('email', 'e-mail', 'required');
                $this->form_validation->set_rules('clave', 'clave', 'required');
                $this->form_validation->set_message('required', 'El campo %s es obligatorio');
                if ($this->form_validation->run() == TRUE){
                    $this->load->model('model_inicio');
                    $resul = $this->model_inicio->login($email, $clave);
                    if($resul){
                      $usuario_data = array(
                        'id' => $resul->idUsuario,
                        'nombre' => $resul->nombre,
                        'logueado' => TRUE
                      );
                      $this->session->set_userdata($usuario_data);
                      redirect(base_url("evaluacion/evaluaciones")); 
                    }else{
                        $existeUser = $this->model_inicio->getUsuario($email);
                        if ($existeUser){
                            $this->session->set_flashdata('Error', 'La clave es incorrecta'); 
                            $this->login_datos($email);
                        }else{
                            $this->session->set_flashdata('Error', 'No se encuentra registrado el usuario en el sistema'); 
                            redirect(base_url("inicio/login"));
                        }
                    }
                }else{
                    unset($_SESSION['Error']); //DESTRUYE EL FLASHDATA
                    if ($email == ''){
                        $this->login();
                    }else{
                        $this->login_datos($email);
                    }   
                }
            }else{
                $this->session->set_flashdata('Error', 'No se recibieron datos');
                redirect(base_url("inicio/login"));
            }
        }
   
        public function cerrar_sesion() {
           $usuario_data = array(
              'logueado' => FALSE
           );
           $this->session->set_userdata($usuario_data);
           $this->principal();
        }   
}
