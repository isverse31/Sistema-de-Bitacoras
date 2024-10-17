<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Redes_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
    }

    // Listar todas las bitácoras
    public function index() {
        $data['bitacoras'] = $this->Redes_model->get_all_bitacoras();
        $data['contenido'] = 'redes/listar';
        $this->load->view('sidebar_menu', $data);
    }

    // Formulario para agregar nueva bitácora
    public function nueva_bitacora() {
        $data['bitacoras'] = $this->Redes_model->get_all_bitacoras();
        $data['contenido'] = 'redes/form';
        $this->load->view('sidebar_menu', $data);
    }

    public function lista(){
        $data['bitacoras'] = $this->Redes_model->get_all_bitacoras();
        $data['contenido'] = 'redes/lista';
        $this->load->view('sidebar_menu', $data);
    }

   
    // Guardar bitácora nueva o actualizada
public function guardar() {
    $data = array(
        'fecha' => $this->input->post('fecha'),
        'responsable' => $this->input->post('responsable'),
        'politicas' => json_encode($this->input->post('politicas')), // Asegúrate de que esto sea correcto
        'estado_cumplimiento' => $this->input->post('estado_cumplimiento'),
        'comentarios' => $this->input->post('comentarios')
    );

    if ($this->input->post('id')) {
        // Actualizar bitácora existente
        $this->Redes_model->update_bitacora($this->input->post('id'), $data);
        $this->session->set_flashdata('success', 'Bitácora actualizada con éxito.');
    } else {
        // Guardar nueva bitácora
        $this->Redes_model->insert_bitacora($data);
        $this->session->set_flashdata('success', 'Bitácora creada con éxito.');
    }

    redirect('redes/lista');
}


    public function detalles($id) {
        $data['bitacora'] = $this->Redes_model->get_bitacora_by_id($id);
        if (empty($data['bitacora'])) {
            show_404();
        }
        $data['contenido'] = 'redes/detalles';
        $this->load->view('sidebar_menu', $data);
        
    }

    // Editar una bitácora
    public function editar($id) {
        $data['bitacora'] = $this->Redes_model->get_bitacora_by_id($id);
        if (empty($data['bitacora'])) {
            show_404();
        }
        $data['contenido'] = 'redes/editar';
        $this->load->view('sidebar_menu', $data);
        
    }

    // Eliminar una bitácora
    public function eliminar($id) {
        $this->Redes_model->delete_bitacora($id);
        $this->session->set_flashdata('success', 'Bitácora eliminada con éxito.');
        redirect('redes/lista');
    }
}
