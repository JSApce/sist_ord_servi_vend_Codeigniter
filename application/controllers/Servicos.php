<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Servicos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {
        $data = array(
            'titulo' => 'Serviços cadastrados',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css',),
            'scripts' => array('vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'servicos' => $this->core_model->get_all('servicos'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('servicos/index');
        $this->load->view('layout/footer');
    }

    
}
