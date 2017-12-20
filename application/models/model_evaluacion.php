<?php

class Model_evaluacion extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getCaracteristicas() {
        $this->db->select('*');
        $this->db->from('caracteristica');
        $consulta = $this->db->get();
        return $consulta;
    }

    function getCaracteristicasEvaluacion($idEvaluacion) {
        $this->db->select('DISTINCT(a.nombre)');
        $this->db->from('evaluacion_caracteristica as ea, caracteristica as a');
        $this->db->where('ea.idEvaluacion', $idEvaluacion);
        $this->db->where('ea.idCaracteristica = a.idCaracteristica');
        $consulta = $this->db->get();
        return $consulta;
    }

    function getSubCaracteristicas_Caracteristica($idCaracteristica) {
        $this->db->select('*');
        $this->db->from('subcaracteristica');
        $this->db->where('idCaracteristica', $idCaracteristica);
        $consulta = $this->db->get();
        return $consulta;
    }

    function guardarDefinicion($nombre, $descripcion) {
        $this->db->trans_start();
        $data1 = array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
        );

        $this->db->insert('producto', $data1);
        $idProducto = $this->db->insert_id();
        $this->db->trans_complete();

        $this->db->trans_start();
        $data2 = array(
            'idProducto' => $idProducto,
            'idUsuario' => $this->session->userdata('id'),
            'idEstadoEvaluacion' => 1,
            'idParte' => 1,
        );
        $this->db->insert('evaluacion', $data2);
        $idEvaluacion = $this->db->insert_id();
        $this->db->trans_complete();
        return $idEvaluacion;
    }

    function cargarProducto($idEvaluacion) {
        $this->db->select('*');
        $this->db->from('producto as p, evaluacion as e');
        $this->db->where('e.idEvaluacion', $idEvaluacion);
        $this->db->where('e.idProducto = p.idProducto');
        $consulta = $this->db->get();
        return $consulta;
    }

    function editarDefinicion($nombre, $descripcion, $idEvaluacion) {

        $this->db->select('*');
        $this->db->from('evaluacion as e');
        $this->db->where('e.idEvaluacion', $idEvaluacion);
        $query = $this->db->get();

        $this->db->trans_start();
        $data = array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
        );
        foreach ($query->result_array() as $q) {
            $this->db->where('idProducto', $q['idProducto']);
        }
        $this->db->update('producto', $data);
        $producto = $this->db->insert_id();
        $this->db->trans_complete();

        return $producto;
    }

    function cantEvaluaciones() {
        $consulta = $this->db->get('evaluacion');
        return $consulta->num_rows();
    }

    function getEvaluacionesPaginadas($limite, $start) {
        $this->db->select('*');
        $this->db->from('producto as p, evaluacion as e, estado_evaluacion as es');
        $this->db->where('e.idProducto = p.idProducto');
        $this->db->where('e.idEstadoEvaluacion = es.idEstadoEvaluacion');
        $this->db->limit($limite, $start);
        $this->db->order_by("idEvaluacion", "desc");
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query;
        }
    }

    function cargarProposito($idEvaluacion) {
        $this->db->select('*');
        $this->db->from('evaluacion as e');
        $this->db->where('e.idEvaluacion', $idEvaluacion);
        $consulta = $this->db->get();
        return $consulta;
    }
	
	function getNombre($idEvaluacion) {
        $this->db->select('*');
        $this->db->from('producto as p, evaluacion as e');
		$this->db->where('e.idEvaluacion', $idEvaluacion);
		$this->db->where('e.idProducto = p.idProducto');
        $query = $this->db->get();
		foreach ($query->result_array() as $q) {
            return $q['nombre'];
        }
    }
	
	function getDescripcion($idEvaluacion) {
        $this->db->select('*');
        $this->db->from('producto as p, evaluacion as e');
		$this->db->where('e.idEvaluacion', $idEvaluacion);
		$this->db->where('e.idProducto = p.idProducto');
        $query = $this->db->get();
		foreach ($query->result_array() as $q) {
            return $q['descripcion'];
        }
    }

    function guardarProposito($proposito, $idEvaluacion) {
        $this->db->trans_start();
        $data1 = array(
            'proposito' => $proposito,
        );

        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->update('evaluacion', $data1);
        $this->db->trans_complete();

        return $idEvaluacion;
    }

    function editarProposito($proposito, $idEvaluacion) {
        $this->db->trans_start();
        $data = array(
            'proposito' => $proposito,
        );

        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->update('evaluacion', $data);
        $producto = $this->db->insert_id();
        $this->db->trans_complete();

        return $producto;
    }

    function existeProposito($idEvaluacion) {
        $this->db->select('*');
        $this->db->from('evaluacion as e');
        $this->db->where('e.idEvaluacion', $idEvaluacion);
        $query = $this->db->get();

        foreach ($query->result_array() as $q) {
            if ($q['proposito'] <> null) {
                return true;
            } else {
                return false;
            }
        }
    }

    function cargar_1_2($idEvaluacion) {
        $this->db->select('*');
        $this->db->from('evaluacion_caracteristica as ec');
        $this->db->where('ec.idEvaluacion', $idEvaluacion);
        $consulta = $this->db->get();
        return $consulta;
    }

    function existe_1_2($idEvaluacion) {
        $this->db->select('*');
        $this->db->from('evaluacion_caracteristica as ec');
        $this->db->where('ec.idEvaluacion', $idEvaluacion);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return false;
        } else {
            return true;
        }
    }

    function guardarCaracteristicas($idCaracteristica, $idEvaluacion) {
        $this->db->trans_start();

        $data1 = array(
            'idEvaluacion' => $idEvaluacion,
            'idCaracteristica' => $idCaracteristica,
        );

        $this->db->insert('evaluacion_caracteristica', $data1);
        $this->db->trans_complete();

        return $idEvaluacion;
    }

    function getCaracteristicasSeleccionados($idEvaluacion) {
        $this->db->select('*');
        $this->db->from('evaluacion_caracteristica');
        $this->db->where('idEvaluacion', $idEvaluacion);
        $consulta = $this->db->get();
        return $consulta;
    }

    function eliminarCaracteristicas($idEvaluacion) {
        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->delete('evaluacion_caracteristica');
    }

    function getPartes() {
        $this->db->select('*');
        $this->db->from('parte');
        $consulta = $this->db->get();
        return $consulta;
    }

    function getParteSeleccionada($idEvaluacion) {
        $this->db->select('*');
        $this->db->from('evaluacion as e');
        $this->db->where('e.idEvaluacion', $idEvaluacion);
        $consulta = $this->db->get();
        return $consulta;
    }

    function agregarParte($parte, $idEvaluacion) {
        $this->db->trans_start();

        $data = array(
            'idParte' => $parte,
        );

        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->update('evaluacion', $data);
        $this->db->trans_complete();

        return $parte;
    }

    function cargarRigor($idEvaluacion) {
        $this->db->select('*');
        $this->db->from('evaluacion as e');
        $this->db->where('e.idEvaluacion', $idEvaluacion);
        $consulta = $this->db->get();
        return $consulta;
    }

    function getEvaluacionRigor($rigor) {
        $this->db->select('*');
        $this->db->from('evaluacion_rigor as er');
        $this->db->where('er.idEvaluacionRigor', $rigor);
        $consulta = $this->db->get();
        return $consulta;
    }

    function modificarRigor($rigor, $seguridad_fisica, $economico, $seguridad_acceso) {
        $this->db->trans_start();
        $data1 = array(
            'seguridad_fisica' => $seguridad_fisica,
            'economico' => $economico,
            'seguridad_acceso' => $seguridad_acceso,
        );
        $this->db->where('idEvaluacionRigor', $rigor);
        $this->db->update('evaluacion_rigor', $data1);
        $this->db->trans_complete();

        return $rigor;
    }

    function agregarRigor($idEvaluacion, $seguridad_fisica, $economico, $seguridad_acceso) {
        $this->db->trans_start();
        $data1 = array(
            'seguridad_fisica' => $seguridad_fisica,
            'economico' => $economico,
            'seguridad_acceso' => $seguridad_acceso,
        );
        $this->db->insert('evaluacion_rigor', $data1);
        $idEvaluacionRigor = $this->db->insert_id();
        $this->db->trans_complete();

        $this->db->trans_start();
        $this->db->where('idEvaluacion', $idEvaluacion);
        $this->db->update('evaluacion', array('idEvaluacionRigor'=>$idEvaluacionRigor));
        $this->db->trans_complete();

        return $idEvaluacion;
    }

}
