<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Pagar extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }

        $this->load->model('financeiro_model');
    }

    public function index() {
        $data = array(
            'titulo' => 'Contas a pagar cadastradas',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css',),
            'scripts' => array('vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'contas_pagar' => $this->financeiro_model->get_all_pagar(),
        );

//        echo '<pre>';
//        print_r($data['contas_pagar']);
//        exit();

        /*
          [conta_pagar_id] => 1
          [conta_pagar_fornecedor_id] => 1
          [conta_pagar_data_vencimento] => 2020-05-29
          [conta_pagar_data_pagamento] =>
          [conta_pagar_valor] => 800.00
          [conta_pagar_status] => 0
          [conta_pagar_obs] =>
          [conta_pagar_data_alteracao] => 2020-11-08 08:38:43
          [fornecedor_id] => 1
          [fornecedor] => Games true
         */

        $this->load->view('layout/header', $data);
        $this->load->view('pagar/index');
        $this->load->view('layout/footer');
    }

}
