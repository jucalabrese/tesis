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
	
	function getSubcaracteristicas() {
        $this->db->select('*');
        $this->db->from('subcaracteristica');
        $consulta = $this->db->get();
        return $consulta;
    }

    function getCaracteristicasEvaluacion($idEvaluacion) {
        $this->db->select('*');
        $this->db->from('evaluacion_caracteristica as ea, caracteristica as c');
        $this->db->where('ea.idEvaluacion', $idEvaluacion);
        $this->db->where('ea.idCaracteristica = c.idCaracteristica');
        $consulta = $this->db->get();
        return $consulta;
    }
<<<<<<< HEAD
    
//    function getCaracteristicasEvaluacion($idEvaluacion) {
//        $this->db->select('DISTINCT(a.nombre)');
//        $this->db->from('evaluacion_caracteristica as ea, caracteristica as a');
//        $this->db->where('ea.idEvaluacion', $idEvaluacion);
//        $this->db->where('ea.idCaracteristica = a.idCaracteristica');
//        $consulta = $this->db->get();
//        return $consulta;
//    }
=======
	
	function getSubcaracteristicasEvaluacion($idEvaluacion) {
        $this->db->select('s.*');
        $this->db->from('evaluacion_subcaracteristica as es, subcaracteristica as s');
		$this->db->where('es.idEvaluacion', $idEvaluacion);
		$this->db->where('es.idSubcaracteristica = s.idSubcaracteristica');
        $consulta = $this->db->get();
        return $consulta;
    }
