<?php
class Camara_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_all_camaras() {
        $query = $this->db->get('camaras');
        return $query->result_array();
    }

    public function agregar_camara($data) {
        return $this->db->insert('camaras', $data);
    }

    public function get_camara($id) {
        $query = $this->db->get_where('camaras', array('id' => $id));
        return $query->row_array();
    }
    
    public function actualizar_camara($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('camaras', $data);
    }
    
    public function eliminar_camara($id) {
        $this->db->where('id', $id);
        return $this->db->delete('camaras');
    }
}