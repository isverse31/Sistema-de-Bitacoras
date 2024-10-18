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
        // Carga el modelo de bitácora
        $this->load->model('Bitacora_model');

        // Obtén los datos de la bitácora y los detalles
        $data['bitacora'] = $this->Bitacora_model->get_bitacora_by_id($id);
        $data['bitacora']['detalles'] = $this->Bitacora_model->get_bitacora_detalles($id);

        // Cargar la vista con los datos
        $this->load->view('bitacora/detalles', $data);
    }

    public function guardar() {
        // Reglas de validación del formulario
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('grabando_video', '¿Está grabando video?', 'required');
        $this->form_validation->set_rules('almacena_dias', '¿Almacena días de video?', 'required');
        
        if ($this->form_validation->run() === FALSE) {
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
    
            $estados = $this->input->post('estado');
            $observaciones = $this->input->post('observaciones'); 
            
            if ($estados) {
                foreach ($estados as $camara_id => $estado) {
                    $detalle_data = array(
                        'bitacora_id' => $bitacora_id,
                        'camara_id' => $camara_id,
                        'sin_alimentacion' => isset($estado['sin_alimentacion']) ? $estado['sin_alimentacion'] : 0,
                        'imagen_borrosa' => isset($estado['imagen_borrosa']) ? $estado['imagen_borrosa'] : 0,
                        'obstruida' => isset($estado['obstruida']) ? $estado['obstruida'] : 0,
                        'frente_al_suelo' => isset($estado['frente_al_suelo']) ? $estado['frente_al_suelo'] : 0,
                        'mala_iluminacion' => isset($estado['mala_iluminacion']) ? $estado['mala_iluminacion'] : 0,
                        'observaciones' => isset($observaciones[$camara_id]) ? $observaciones[$camara_id] : null
                    );
                    $this->db->insert('bitacora_detalles', $detalle_data);
                }
            }
    
            // Completar la transacción
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'Hubo un error al guardar la bitácora.');
            } else {
                $this->session->set_flashdata('success', 'Bitácora guardada correctamente.');
            }
            redirect('bitacora');
        }
    }

    public function descargar_pdf($id) {
        if (!is_numeric($id)) {
            show_error('ID de bitácora inválido.', 400);
            return;
        }

        $bitacora = $this->Bitacora_model->obtener_bitacora($id);

        if (empty($bitacora)) {
            show_error('No se encontró la bitácora solicitada.', 404);
            return;
        }

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Keter');
        $pdf->SetTitle('Bitácora CTPAT');
        $pdf->SetSubject('Detalles de Bitácora CTPAT');
        $pdf->SetKeywords('CTPAT, Bitácora, Seguridad');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->AddPage();

        $html = $this->load->view('bitacora/bitacora_pdf', ['bitacora' => $bitacora], true);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Bitacora_CTPAT_' . $id . '.pdf', 'D');
    }

    public function editar($id)
{

    // Controlar el caché
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
    $this->output->set_header('Pragma: no-cache');

    $data['bitacora'] = $this->Bitacora_model->get_bitacora_by_id($id);

    if (!$data['bitacora']) {
        // Si no se encuentra la bitácora, puedes redirigir o mostrar un error.
        show_404();
    }

    // Obtener los detalles de la bitácora
    $data['bitacora_detalles'] = $this->Bitacora_model->get_bitacora_detalles($id);

    // Obtener todas las cámaras para que el usuario pueda verlas en el formulario de edición
    $data['camaras'] = $this->Bitacora_model->get_all_camaras();

    // Cargar la vista de edición
    $this->load->view('bitacora/editar', $data);
}


public function actualizar($id) {
    // Validar si el ID es numérico
    if (!is_numeric($id)) {
        show_error('ID inválido.', 400);
        return;
    }

    // Cargar el modelo
    $this->load->model('Bitacora_model');

    // Validación del formulario de bitácora (puedes agregar más reglas según lo que necesites)
    $this->form_validation->set_rules('fecha', 'Fecha', 'required');
    $this->form_validation->set_rules('grabando_video', '¿Está grabando video?', 'required');

    if ($this->form_validation->run() === FALSE) {
        // Si la validación falla, cargar la vista de edición nuevamente con los errores
        $data['bitacora'] = $this->Bitacora_model->get_bitacora_by_id($id);
        $data['bitacora_detalles'] = $this->Bitacora_model->get_bitacora_detalles($id);
        $this->load->view('bitacora/editar', $data);
    } else {
        // Recoger los datos principales de la bitácora
        $bitacora_data = array(
            'fecha' => $this->input->post('fecha'),
            'grabando_video' => $this->input->post('grabando_video'),
            'dias_video' => $this->input->post('dias_video'),
            'almacena_dias' => $this->input->post('almacena_dias'),
            'comentario' => $this->input->post('comentario')
        );

        // Obtener los detalles de las cámaras desde el formulario
        $detalles_camaras = $this->input->post('detalles'); // Asegurarte de que los detalles están aquí
       
        // Empaquetar todos los datos para pasarlos al modelo
        $data = array(
            'fecha' => $bitacora_data['fecha'],
            'grabando_video' => $bitacora_data['grabando_video'],
            'dias_video' => $bitacora_data['dias_video'],
            'almacena_dias' => $bitacora_data['almacena_dias'],
            'comentario' => $bitacora_data['comentario'],
            'detalles' => $detalles_camaras
        );

        // Actualizar la bitácora y los detalles de las cámaras
        if ($this->Bitacora_model->actualizar_bitacora($id, $data)) {
            $this->session->set_flashdata('success', 'La bitácora ha sido actualizada correctamente.');
        } else {
            $this->session->set_flashdata('error', 'Hubo un problema al actualizar la bitácora.');
        }

        // Redirigir al detalle de la bitácora una vez actualizada
        redirect('bitacora/detalles/' . $id);
    }
}

public function eliminar($id)
{
    // Verificar si la bitácora existe
    $bitacora = $this->Bitacora_model->get_bitacora_by_id($id);

    if (!$bitacora) {
        // Si no existe, mostrar un error 404
        show_404();
    }

    // Eliminar la bitácora
    $this->Bitacora_model->delete_bitacora($id);

    // Redirigir a la lista de bitácoras o a la página que consideres adecuada
    redirect('bitacora/lista');  // Ajusta la redirección según tu flujo de la aplicación
}

}