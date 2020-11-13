<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Formas_pagamentos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {
        $data = array(
            'titulo' => 'Formas de pagamentos cadastradas',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css',),
            'scripts' => array('vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('formas_pagamentos/index');
        $this->load->view('layout/footer');
    }

    public function edit($forma_pagamento_id = NULL) {

        if (!$forma_pagamento_id || !$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id))) {

            $this->session->set_flasdata('error', 'Forma de pagamento não encontrada');
            redirect('modulo');
        } else {

            $this->form_validation->set_rules('forma_pagamento_nome', 'Nome da forma de pagamento', 'trim|required|min_length[2]|max_length[45]|callback_check_pagamento_nome');

            if ($this->form_validation->run()) {

                $forma_pagamento_ativa = $this->input->post('forma_pagamento_ativa');

                if ($this->db->table_exists('vendas')) {
                    if ($forma_pagamento_ativa == 0 && $this->core_model('vendas', array('venda_forma_pagamento_id' => $forma_pagamento_id, 'venda_status' => 0))) {
                        $this->session - set_flashdata('info', 'Essa forma de pagamento não pode ser desativada, pois está sendo utilizada em <i class="fab fa-product-hunt text-gray-900"></i>&nbsp;Vendas');
                        redirect('modulo');
                    }
                }

                if ($this->db->table_exists('ordem_servicos')) {
                    if ($forma_pagamento_ativa == 0 && $this->core_model('ordem_servicos', array('ordem_servico_forma_pagamento_id' => $forma_pagamento_id, 'ordem_servico_status' => 0))) {
                        $this->session - set_flashdata('info', 'Essa forma de pagamento não pode ser desativada, pois está sendo utilizada em <i class="fab fa-product-hunt text-gray-900"></i>&nbsp;Ordem de serviço');
                        redirect('modulo');
                    }
                }
                
                $data = elements(array(
                    'forma_pagamento_nome',
                    'forma_pagamento_ativa',
                    'forma_pagamento_aceita_parc',
                ), $this->input->post(),);
                
                $data = html_escape($data);
                
                $this->core_model->update('formas_pagamentos', $data, array('forma_pagamento_id' => $forma_pagamento_id));

                redirect('modulo');
            } else {

                $data = array(
                    'titulo' => 'Editar formas de pagamento',
                    'forma_pagamento' => $this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('formas_pagamentos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function check_pagamento_nome($forma_pagamento_nome) {

        $forma_pagamento_id = $this->input->post('forma_pagamento_id');

        if ($this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_nome' => $forma_pagamento_nome, 'forma_pagamento_id !=' => $forma_pagamento_id))) {

            $this->form_validation->set_message('check_pagamento_nome', 'Essa forma de pagamento já existe');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //        echo '<pre>';
//        print_r($data['formas_pagamentos']);
//        exit();

    /*
      [forma_pagamento_id] => 1
      [forma_pagamento_nome] => Cartão de crédito
      [forma_pagamento_aceita_parc] => 0
      [forma_pagamento_ativa] => 1
      [forma_pagamento_data_alteracao] => 2020-02-14 20:46:46
     */
}
