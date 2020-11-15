<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Ordem_servicos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }

        $this->load->model('ordem_servicos_model');
    }

    public function index() {
        $data = array(
            'titulo' => 'Odem de serviços cadastradas',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css',),
            'scripts' => array('vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'ordens_servicos' => $this->ordem_servicos_model->get_all(),
        );

//        echo '<pre>';
//        print_r($data['ordens_servicos']);
//        exit();

        $this->load->view('layout/header', $data);
        $this->load->view('ordem_servicos/index');
        $this->load->view('layout/footer');
    }

    /*
      [ordem_servico_id] => 1
      [ordem_servico_forma_pagamento_id] => 1
      [ordem_servico_cliente_id] => 1
      [ordem_servico_data_emissao] => 2020-02-14 17:30:35
      [ordem_servico_data_conclusao] =>
      [ordem_servico_equipamento] => Fone de ouvido
      [ordem_servico_marca_equipamento] => Awell
      [ordem_servico_modelo_equipamento] => AV1801
      [ordem_servico_acessorios] => Mouse e carregador
      [ordem_servico_defeito] => Não sai aúdio no lado esquerdo
      [ordem_servico_valor_desconto] => R$ 0.00
      [ordem_servico_valor_total] => 490.00
      [ordem_servico_status] => 0
      [ordem_servico_obs] =>
      [ordem_servico_data_alteracao] => 2020-02-19 22:58:42
      [cliente_id] => 1
      [cliente_nome] => miria
      [forma_pagamento_id] => 1
      [forma_pagamento] => Cartão de crédito
     */
}
