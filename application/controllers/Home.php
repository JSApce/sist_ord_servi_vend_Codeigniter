<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
        
        $this->load->model('home_model');
    }

    public function index() {
        
        $data = array(
            'titulo' => 'Home',
            
            'soma_vendas' => $this->home_model->get_sum_vendas(),
        );
        
        $this->load->view('layout/header', $data);
        $this->load->view('home/index');
        $this->load->view('layout/footer');
    }

}