>>>>>>> 9f884d7b9e55adcee310cd4cf2b35136ecad4b79

    function getSubcaracteristicas_Caracteristica($idCaracteristica) { //ACA CAMBIE UNA MAYUSCULA
        $this->db->select('*');
        $this->db->from('subcaracteristica');
        $this->db->where('idCaracteristica', $idCaracteristica);
        $consulta = $this->db->get();
        return $consulta;
    }
	
	function getEvaluacionSubcaracteristica($idEvaluacion,$subcaracteristica) {
		$this->db->select('*');
        $this->db->from('evaluacion_subcaracteristica');
        $this->db->where('idSubcaracteristica', $subcaracteristica);
		$this->db->where('idEvaluacion', $idEvaluacion);
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

//    function getParteSeleccionada($idEvaluacion) {
//        $this->db->select('*');
//        $this->db->from('evaluacion as e');
//        $this->db->where('e.idEvaluacion', $idEvaluacion);
//        $consulta = $this->db->get();
//        return $consulta;
//    }

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
<<<<<<< HEAD
    
    function obtenerPreguntas($idCaracteristica){
        //SELECT DISTINCT(p.pregunta), car.idCaracteristica, p.idPregunta 
        //FROM pregunta as p INNER JOIN criterio_pregunta as cp ON cp.idPregunta=p.idPregunta INNER JOIN criterio as c ON cp.idCriterio=c.idCriterio 
        //INNER JOIN subcaracteristica as s ON c.idSubcaracteristica=s.idSubcaracteristica INNER JOIN caracteristica as car ON s.idCaracteristica = car.idCaracteristica 
        //WHERE (car.idCaracteristica = '6') ORDER BY `p`.`idPregunta` ASC
        //$consulta = $this->db->get();
        //return $consulta;
=======
	
	function getSubcaracteristicaNivel($evaluacion_subcaracteristica){
		$this->db->select('*');
        $this->db->from('subcaracteristica_nivel');
        $this->db->where('idEvaluacionSubcaracteristica', $evaluacion_subcaracteristica);
        $consulta = $this->db->get();
        return $consulta;
	}
	
	function agregarNivelInaceptableSub($evaluacion_subcaracteristica,$inaceptable) {
		$this->db->trans_start();
        $data = array(
            'idEvaluacionSubcaracteristica' => $evaluacion_subcaracteristica,
            'idNivel' => 1,
            'valorMaximo' => $inaceptable,
        );
        $this->db->insert('subcaracteristica_nivel', $data);
        $idSubcaracteristicaNivel = $this->db->insert_id();
        $this->db->trans_complete();
		return $evaluacion_subcaracteristica;
    }
	
	function agregarNivelMinAceptableSub($evaluacion_subcaracteristica,$min_aceptable) {
		$this->db->trans_start();
        $data = array(
            'idEvaluacionSubcaracteristica' => $evaluacion_subcaracteristica,
            'idNivel' => 2,
            'valorMaximo' => $min_aceptable,
        );
        $this->db->insert('subcaracteristica_nivel', $data);
        $idSubcaracteristicaNivel = $this->db->insert_id();
        $this->db->trans_complete();
		return $evaluacion_subcaracteristica;
>>>>>>> 9f884d7b9e55adcee310cd4cf2b35136ecad4b79
    }

	function agregarNivelAceptableSub($evaluacion_subcaracteristica,$aceptable) {
		$this->db->trans_start();
        $data = array(
            'idEvaluacionSubcaracteristica' => $evaluacion_subcaracteristica,
            'idNivel' => 3,
            'valorMaximo' => $aceptable,
        );
        $this->db->insert('subcaracteristica_nivel', $data);
        $idSubcaracteristicaNivel = $this->db->insert_id();
        $this->db->trans_complete();
		return $evaluacion_subcaracteristica;
    }
	
	function agregarNivelExcedeSub($evaluacion_subcaracteristica,$excede) {
		$this->db->trans_start();
        $data = array(
            'idEvaluacionSubcaracteristica' => $evaluacion_subcaracteristica,
            'idNivel' => 4,
            'valorMaximo' => $excede,
        );
        $this->db->insert('subcaracteristica_nivel', $data);
        $idSubcaracteristicaNivel = $this->db->insert_id();
        $this->db->trans_complete();
		return $evaluacion_subcaracteristica;
    }
	
	function modificarNivelInaceptableSub($evaluacion_subcaracteristica,$inaceptable) {
		$this->db->trans_start();
        $data = array(
            'valorMaximo' => $inaceptable,
        );
        $this->db->where('idEvaluacionSubcaracteristica' , $evaluacion_subcaracteristica);
		$this->db->where('idNivel' , 1);
		$this->db->update('subcaracteristica_nivel', $data);
        $this->db->trans_complete();
		return $evaluacion_subcaracteristica;
    }
	
	function modificarNivelMinAceptableSub($evaluacion_subcaracteristica,$min_aceptable) {
		$this->db->trans_start();
        $data = array(
            'valorMaximo' => $min_aceptable,
        );
        $this->db->where('idEvaluacionSubcaracteristica' , $evaluacion_subcaracteristica);
		$this->db->where('idNivel' , 2);
		$this->db->update('subcaracteristica_nivel', $data);
        $this->db->trans_complete();
		return $evaluacion_subcaracteristica;
    }

	function modificarNivelAceptableSub($evaluacion_subcaracteristica,$aceptable) {
		$this->db->trans_start();
        $data = array(
            'valorMaximo' => $aceptable,
        );
        $this->db->where('idEvaluacionSubcaracteristica' , $evaluacion_subcaracteristica);
		$this->db->where('idNivel' , 3);
		$this->db->update('subcaracteristica_nivel', $data);
        $this->db->trans_complete();
		return $evaluacion_subcaracteristica;
    }
	
	function modificarNivelExcedeSub($evaluacion_subcaracteristica,$excede) {
		$this->db->trans_start();
        $data = array(
            'valorMaximo' => $excede,
        );
        $this->db->where('idEvaluacionSubcaracteristica' , $evaluacion_subcaracteristica);
		$this->db->where('idNivel' , 4);
		$this->db->update('subcaracteristica_nivel', $data);
        $this->db->trans_complete();
		return $evaluacion_subcaracteristica;
    }
}
