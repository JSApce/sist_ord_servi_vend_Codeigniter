<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Vendedores extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {
        $data = array(
            'titulo' => 'Vendedores cadastrados',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css',),
            'scripts' => array('vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'vendedores' => $this->core_model->get_all('vendedores'),
        );
        
//        echo '<pre>';
//        print_r($data['vendedores']);
//        exit();

        /*
           [vendedor_id] => 1
            [vendedor_codigo] => 09842571
            [vendedor_data_cadastro] => 2020-01-27 22:24:17
            [vendedor_nome_completo] => Lucio Antonio de Souza
            [vendedor_cpf] => 946.873.070-00
            [vendedor_rg] => 36.803.319-3
            [vendedor_telefone] => 
            [vendedor_celular] => (41) 99999-9999
            [vendedor_email] => vendedor@gmail.com
            [vendedor_cep] => 80530-000
            [vendedor_endereco] => Rua das vendas
            [vendedor_numero_endereco] => 45
            [vendedor_complemento] => 
            [vendedor_bairro] => Centro
            [vendedor_cidade] => Curitiba
            [vendedor_estado] => PR
            [vendedor_ativo] => 1
            [vendedor_obs] => 
            [vendedor_data_alteracao] => 2020-01-27 22:24:17
         */
        
        $this->load->view('layout/header', $data);
        $this->load->view('vendedores/index');
        $this->load->view('layout/footer');
    }

}
