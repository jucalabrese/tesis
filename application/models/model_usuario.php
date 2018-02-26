<?php

class Model_usuario extends CI_Model { 
    
    function __construct() {
        parent::__construct();
    }
   
    function getUsuario($email){
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('email', $email);
        $consulta = $this->db->get();
        return $consulta->row();
    }
    
    function login($email, $clave){
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('email', $email);
        $this->db->where('clave', $clave);
        $consulta = $this->db->get();
        return $consulta->row();
    }
    
    function altaPersona($nombre, $apellido, $email, $clave){
      $this->db->trans_start();

      $data = array(
          'nombre' => $nombre,
          'apellido' => $apellido,
          'email' => $email,
          'clave' => $clave,
      );

      $this->db->insert('usuario', $data);
      $this->db->trans_complete();

      return true;
    }
    
     function verificarEmail($email) {
        $this->db->select('*');
        $this->db->from('usuario as u');
        $this->db->where('u.email', $email);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return false;
        } else {
            return true;
        }
    }
}
