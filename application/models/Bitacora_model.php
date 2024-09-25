<?php
class Bitacora_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Obtener todos los detalles de una bitácora específica
    public function get_bitacora_detalles($bitacora_id) {
        $this->db->select('*');
        $this->db->from('bitacora_detalles');
        $this->db->where('bitacora_id', $bitacora_id);
        $query = $this->db->get();
        
        return $query->num_rows() > 0 ? $query->result_array() : [];
    }

    // Obtener todas las bitácoras ordenadas por fecha
    public function get_all_bitacoras() {
        $this->db->order_by('fecha', 'DESC');
        $query = $this->db->get('bitacoras');
        return $query->result_array();
    }

    // Obtener bitácora por ID
    public function get_bitacora_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bitacoras');
        return $query->row_array(); // Devolver una única fila
    }

    // Obtener bitácora junto con sus detalles
    public function obtener_bitacora($id) {
        $this->db->select('*');
        $this->db->from('bitacoras');
        $this->db->join('bitacora_detalles', 'bitacoras.id = bitacora_detalles.bitacora_id');
        $this->db->where('bitacoras.id', $id);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    // Obtener todas las cámaras
    public function get_all_camaras() {
        $query = $this->db->get('camaras');
        return $query->result_array();
    }

    // Actualizar datos de la bitácora
    public function update_bitacora($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('bitacoras', $data);
    }

    // Actualizar los detalles de una bitácora
    public function update_bitacora_detalle($bitacora_id, $camara_id, $data) {
        $this->db->where('bitacora_id', $bitacora_id);
        $this->db->where('camara_id', $camara_id);
        return $this->db->update('bitacora_detalles', $data);
    }
    
    // Obtener detalles de una bitácora por ID
    public function get_detalles_bitacora($id) {
        $this->db->select('*');
        $this->db->from('bitacora_detalles');
        $this->db->where('bitacora_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Obtener bitácora con sus detalles por ID (similar a obtener_bitacora, puede unificarse si es necesario)
    public function get_bitacora_details($id) {
        $this->db->select('*');
        $this->db->from('bitacoras');
        $this->db->join('bitacora_detalles', 'bitacoras.id = bitacora_detalles.bitacora_id');
        $this->db->where('bitacoras.id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function actualizar_bitacora($id, $data) {
        // Usar una transacción para asegurarse de que todo se actualice correctamente
        $this->db->trans_start();

        // Actualizar los campos principales de la bitácora
        $bitacora_data = array(
            'fecha' => $data['fecha'],
            'grabando_video' => $data['grabando_video'],
            'dias_video' => $data['dias_video'],
            'almacena_dias' => $data['almacena_dias'],
            'comentario' => $data['comentario']
        );
        $this->db->where('id', $id);
        $this->db->update('bitacoras', $bitacora_data);

        // Actualizar los detalles de las cámaras
        if (!empty($data['detalles'])) {
            foreach ($this->input->post('detalles') as $detalle_id => $detalle) {
                $data = array(
                    'sin_alimentacion' => isset($detalle['sin_alimentacion']) ? 1 : 0,
                    'imagen_borrosa' => isset($detalle['imagen_borrosa']) ? 1 : 0,
                    'obstruida' => isset($detalle['obstruida']) ? 1 : 0,
                    'frente_al_suelo' => isset($detalle['frente_al_suelo']) ? 1 : 0,
                    'mala_iluminacion' => isset($detalle['mala_iluminacion']) ? 1 : 0,
                    'observaciones' => $detalle['observaciones'],
                );
            
                // Aquí, usamos el id del detalle para actualizar
                $this->db->where('id', $detalle_id); 
                $this->db->update('bitacora_detalles', $data);
            }
        }

        // Finalizar la transacción
        $this->db->trans_complete();

        // Verificar si la transacción fue exitosa
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }

        return TRUE;
    }

    public function delete_bitacora($id)
{
    // Eliminar el registro de la tabla 'bitacora' por su ID
    $this->db->where('id', $id);
    $this->db->delete('bitacoras');
    
    // Si tienes detalles asociados, también puedes eliminarlos
    $this->db->where('bitacora_id', $id);
    $this->db->delete('bitacora_detalles');
}

}
?>
