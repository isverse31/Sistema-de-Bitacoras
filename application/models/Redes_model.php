<?php
class Redes_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Cargar la base de datos
    }

    // Obtener todas las bitácoras
    public function get_all_bitacoras() {
        $query = $this->db->get('bitacora_redes');
        return $query->result_array();
    }

    // Obtener una bitácora por su ID
    public function get_bitacora_by_id($id) {
        $query = $this->db->get_where('bitacora_redes', array('id' => $id));
        return $query->row_array();
    }

    // Insertar una nueva bitácora
    public function insert_bitacora($data) {
        return $this->db->insert('bitacora_redes', $data);
    }

    // Actualizar una bitácora existente
    public function update_bitacora($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('bitacora_redes', $data);
    }

    // Eliminar una bitácora
    public function delete_bitacora($id) {
        $this->db->where('id', $id);
        return $this->db->delete('bitacora_redes');
    }
}
