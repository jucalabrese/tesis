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
                
        public function iniciar_sesion() {
            $this->load->model('model_usuario');
            if ($this->input->post()){
                $email = $this->input->post('email');
                $clave = $this->input->post('clave');
                $this->form_validation->set_rules('email', 'e-mail', 'required');
                $this->form_validation->set_rules('clave', 'clave', 'required');
                $this->form_validation->set_message('required', 'El campo %s es obligatorio');
                if ($this->form_validation->run() == TRUE){
                    $resul = $this->model_usuario->login($email, $clave);
                    if($resul){
                      $usuario_data = array(
                        'id' => $resul->idUsuario,
                        'nombre' => $resul->nombre,
                        'logueado' => TRUE
                      );
                      $this->session->set_userdata($usuario_data);
                      redirect(base_url("evaluacion/evaluaciones")); 
                    }else{
                        $existeUser = $this->model_usuario->getUsuario($email);
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
        
        public function registro()
	{
            $data = array(
            'nombre' => '',
            'apellido' => '',
            'email' => '',
           );
            $datos["cuerpo"] = $this->load->view('sitio/view_registro', $data, true);
            $this->load->view('sitio/view_index', $datos);
	}
        
        public function registrarse(){
            unset($_SESSION['ExitoAtr']);
            unset($_SESSION['ErrorAtr']);
            $this->load->model('model_usuario');
            if($this->input->post()){ //SE RECIBEN DATOS
                $nombre = $this->input->post('nombre');
                $apellido = $this->input->post('apellido');
                $email = $this->input->post('email');
                $clave = $this->input->post('clave');
                $this->form_validation->set_rules('nombre', 'nombre', 'required');
                $this->form_validation->set_rules('apellido', 'apellido', 'required');
                $this->form_validation->set_rules('email', 'e-mail', 'required');
                $this->form_validation->set_rules('clave', 'clave', 'required');
                $this->form_validation->set_message('required', 'El campo %s es obligatorio');
                $existe = $this->model_usuario->verificarEmail($email);
                if ($existe){
                    $this->session->set_flashdata('Error', 'El e-mail ingresado ya existe. Ingrese otra cuenta de correo electrónico.');
                }else{
                    $this->model_usuario->altaPersona($nombre, $apellido, $email, $clave);
                    $this->session->set_flashdata('Exito', 'La persona fue registrada con éxito. Inicie sesión para continuar.');
                    redirect(base_url("inicio/login"));
                }
            }
            $datos = array('nombre' => $nombre, 'apellido' => $apellido, 'email' => $email, 'clave' => $clave);
            $datos["cuerpo"] = $this->load->view('sitio/view_registro', $datos, true);
            $this->load->view('sitio/view_index', $datos);
        }  
}
