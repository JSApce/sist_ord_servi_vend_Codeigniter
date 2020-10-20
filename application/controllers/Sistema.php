<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Sistema extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {
        $data = array(
            'titulo' => 'Editar informações do sistema',
            'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' == 1)),
        );

<<<<<<< HEAD
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
                    ), $this->input->post()
            );
            
            $data = html_escape($data);
            $this->core_model->update('sistema', $data, array('sistema_id' == 1));
            
            redirect('sistema');
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('sistema/index');
            $this->load->view('layout/footer');
        }
=======
        $this->load->view('layout/header', $data);
        $this->load->view('sistema/index');
        $this->load->view('layout/footer');
>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
    }

//    public function add() {
//
//        $this->form_validation->set_rules('first_name', '', 'trim|required|min_length[2]|max_length[50]');
//        $this->form_validation->set_rules('last_name', '', 'trim|required|min_length[2]|max_length[50]');
//        $this->form_validation->set_rules('email', '', 'trim|required|valid_email|is_unique[users.email]|max_length[250]');
//        $this->form_validation->set_rules('username', '', 'trim|required|is_unique[users.username]|max_length[100]');
//        $this->form_validation->set_rules('password', 'Senha', 'required|min_length[5]|max_length[120]');
//        $this->form_validation->set_rules('confirm_password', 'Confirme', 'matches[password]');
//
//        if ($this->form_validation->run()) {
//
//            $username = $this->security->xss_clean($this->input->post('username'));
//            $password = $this->security->xss_clean($this->input->post('password'));
//            $email = $this->security->xss_clean($this->input->post('email'));
//            $additional_data = array(
//                'first_name' => $this->input->post('first_name'),
//                'last_name' => $this->input->post('last_name'),
//                'username' => $this->input->post('username'),
//                'active' => $this->input->post('active'),
//            );
//            $group = array($this->input->post('perfil_usuario'));
//
//            $additional_data = $this->security->xss_clean($additional_data);
//
//            $group = $this->security->xss_clean($group);
//
//            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {
//                $this->session->set_flashdata('success', 'Dados salvos com sucesso');
//            } else {
//
//                $this->session->set_flashdata('error', 'Erro ao salvar Usuário');
//            }
//
//            redirect('usuarios');
//        } else {
//
//            //Error de validação
//
//            $data = array(
//                'titulo' => 'Cadastrar usuário',
//            );
//
//            $this->load->view('layout/header', $data);
//            $this->load->view('usuarios/add');
//            $this->load->view('layout/footer');
//        }
//    }
//
//    public function del($usuario_id = null) {
//        if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {
//            $this->session->set_flashdata('error', 'Usuário não encontrado');
//            redirect('usuarios');
//        }
//
//        if ($this->ion_auth->is_admin($usuario_id)) {
//            $this->session->set_flashdata('error', 'O administrador não pode ser excluído');
//            redirect('usuarios');
//        }
//
//        if ($this->ion_auth->delete_user($usuario_id)) {
//            $this->session->set_flashdata('success', 'Usuário excluído com sucesso');
//        } else {
//            $this->session->set_flashdata('error', 'Erro ao excluir Usuário');
//        }
//        redirect('usuarios');
//    }
//
//    public function edit($usuario_id = null) {
//
//        if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {
//            $this->session->set_flashdata('error', 'Usuário não encontrado');
//            redirect('usuarios');
//        } else {
//
//            $this->form_validation->set_rules('first_name', '', 'trim|required|min_length[2]|max_length[50]');
//            $this->form_validation->set_rules('last_name', '', 'trim|required|min_length[2]|max_length[50]');
//            $this->form_validation->set_rules('email', '', 'trim|required|valid_email|callback_email_check|max_length[250]');
//            $this->form_validation->set_rules('username', '', 'trim|required|callback_username_check|max_length[100]');
//            $this->form_validation->set_rules('password', 'Senha', 'min_length[5]|max_length[120]');
//            $this->form_validation->set_rules('confirm_password', 'Confirme', 'matches[password]');
//
//
//            if ($this->form_validation->run()) {
//
//                $data = elements(
//                        array(
//                            'first_name',
//                            'last_name',
//                            'email',
//                            'username',
//                            'password',
//                            'active'
//                        ), $this->input->post()
//                );
//
//                $data = $this->security->xss_clean($data);
//
//                /* Verifica se foi passado o password */
//                $password = $this->input->post('password');
//                if (!$password) {
//                    unset($data['password']);
//                }
//
//                /* atualiza o grupo perfil se for diferente */
//                if ($this->ion_auth->update($usuario_id, $data)) {
//
//                    $perfil_usuario_db = $this->ion_auth->get_users_groups($usuario_id)->row();
//                    $perfil_usuario_post = $this->input->post('perfil_usuario');
//
//                    if ($perfil_usuario_post != $perfil_usuario_db->id) {
//                        $this->ion_auth->remove_from_group($perfil_usuario_db->id, $usuario_id);
//                        $this->ion_auth->add_to_group($perfil_usuario_post, $usuario_id);
//                    }
//
//                    $this->session->set_flashdata('success', 'Dados salvos com sucesso');
//                } else {
//                    $this->session->set_flashdata('error', 'Erro ao salvar os dados');
//                }
//                redirect('usuarios');
//            } else {
//                $data = array(
//                    'titulo' => 'Editar usuário',
//                    'usuario' => $this->ion_auth->user($usuario_id)->row(),
//                    'perfil_usuario' => $this->ion_auth->get_users_groups($usuario_id)->row(),
//                );
//
//                $this->load->view('layout/header', $data);
//                $this->load->view('usuarios/edit');
//                $this->load->view('layout/footer');
//            }
//        }
//    }
//
//    public function email_check($email) {
//        $usuario_id = $this->input->post('usuario_id');
//        if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))) {
//            $this->form_validation->set_message('email_check', 'Esse e-mail já existe');
//            return false;
//        } else {
//            return true;
//        }
//    }
//
//    public function username_check($username) {
//        $usuario_id = $this->input->post('usuario_id');
//        if ($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $usuario_id))) {
//            $this->form_validation->set_message('username_check', 'Esse usuário já existe');
//            return false;
//        } else {
//            return true;
//        }
//    }
<<<<<<< HEAD
=======

>>>>>>> 06dc01be8ba35387f08704b5bd795e883cf8282f
}
