<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Produtos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }

        $this->load->model('produtos_model');
    }

    public function index() {
        $data = array(
            'titulo' => 'produtos cadastrados',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css',),
            'scripts' => array('vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'produtos' => $this->produtos_model->get_all(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('produtos/index');
        $this->load->view('layout/footer');
    }

    public function add() {
        $this->form_validation->set_rules('produto_descricao', 'Descrição', 'trim|required|min_length[2]|max_length[145]|is_unique[produtos.produto_descricao]');
        $this->form_validation->set_rules('produto_unidade', 'Unidade', 'trim|required|min_length[2]|max_length[5]');
        $this->form_validation->set_rules('produto_preco_custo', 'Preço de custo', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('produto_preco_venda', 'Preço de venda', 'trim|required|max_length[45]|callback_check_produto_preco_venda');
        $this->form_validation->set_rules('produto_estoque_minimo', 'Estoque mínimo', 'trim|required|greater_than_equal_to[0]');
        $this->form_validation->set_rules('produto_qtde_estoque', 'Qtde em estoque', 'trim|required');
        $this->form_validation->set_rules('produto_obs', 'observação', 'trim|max_length[200]');


        if ($this->form_validation->run()) {
            $data = elements(
                    array(
                        'produto_codigo',
                        'produto_categoria_id',
                        'produto_marca_id',
                        'produto_fornecedor_id',
                        'produto_descricao',
                        'produto_unidade',
                        'produto_preco_custo',
                        'produto_preco_venda',
                        'produto_estoque_minimo',
                        'produto_qtde_estoque',
                        'produto_ativo',
                        'produto_obs',
                    ), $this->input->post()
            );

            $data = html_escape($data);

            $this->core_model->insert('produtos', $data);

            redirect('produtos');
        } else {

            $data = array(
                'titulo' => 'Cadastrar produto',
                'scripts' => array(
                    'vendor/mask/jquery.mask.min.js',
                    'vendor/mask/app.js',
                ),
                'produto_codigo' => $this->core_model->generate_unique_code('produtos', 'numeric', 8, 'produto_codigo'),
                'marcas' => $this->core_model->get_all('marcas'),
                'categorias' => $this->core_model->get_all('categorias'),
                'fornecedores' => $this->core_model->get_all('fornecedores'),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('produtos/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($produto_id) {
        if (!$produto_id || !$this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {
            $this->session->set_flashdata('error', 'Produto não encontrado');
            redirect('produtos');
        } else {

            $this->form_validation->set_rules('produto_descricao', 'Descrição', 'trim|required|min_length[2]|max_length[145]|callback_check_produto_descricao');
            $this->form_validation->set_rules('produto_unidade', 'Unidade', 'trim|required|min_length[2]|max_length[5]');
            $this->form_validation->set_rules('produto_preco_custo', 'Preço de custo', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('produto_preco_venda', 'Preço de venda', 'trim|required|max_length[45]|callback_check_produto_preco_venda');
            $this->form_validation->set_rules('produto_estoque_minimo', 'Estoque mínimo', 'trim|required|greater_than_equal_to[0]');
            $this->form_validation->set_rules('produto_qtde_estoque', 'Qtde em estoque', 'trim|required');
            $this->form_validation->set_rules('produto_obs', 'observação', 'trim|max_length[200]');


            if ($this->form_validation->run()) {
                $data = elements(
                        array(
                            'produto_codigo',
                            'produto_categoria_id',
                            'produto_marca_id',
                            'produto_fornecedor_id',
                            'produto_descricao',
                            'produto_unidade',
                            'produto_preco_custo',
                            'produto_preco_venda',
                            'produto_estoque_minimo',
                            'produto_qtde_estoque',
                            'produto_ativo',
                            'produto_obs',
                        ), $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('produtos', $data, array('produto_id' => $produto_id));

                redirect('produtos');
            } else {

                $data = array(
                    'titulo' => 'Atualizar produto',
                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                    ),
                    'produto' => $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id)),
                    'marcas' => $this->core_model->get_all('marcas'),
                    'categorias' => $this->core_model->get_all('categorias'),
                    'fornecedores' => $this->core_model->get_all('fornecedores'),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('produtos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function check_produto_descricao($produto_descricao) {

        $produto_id = $this->input->post('produto_id');

        if ($this->core_model->get_by_id('produtos', array('produto_descricao' => $produto_descricao, 'produto_id !=' => $produto_id))) {
            $this->form_validation->set_message('check_produto_descricao', "Esse produto já existe");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function check_produto_preco_venda($produto_preco_venda) {

        $produto_preco_custo = $this->input->post('produto_preco_custo');

        $preco_custo = str_replace( array('.', ','), '', $produto_preco_custo);
        $preco_venda = str_replace( array('.', ','), '', $produto_preco_venda);
        
        if ($preco_custo > $preco_venda) {
            $this->form_validation->set_message('check_produto_preco_venda', "Preço de venda deve ser igual ou maior que o preço de custo");
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
