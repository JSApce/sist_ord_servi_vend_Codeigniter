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
            'titulo' => 'Ordem de serviços cadastradas',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css',),
            'scripts' => array('vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'ordens_servicos' => $this->ordem_servicos_model->get_all(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('ordem_servicos/index');
        $this->load->view('layout/footer');
    }

    public function edit($ordem_servico_id = NULL) {
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {
            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada');
            redirect('os');
        } else {

            $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');
            $this->form_validation->set_rules('ordem_servico_forma_pagamento_id', '', 'required');
            $this->form_validation->set_rules('ordem_servico_equipamento', 'Equipamento', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_marca_equipamento', 'Marca', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_modelo_equipamento', 'Modelo', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_acessorios', 'Acessórios', 'trim|required|max_length[300]');
            $this->form_validation->set_rules('ordem_servico_defeito', 'Defeito', 'trim|required|max_length[900]');


            if ($this->form_validation->run()) {

                $ordem_servico_valor_total = str_replace('R$', '', trim($this->input->post('ordem_servico_valor_total')));

                $data = elements(
                        array(
                            'ordem_servico_cliente_id',
                            'ordem_servico_forma_pagamento_id',
                            'ordem_servico_status',
                            'ordem_servico_equipamento',
                            'ordem_servico_marca_equipamento',
                            'ordem_servico_modelo_equipamento',
                            'ordem_servico_defeito',
                            'ordem_servico_acessorios',
                            'ordem_servico_obs',
                            'ordem_servico_valor_desconto',
                            'ordem_servico_valor_total',
                        ), $this->input->post(),
                );

                $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_total));

                $data = html_escape($data);

                $this->core_model->update('ordens_servicos', $data, array('ordem_servico_id' => $ordem_servico_id));

                $this->ordem_servicos_model->delete_old_services($ordem_servico_id);

                $servico_id = $this->input->post('servico_id');
                $servico_quantidade = $this->input->post('servico_quantidade');
                $servico_desconto = str_replace('%', '', $this->input->post('servico_desconto'));
                $servico_preco = str_replace('R$', '', $this->input->post('servico_preco'));
                $servico_item_total = str_replace('R$', '', trim($this->input->post('servico_item_total')));

                $qty_servico = count($servico_id);


                $ordem_servico_id = $this->input->post('ordem_servico_id');

                for ($i = 0; $i < $qty_servico; $i++) {

                    $data = array(
                        'ordem_ts_id_ordem_servico' => $ordem_servico_id,
                        'ordem_ts_id_servico' => $servico_id[$i],
                        'ordem_ts_quantidade' => $servico_quantidade[$i],
                        'ordem_ts_valor_desconto' => $servico_desconto[$i],
                        'ordem_ts_valor_unitario' => $servico_preco[$i],
                        'ordem_ts_valor_total' => $servico_item_total[$i],
                    );

                    $data = html_escape($data);

                    $this->core_model->insert('ordem_tem_servicos', $data);
                }


                redirect('os/imprimir/' . $ordem_servico_id);
            } else {
                $data = array(
                    'titulo' => 'Atualizar ordem de serviço',
                    'styles' => array(
                        'vendor/select2/select2.min.css',
                        'vendor/autocomplete/jquery-ui.css',
                        'vendor/autocomplete/estilo.css',
                    ),
                    'scripts' => array(
                        'vendor/autocomplete/jquery-migrate.js',
                        'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                        'vendor/calcx/os.js',
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js',
                        'vendor/sweetalert2/sweetalert2.js',
                        'vendor/autocomplete/jquery-ui.js',
                    ),
                    'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
                    'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                    'os_tem_servicos' => $this->ordem_servicos_model->get_all_servicos_by_ordem($ordem_servico_id),
                );



                $ordem_servico = $data['ordem_servico'] = $this->ordem_servicos_model->get_by_id($ordem_servico_id);

                echo '<pre>';
                print_r($data['ordem_servico']);
                exit();

                $this->load->view('layout/header', $data);
                $this->load->view('ordem_servicos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function imprimir($ordem_servico_id = NULL) {
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {
            $this->session->set_flashdata('error', 'Oderm de serviço não encontrada');
            redirect('os');
        } else {

            $data = array(
                'titulo' => 'Escolha uma opção',
            );

            $this->load->view('layout/header', $data);
            $this->load->view('ordem_servicos/imprimir');
            $this->load->view('layout/footer');
        }
    }

    public function pdf($ordem_servico_id = NULL) {
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {
            $this->session->set_flashdata('error', 'Oderm de serviço não encontrada');
            redirect('os');
        } else {
            $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

//            echo '<pre>';
//            print_r($empresa);
//            exit();

            $ordem_servico = $this->ordem_servicos_model->get_by_id($ordem_servico_id);
//            echo '<pre>';
//            print_r($ordem_servico);
//            exit();

            $file_name = 'O.S&nmsp;' . $ordem_servico->ordem_servico_id;

            $html = '<html>';

            $html .= '<head>';
            $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Impressão de ordem de serviço</title>';



            $html .= '</head>';
            
            $html .= '<body style="font-size:12px">';
            
             $html .= '<h4>' . $empresa->sistema_razao_social . '</h4>';
            
            
            $html .= '</body>';
            
             $html .= '<html>';

            echo '<pre>';
            print_r($html);
            exit();
        }
    }

    /*
      stdClass Object
      (
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
      [ordem_servico_valor_desconto] => R$ 8.00
      [ordem_servico_valor_total] => 632.00
      [ordem_servico_status] => 0
      [ordem_servico_obs] =>
      [ordem_servico_data_alteracao] => 2020-11-21 22:17:40
      [cliente_id] => 1
      [cliente_cpf_cnpj] => 366.293.560-04
      [cliente_nome_completo] => miria fulano da silva
      [forma_pagamento_id] => 1
      [forma_pagamento] => Cartão de crédito
      )
     */

    /*
      stdClass Object
      (
      [sistema_id] => 1
      [sistema_razao_social] => System bcit INC
      [sistema_nome_fantasia] => Sistema natação now
      [sistema_cnpj] => 56.565.646/4435-43
      [sistema_ie] =>
      [sistema_telefone_fixo] => (23) 42314-4123
      [sistema_telefone_movel] => (98) 88888-8888
      [sistema_email] => jamerson.developer@gmail.com
      [sistema_site_url] =>
      [sistema_cep] => 65556-565
      [sistema_endereco] => Rua da natação,
      [sistema_numero] => 123
      [sistema_cidade] => São Luís
      [sistema_estado] => MA
      [sistema_txt_ordem_servico] => Serviços de qualidade
      [sistema_data_alteracao] => 2020-12-03 18:58:48
      )
     */

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
