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
            //HOME
            'soma_vendas' => $this->home_model->get_sum_vendas(),
            'soma_ordem_servicos' => $this->home_model->get_sum_ordem_servico(),
            'total_pagar' => $this->home_model->get_sum_pagar(),
            'total_receber' => $this->home_model->get_sum_receber(),
            'produtos_mais_vendidos' => $this->home_model->get_produtos_mais_vendidos(),
            'servicos_mais_vendidos' => $this->home_model->get_servicos_mais_vendidos(),
                //CENTRAL DE NOTIFICAÇÕES
//            'contas_receber_vencidas' => $this->home_model->get_contas_receber_vencidas(),
        );

        $contador_notificacoes = 0;

        if ($this->home_model->get_contas_receber_vencidas()) {

            $data['contas_receber_vencidas'] = TRUE;
            $contador_notificacoes++;
        }

        $data['contador_notificacoes'] = $contador_notificacoes;

        $this->load->view('layout/header', $data);
        $this->load->view('home/index');
        $this->load->view('layout/footer');
    }

}
