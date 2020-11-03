<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Marcas extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {
        $data = array(
            'titulo' => 'marcas cadastradas',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css',),
            'scripts' => array('vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'marcas' => $this->core_model->get_all('marcas'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('marcas/index');
        $this->load->view('layout/footer');
    }

    public function edit($marca_id = NULL) {
        if (!$marca_id || !$this->core_model->get_by_id('marcas', array('marca_id' => $marca_id))) {
            $this->session->set_flashdata('error', 'Marca não encontrada');
            redirect('marcas');
        } else {

            $this->form_validation->set_rules('marca_nome', '', 'trim|required|min_length[2]|max_length[45]|callback_check_nome_marca');

            if ($this->form_validation->run()) {

                $data = elements(
                        array(
                            'marca_nome',
                            'marca_ativa',
                        ), $this->input->post());

                $data = html_escape($data);

                $this->core_model->update('marcas', $data, array('marca_id' => $marca_id));

                redirect('marcas');
            } else {
                $data = array(
                    'titulo' => 'Atualizar marca',
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                    ),
                    'marca' => $this->core_model->get_by_id('marcas', array('marca_id' => $marca_id)),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('marcas/edit');
                $this->load->view('layout/footer');
            }
        }
    }
    
        public function del($marca_id = NULL) {
        if (!$marca_id || !$this->core_model->get_by_id('marcas', array('marca_id' => $marca_id))) {
            $this->session->set_flashdata('error', 'Marca não encontrada');
            redirect('marcas');
        } else {
            $this->core_model->delete('marcas', array('marca_id' => $marca_id));
            redirect('marcas');
        }
    }

    public function check_nome_marca($marca_nome) {
        $marca_id = $this->input->post('marca_id');

        if ($this->core_model->get_by_id('marcas', array('marca_nome' => $marca_nome, 'marca_id !=' => $marca_id))) {
            $this->form_validation->set_message('check_nome_marca', 'Esta marca já existe');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
