<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bitacora extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Bitacora_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('pdf');
        $this->load->library('tcpdf');
    }

    public function index() {
        $data['camaras'] = $this->Bitacora_model->get_all_camaras();
        $data['contenido'] = 'bitacora/form';
        $this->load->view('sidebar_menu', $data);
    }

    public function lista(){
        $data['bitacoras'] = $this->Bitacora_model->get_all_bitacoras();
        $data['contenido'] = 'bitacora/lista';
        $this->load->view('sidebar_menu', $data);
    }

    public function detalles($id) {
        $data['bitacora'] = $this->Bitacora_model->get_bitacora_details($id);
        $this->load->view('bitacora/detalles', $data);
    }


    public function guardar() {
        // Reglas de validación del formulario
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('grabando_video', '¿Está grabando video?', 'required');
        $this->form_validation->set_rules('almacena_dias', '¿Almacena días de video?', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            // Si la validación falla, se vuelve a cargar el formulario con los datos de las cámaras
            $data['camaras'] = $this->Bitacora_model->get_all_camaras();
            $this->load->view('bitacora/form', $data);
        } else {
            // Recoger los datos de la bitácora
            $bitacora_data = array(
                'fecha' => $this->input->post('fecha'),
                'grabando_video' => $this->input->post('grabando_video'),
                'dias_video' => $this->input->post('dias_video'),
                'almacena_dias' => $this->input->post('almacena_dias'),
                'comentario' => $this->input->post('comentario')
            );
    
            // Iniciar transacción
            $this->db->trans_start();
            $this->db->insert('bitacoras', $bitacora_data);
            $bitacora_id = $this->db->insert_id();
    
            // Procesar los estados de las cámaras y las observaciones
            $estados = $this->input->post('estado');
            $observaciones = $this->input->post('observaciones'); // Obtener observaciones
    
            foreach ($estados as $camara_id => $estado) {
                $detalle_data = array(
                    'bitacora_id' => $bitacora_id,
                    'camara_id' => $camara_id,
                    'sin_alimentacion' => in_array('sin_alimentacion', $estado) ? 1 : 0,
                    'imagen_borrosa' => in_array('imagen_borrosa', $estado) ? 1 : 0,
                    'obstruida' => in_array('obstruida', $estado) ? 1 : 0,
                    'frente_al_suelo' => in_array('frente_al_suelo', $estado) ? 1 : 0,
                    'mala_iluminacion' => in_array('mala_iluminacion', $estado) ? 1 : 0,
                    'observaciones' => isset($observaciones[$camara_id]) ? $observaciones[$camara_id] : null // Guardar observación
                );
                $this->db->insert('bitacora_detalles', $detalle_data);
            }
    
            // Completar la transacción
            $this->db->trans_complete();
    
            // Verificar si la transacción fue exitosa
            if ($this->db->trans_status() === FALSE) {
                // Si algo salió mal, redirigimos de vuelta al formulario con un mensaje de error
                $this->session->set_flashdata('error', 'Hubo un error al guardar la bitácora.');
                redirect('bitacora');
            } else {
                // Si todo salió bien, redirigimos con un mensaje de éxito
                $this->session->set_flashdata('success', 'Bitácora guardada correctamente.');
                redirect('bitacora');
            }
        }
    }
    

    public function descargar_pdf($id) {
        // Verificar que el ID es un número válido
        if (!is_numeric($id)) {
            show_error('ID de bitácora inválido.', 400);
            return;
        }

        // Obtener los datos de la bitácora
        $bitacora = $this->Bitacora_model->obtener_bitacora($id);
        //var_dump($bitacora);

        if (empty($bitacora)) {
            show_error('No se encontró la bitácora solicitada.', 404);
            return;
        }

        // Configurar TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Keter');
        $pdf->SetTitle('Bitácora CTPAT');
        $pdf->SetSubject('Detalles de Bitácora CTPAT');
        $pdf->SetKeywords('CTPAT, Bitácora, Seguridad');

        // Eliminar encabezado y pie de página predeterminados
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Establecer márgenes
        $pdf->SetMargins(15, 15, 15);

        // Agregar una página
        $pdf->AddPage();

        // Preparar el contenido HTML
        $html = $this->load->view('bitacora_pdf', ['bitacora' => $bitacora], true);

        // Escribir el HTML en el PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Cerrar y generar el PDF
        $pdf->Output('Bitacora_CTPAT_' . $id . '.pdf', 'D');
    }
}
?>