<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //TODO definir se existe sessão
    }

    public function index() {
        $data = array(
            'titulo' => 'Usuários cadastrados',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css',),
            'scripts' => array('vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'usuarios' => $this->ion_auth->users()->result()
        );

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/index');
        $this->load->view('layout/footer');
    }

    public function edit($usuario_id = null) {

        if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {
            $this->session->set_flashdata('error', 'Usuário não encontrado');
            redirect('usuarios');
        } else {
            $this->form_validation->set_rules('first_name', '', 'trim|required');
            $this->form_validation->set_rules('last_name', '', 'trim|required');
            $this->form_validation->set_rules('email', '', 'trim|required|valid_email|callback_email_check');
            $this->form_validation->set_rules('username', '', 'trim|required|callback_username_check');
            $this->form_validation->set_rules('password', 'Senha', 'min_length[5]|max_length[120]');
            $this->form_validation->set_rules('confirm_password', 'Confirme', 'matches[password]');


            if ($this->form_validation->run()) {
                exit('validado');
            } else {
                $data = array(
                    'titulo' => 'Editar usuário',
                    'usuario' => $this->ion_auth->user($usuario_id)->row(),
                    'perfil_usuario' => $this->ion_auth->get_users_groups($usuario_id)->row(),
                );
            }
        }

//        Array
//        (
//        [first_name] => Admin
//        [last_name] => istrator
//        [email] => admin@admin.com
//        [username] => administrator
//        [active] => 1
//        [perfil_usuario] => 1
//        [password] =>
//        [confirm_password] =>
//        [usuario_id] => 1
//        )
//        echo '<pre>';
//        print_r($this->input->post());
//        exit();

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/edit');
        $this->load->view('layout/footer');
    }

    public function email_check($email) {
        $usuario_id = $this->input->post('usuario_id');
        if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))) {
            $this->form_validation->set_message('email_check', 'Esse e-mail já existe');
            return false;
        } else {
            return true;
        }
    }
    
    public function username_check($username) {
        $usuario_id = $this->input->post('usuario_id');
        if ($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $usuario_id))) {
            $this->form_validation->set_message('username_check', 'Esse usuário já existe');
            return false;
        } else {
            return true;
        }
    }

    
}
