<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Camaras extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('camara_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['camaras'] = $this->camara_model->get_all_camaras();
        $data['contenido'] = 'camaras/lista';
        $this->load->view('sidebar_menu', $data);
    }

    public function agregar() {
        $this->load->view('camaras/agregar');
    }

    public function guardar() {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('modelo', 'Modelo', 'required');
        $this->form_validation->set_rules('marca', 'Marca', 'required');
        $this->form_validation->set_rules('resolucion', 'Resolución', 'required');
        $this->form_validation->set_rules('departamento', 'Departamento', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('camaras/agregar');
        } else {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'modelo' => $this->input->post('modelo'),
                'marca' => $this->input->post('marca'),
                'resolucion' => $this->input->post('resolucion'),
                'departamento' => $this->input->post('departamento'),
                'observacion' => $this->input->post('observacion')
            );
    
            // Configuración para la subida de imágenes
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|jfif';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = TRUE;
    
            $this->load->library('upload', $config);
    
            if (!empty($_FILES['imagen']['name'])) {
                if ($this->upload->do_upload('imagen')) {
                    $upload_data = $this->upload->data();
                    $data['imagen'] = $upload_data['file_name'];
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('camaras/lista', $error);
                    return;
                }
            }
    
            if ($this->camara_model->agregar_camara($data)) {
                redirect('camaras'); // Redirige a la lista de cámaras después de guardar
            } else {
                $this->load->view('camaras/lista', array('error' => 'No se pudo guardar la cámara'));
            }
            
        }
        
    }
    public function editar($id) {
        $data['camara'] = $this->camara_model->get_camara($id);
        
        if (empty($data['camara'])) {
            show_404();
        }
        
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('modelo', 'Modelo', 'required');
        $this->form_validation->set_rules('marca', 'Marca', 'required');
        $this->form_validation->set_rules('resolucion', 'Resolución', 'required');
        $this->form_validation->set_rules('departamento', 'Departamento', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('camaras/editar', $data);
        } else {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'modelo' => $this->input->post('modelo'),
                'marca' => $this->input->post('marca'),
                'resolucion' => $this->input->post('resolucion'),
                'departamento' => $this->input->post('departamento'),
                'observacion' => $this->input->post('observacion')
            );
            
            if (!empty($_FILES['imagen']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|jfif';
                $config['max_size'] = 2048;
                $config['encrypt_name'] = TRUE;
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('imagen')) {
                    $old_image = $data['camara']['imagen'];
                    if ($old_image && file_exists('./uploads/' . $old_image)) {
                        unlink('./uploads/' . $old_image);
                    }
                    
                    $upload_data = $this->upload->data();
                    $data['imagen'] = $upload_data['file_name'];
                }
            }
            
            if ($this->camara_model->actualizar_camara($id, $data)) {
                redirect('camaras');
            } else {
                $this->load->view('camaras', $data);
            }
        }
    }
    
    public function eliminar($id) {
        $camara = $this->camara_model->get_camara($id);
        
        if (empty($camara)) {
            show_404();
        }
        
        if ($camara['imagen'] && file_exists('./uploads/' . $camara['imagen'])) {
            unlink('./uploads/' . $camara['imagen']);
        }
        
        if ($this->camara_model->eliminar_camara($id)) {
            redirect('camaras');
        } else {
            show_error('No se pudo eliminar la cámara');
        }
    }
    
}