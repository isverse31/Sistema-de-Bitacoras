<?php
class Bitacora_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_all_bitacoras() {
        $this->db->order_by('fecha', 'DESC');
        $query = $this->db->get('bitacoras');
        return $query->result_array();
    }

    public function get_bitacora_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bitacoras');
        return $query->result_array();
    }

    public function obtener_bitacora($id) {
        $this->db->select('*');
        $this->db->from('bitacoras');
        $this->db->join('bitacora_detalles', 'bitacoras.id = bitacora_detalles.bitacora_id');
        $this->db->where('bitacoras.id', $id);
        $query = $this->db->get();
        return $query->result_array(); // O result() si prefieres un objeto
    }

    public function get_bitacora($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bitacoras');
        return $query->row_array();  // Devuelve un array asociativo
    }
    
    public function get_bitacora_details($id) {
        $this->db->select('b.*, bd.*, c.modelo, c.departamento, c.nombre');
        $this->db->from('bitacoras b');
        $this->db->join('bitacora_detalles bd', 'b.id = bd.bitacora_id');
        $this->db->join('camaras c', 'bd.camara_id = c.id');
        $this->db->where('b.id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_camaras() {
        $query = $this->db->get('camaras');
        return $query->result_array();
    }

    
}


?>