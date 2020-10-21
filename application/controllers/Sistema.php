<?php

defined('BASEPATH') or exit('Ação não permitida!');

class Sistema extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {
        $data = array(
            'titulo' => 'Editar informações do sistema',
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' == 1)),
        );

        $this->form_validation->set_rules('sistema_razao_social', 'Razão social', 'trim|required|min_length[2]|max_length[140]');
        $this->form_validation->set_rules('sistema_nome_fantasia', 'Nome fantasia', 'trim|required|min_length[2]|max_length[140]');
        $this->form_validation->set_rules('sistema_cnpj', '', 'trim|required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie', 'Inscrição estadual', 'trim|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_fixo', 'Telefone fixo', 'trim|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_movel', 'Telefone móvel', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('sistema_site_url', 'Url do site', 'trim|valid_url|max_length[100]');
        $this->form_validation->set_rules('sistema_email', 'E-mail', 'trim|required|valid_email|max_length[100]');
        $this->form_validation->set_rules('sistema_cep', 'CEP', 'trim|required|exact_length[9]');
        $this->form_validation->set_rules('sistema_endereco', 'Endereço', 'trim|required|min_length[2]|max_length[140]');
        $this->form_validation->set_rules('sistema_numero', 'Número', 'trim|max_length[25]');
        $this->form_validation->set_rules('sistema_cidade', 'Cidade', 'trim|required|min_length[2]|max_length[45]');
        $this->form_validation->set_rules('sistema_estado', 'UF', 'trim|required|exact_length[2]');
        $this->form_validation->set_rules('sistema_txt_ordem_servico', 'Texto da ordem de serviço', 'trim|max_length[800]');

        if ($this->form_validation->run()) {

            $data = elements(
                array(
                    'sistema_razao_social',
                    'sistema_nome_fantasia',
                    'sistema_cnpj',
                    'sistema_ie',
                    'sistema_telefone_fixo',
                    'sistema_telefone_movel',
                    'sistema_site_url',
                    'sistema_email',
                    'sistema_cep',
                    'sistema_endereco',
                    'sistema_numero',
                    'sistema_cidade',
                    'sistema_estado',
                    'sistema_txt_ordem_servico'
                ),
                $this->input->post()
            );

            $data = html_escape($data);
            $this->core_model->update('sistema', $data, array('sistema_id' == 1));

            redirect('sistema');
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('sistema/index');
            $this->load->view('layout/footer');
        }
    }
}
