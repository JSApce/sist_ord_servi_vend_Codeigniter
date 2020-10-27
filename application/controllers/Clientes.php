<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Clientes extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {
        $data = array(
            'titulo' => 'Clientes cadastrados',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css',),
            'scripts' => array('vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'clientes' => $this->core_model->get_all('clientes'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('clientes/index');
        $this->load->view('layout/footer');
    }

    public function edit($cliente_id = null) {
        if (!$cliente_id || !$this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id))) {
            $this->session->set_flashdata('error', 'Cliente não encontrado');
            redirect('clientes');
        } else {

            $this->form_validation->set_rules('cliente_nome', '', 'trim|required|min_length[2]|max_length[45]');
            $this->form_validation->set_rules('cliente_sobrenome', '', 'trim|required|min_length[2]|max_length[150]');
            $this->form_validation->set_rules('cliente_data_nascimento', '', 'required');

            $cliente_tipo = $this->input->post('cliente_tipo');

//            if ($cliente_tipo == 1) {
//                $this->form_validation->set_rules('cliente_cpf', '', 'trim|required|exact_length[18]|callback_valida_cpf');
//            } else {
//                $this->form_validation->set_rules('cliente_cnpj', '', 'trim|required|exact_length[18]|callback_valida_cnpj');
//            }
            $this->form_validation->set_rules('cliente_rg_ie', '', 'trim|required|max_length[20]|callback_check_rg_ie');
            $this->form_validation->set_rules('cliente_email', '', 'trim|required|valid_email|max_length[50]|callback_check_email');
           
            if($this->input->post('cliente_telefone')){
                 $this->form_validation->set_rules('cliente_telefone', 'Telefone', 'trim|max_length[14]|callback_check_telefone');
            }else{
                
            }
           
            $this->form_validation->set_rules('cliente_celular', 'Celular', 'trim|max_length[15]');
            $this->form_validation->set_rules('cliente_cep', '', 'trim|required|exact_length[9]');
            $this->form_validation->set_rules('cliente_endereco', 'Endereço', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('cliente_numero_endereco', '', 'trim|max_length[20]');
            $this->form_validation->set_rules('cliente_bairro', '', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('cliente_complemento', '', 'trim|max_length[145]');
            $this->form_validation->set_rules('cliente_cidade', 'Cidade', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('cliente_estado', 'UF', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('cliente_obs', '', 'trim|max_length[800]');

            if ($this->form_validation->run()) {
                exit('Validado');
            } else {
                $data = array(
                    'titulo' => 'Atualizar cliente',
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                    ),
                    'cliente' => $this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id)),
                );

//                 echo '<pre>';
//                print_r($data['cliente']);
//                exit();

                $this->load->view('layout/header', $data);
                $this->load->view('clientes/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function check_rg_ie($cliente_rg_ie) {
        $cliente_id = $this->input->post('cliente_id');
        
        if($this->core_model->get_by_id('clientes', array('cliente_rg_ie' => $cliente_rg_ie, 'cliente_id !=' => $cliente_id))){
          $this->form_validation->message('check_rg_ie', 'Esse documento já existe');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function check_email($cliente_email) {
        $cliente_id = $this->input->post('cliente_id');
        
        if($this->core_model->get_by_id('clientes', array('cliente_email' => $cliente_email, 'cliente_id !=' => $cliente_id))){
          $this->form_validation->message('cliente_rg_ie', 'Esse E-mail já existe');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
