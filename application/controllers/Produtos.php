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

    public function edit($produto_id) {
        if (!$produto_id || !$this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {
            $this->session->set_flashdata('error', 'Produto não encontrado');
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

            /*
              [produto_id] => 1
              [produto_codigo] => 72495380
              [produto_data_cadastro] =>
              [produto_categoria_id] => 1
              [produto_marca_id] => 1
              [produto_fornecedor_id] => 1
              [produto_descricao] => Notebook gamer
              [produto_unidade] => UN
              [produto_codigo_barras] => 4545
              [produto_ncm] => 5656
              [produto_preco_custo] => 1.800,00
              [produto_preco_venda] => 15.031,00
              [produto_estoque_minimo] => 2
              [produto_qtde_estoque] => 3
              [produto_ativo] => 1
              [produto_obs] =>
              [produto_data_alteracao] => 2020-02-28 22:01:44
             */

//        echo '<pre>';
//        print_r($data['produtos']);
//        exit();
        }
    }

}
