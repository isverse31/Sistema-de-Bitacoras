<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Redes_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('pdf');
        $this->load->library('tcpdf');
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
        $id = $this->input->post('id'); // Capturar el ID de la bitácora
        $politicas = $this->input->post('politicas');
        $comentarios = $this->input->post('comentarios');
    
        // Si no se selecciona ninguna política, asignar 'No hay políticas evaluadas'
        if (empty($politicas)) {
            $politicas = ['No hay políticas evaluadas'];
        }

        if($comentarios == null){
            $comentarios = ['Sin comentarios'];
        }
    
        // Convertir a JSON antes de guardar en la base de datos
        $politicas_json = json_encode($politicas);
    
        // Datos a guardar
        $data = [
            'fecha' => $this->input->post('fecha'),
            'responsable' => $this->input->post('responsable'),
            'politicas' => $politicas_json,
            'estado_cumplimiento' => $this->input->post('estado_cumplimiento'),
            'comentarios' => $this->input->post('comentarios'),
        ];
    
        // Verificar si es una edición (si el ID está presente)
        if (!empty($id)) {
            // Actualizar la bitácora existente
            $this->Redes_model->actualizar($id, $data);
        } else {
            // Insertar una nueva bitácora
            $this->Redes_model->guardar($data);
        }
    
        // Redirigir o mostrar un mensaje de éxito
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

    public function descargar_pdf($id) {
        if (!is_numeric($id)) {
            show_error('ID de bitácora inválido.', 400);
            return;
        }
    
        // Obtén los detalles de la bitácora de redes
        $bitacora = $this->Redes_model->get_bitacora_by_id($id);
    
        if (empty($bitacora)) {
            show_error('No se encontró la bitácora solicitada.', 404);
            return;
        }
    
        // Inicializar TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Keter');
        $pdf->SetTitle('Bitácora de Redes');
        $pdf->SetSubject('Detalles de Bitácora de Redes');
        $pdf->SetKeywords('Redes, Bitácora, Seguridad, IT');
    
        // Configuración de márgenes
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->AddPage();
    
        // Cargar la vista y generar el contenido del PDF
        $html = $this->load->view('redes/bitacora_pdf', ['bitacora' => $bitacora], true);
        $pdf->writeHTML($html, true, false, true, false, '');
    
        // Salida del archivo PDF
        $pdf->Output('Bitacora_Redes_' . $id . '.pdf', 'D');
    }
    
}
