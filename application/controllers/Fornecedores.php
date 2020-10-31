<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Fornecedores extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index() {
        $data = array(
            'titulo' => 'Fornecedores cadastrados',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css',),
            'scripts' => array('vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'fornecedores' => $this->core_model->get_all('fornecedores'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/index');
        $this->load->view('layout/footer');
    }

//    public function add() {
//        $this->form_validation->set_rules('fornecedor_nome', '', 'trim|required|min_length[2]|max_length[45]');
//        $this->form_validation->set_rules('fornecedor_sobrenome', '', 'trim|required|min_length[2]|max_length[150]');
//        $this->form_validation->set_rules('fornecedor_data_nascimento', '', 'required');
//
//        $fornecedor_tipo = $this->input->post('fornecedor_tipo');
//
//        if ($fornecedor_tipo == 1) {
//            $this->form_validation->set_rules('fornecedor_cpf', '', 'trim|required|exact_length[14]|is_unique[fornecedores.fornecedor_cpf_cnpj]|callback_valida_cpf');
//        } else {
//            $this->form_validation->set_rules('fornecedor_cnpj', '', 'trim|required|exact_length[18]|is_unique[fornecedores.fornecedor_cpf_cnpj]|callback_valida_cnpj');
//        }
//        $this->form_validation->set_rules('fornecedor_rg_ie', 'RG / I.E', 'trim|required|max_length[20]|is_unique[fornecedores.fornecedor_rg_ie]');
//        $this->form_validation->set_rules('fornecedor_email', '', 'trim|required|valid_email|max_length[50]|is_unique[fornecedores.fornecedor_email]');
//
//        if ($this->input->post('fornecedor_telefone')) {
//            $this->form_validation->set_rules('fornecedor_telefone', 'Telefone', 'trim|max_length[15]|is_unique[fornecedores.fornecedor_telefone]');
//        }
//        if ($this->input->post('fornecedor_celular')) {
//            $this->form_validation->set_rules('fornecedor_celular', 'Celular', 'trim|max_length[15]|is_unique[fornecedores.fornecedor_celular]');
//        }
//
//
//        $this->form_validation->set_rules('fornecedor_cep', '', 'trim|required|exact_length[9]');
//        $this->form_validation->set_rules('fornecedor_endereco', 'Endereço', 'trim|required|max_length[155]');
//        $this->form_validation->set_rules('fornecedor_numero_endereco', '', 'trim|max_length[20]');
//        $this->form_validation->set_rules('fornecedor_bairro', '', 'trim|required|max_length[45]');
//        $this->form_validation->set_rules('fornecedor_complemento', '', 'trim|max_length[145]');
//        $this->form_validation->set_rules('fornecedor_cidade', 'Cidade', 'trim|required|max_length[50]');
//        $this->form_validation->set_rules('fornecedor_estado', 'UF', 'trim|required|exact_length[2]');
//        $this->form_validation->set_rules('fornecedor_obs', '', 'trim|max_length[800]');
//
//        if ($this->form_validation->run()) {
//
//            $data = elements(
//                    array(
//                        'fornecedor_nome',
//                        'fornecedor_sobrenome',
//                        'fornecedor_data_nascimento',
//                        'fornecedor_rg_ie',
//                        'fornecedor_email',
//                        'fornecedor_telefone',
//                        'fornecedor_celular',
//                        'fornecedor_endereco',
//                        'fornecedor_numero_endereco',
//                        'fornecedor_complemento',
//                        'fornecedor_bairro',
//                        'fornecedor_cidade',
//                        'fornecedor_estado',
//                        'fornecedor_cep',
//                        'fornecedor_ativo',
//                        'fornecedor_obs',
//                        'fornecedor_tipo',
//                    ), $this->input->post());
//
//            if ($fornecedor_tipo == 1) {
//                $data['fornecedor_cpf_cnpj'] = $this->input->post('fornecedor_cpf');
//            } else {
//                $data['fornecedor_cpf_cnpj'] = $this->input->post('fornecedor_cnpj');
//            }
//
//            $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));
//
//            $data = html_escape($data);
//
//            $this->core_model->insert('fornecedores', $data);
//
//            redirect('fornecedores');
//        } else {
//            $data = array(
//                'titulo' => 'Cadastrar fornecedor',
//                'scripts' => array(
//                    'vendor/mask/jquery.mask.min.js',
//                    'vendor/mask/app.js',
//                    'js/fornecedor.js',
//                ),
//            );
//
////                 echo '<pre>';
////                print_r($data['fornecedor']);
////                exit();
//
//            $this->load->view('layout/header', $data);
//            $this->load->view('fornecedores/add');
//            $this->load->view('layout/footer');
//        }
//    }

    public function edit($fornecedor_id = NULL) {
        if (!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id))) {
            $this->session->set_flashdata('error', 'Fornecedor não encontrado');
            redirect('fornecedores');
        } else {

//            $this->form_validation->set_rules('fornecedor_nome', '', 'trim|required|min_length[2]|max_length[45]');
//            $this->form_validation->set_rules('fornecedor_sobrenome', '', 'trim|required|min_length[2]|max_length[150]');
//            $this->form_validation->set_rules('fornecedor_data_nascimento', '', 'required');
//
//            $fornecedor_tipo = $this->input->post('fornecedor_tipo');
//
//            if ($fornecedor_tipo == 1) {
//                $this->form_validation->set_rules('fornecedor_cpf', '', 'trim|required|exact_length[14]|callback_valida_cpf');
//            } else {
//                $this->form_validation->set_rules('fornecedor_cnpj', '', 'trim|required|exact_length[18]|callback_valida_cnpj');
//            }
//            $this->form_validation->set_rules('fornecedor_rg_ie', 'RG / I.E', 'trim|required|max_length[20]|callback_check_rg_ie');
//            $this->form_validation->set_rules('fornecedor_email', '', 'trim|required|valid_email|max_length[50]|callback_check_email');
//
//            if ($this->input->post('fornecedor_telefone')) {
//                $this->form_validation->set_rules('fornecedor_telefone', 'Telefone', 'trim|max_length[15]|callback_check_telefone');
//            }
//            if ($this->input->post('fornecedor_celular')) {
//                $this->form_validation->set_rules('fornecedor_celular', 'Celular', 'trim|max_length[15]|callback_check_celular');
//            }
//
//
//            $this->form_validation->set_rules('fornecedor_cep', '', 'trim|required|exact_length[9]');
//            $this->form_validation->set_rules('fornecedor_endereco', 'Endereço', 'trim|required|max_length[155]');
//            $this->form_validation->set_rules('fornecedor_numero_endereco', '', 'trim|max_length[20]');
//            $this->form_validation->set_rules('fornecedor_bairro', '', 'trim|required|max_length[45]');
//            $this->form_validation->set_rules('fornecedor_complemento', '', 'trim|max_length[145]');
//            $this->form_validation->set_rules('fornecedor_cidade', 'Cidade', 'trim|required|max_length[50]');
//            $this->form_validation->set_rules('fornecedor_estado', 'UF', 'trim|required|exact_length[2]');
//            $this->form_validation->set_rules('fornecedor_obs', '', 'trim|max_length[800]');
//
//            if ($this->form_validation->run()) {
//
//                $data = elements(
//                        array(
//                            'fornecedor_nome',
//                            'fornecedor_sobrenome',
//                            'fornecedor_data_nascimento',
//                            'fornecedor_rg_ie',
//                            'fornecedor_email',
//                            'fornecedor_telefone',
//                            'fornecedor_celular',
//                            'fornecedor_endereco',
//                            'fornecedor_numero_endereco',
//                            'fornecedor_complemento',
//                            'fornecedor_bairro',
//                            'fornecedor_cidade',
//                            'fornecedor_estado',
//                            'fornecedor_cep',
//                            'fornecedor_ativo',
//                            'fornecedor_obs',
//                            'fornecedor_tipo',
//                        ), $this->input->post());
//
//                if ($fornecedor_tipo == 1) {
//                    $data['fornecedor_cpf_cnpj'] = $this->input->post('fornecedor_cpf');
//                } else {
//                    $data['fornecedor_cpf_cnpj'] = $this->input->post('fornecedor_cnpj');
//                }
//
//                $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));
//
//                $data = html_escape($data);
//
//                $this->core_model->update('fornecedores', $data, array('fornecedor_id' => $fornecedor_id));
//
//                redirect('fornecedores');
//            } else {
            $data = array(
                'titulo' => 'Atualizar fornecedor',
                'scripts' => array(
                    'vendor/mask/jquery.mask.min.js',
                    'vendor/mask/app.js',
                ),
                'fornecedor' => $this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id)),
            );

//            echo '<pre>';
//            print_r($data['fornecedor']);
//            exit();

            /*
             [fornecedor_razao] => Lucio componentes LTDA
              [fornecedor_id] => 1
              [fornecedor_data_cadastro] => 2020-10-31 19:28:54
             
              [fornecedor_nome_fantasia] => lucio inc
              [fornecedor_cnpj] => 65.970.000/0001-60
              [fornecedor_ie] =>
              [fornecedor_telefone] =>
              [fornecedor_celular] =>
              [fornecedor_email] => lucio@contato.com.br
              [fornecedor_contato] => Fulano de tal
              [fornecedor_cep] =>
              [fornecedor_endereco] =>
              [fornecedor_numero_endereco] =>
              [fornecedor_bairro] =>
              [fornecedor_complemento] =>
              [fornecedor_cidade] =>
              [fornecedor_estado] =>
              [fornecedor_ativo] => 1
              [fornecedor_obs] =>
              [fornecedor_data_alteracao] => 2020-10-31 19:28:54
             */

                $this->load->view('layout/header', $data);
                $this->load->view('fornecedores/edit');
                $this->load->view('layout/footer');
//            }
        }
    }

//    public function check_rg_ie($fornecedor_rg_ie) {
//        $fornecedor_id = $this->input->post('fornecedor_id');
//
//        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_rg_ie' => $fornecedor_rg_ie, 'fornecedor_id !=' => $fornecedor_id))) {
//            $this->form_validation->message('check_rg_ie', 'Esse documento já existe');
//            return FALSE;
//        } else {
//            return TRUE;
//        }
//    }
//
//    public function check_email($fornecedor_email) {
//        $fornecedor_id = $this->input->post('fornecedor_id');
//
//        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_email' => $fornecedor_email, 'fornecedor_id !=' => $fornecedor_id))) {
//            $this->form_validation->message('fornecedor_rg_ie', 'Esse E-mail já existe');
//            return FALSE;
//        } else {
//            return TRUE;
//        }
//    }
//
//    public function check_telefone($fornecedor_telefone) {
//        $fornecedor_id = $this->input->post('fornecedor_id');
//
//        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_telefone' => $fornecedor_telefone, 'fornecedor_id !=' => $fornecedor_id))) {
//            $this->form_validation->message('check_telefone', 'Esse telefone já existe');
//            return FALSE;
//        } else {
//            return TRUE;
//        }
//    }
//
//    public function check_celular($fornecedor_celular) {
//        $fornecedor_id = $this->input->post('fornecedor_id');
//
//        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_celular' => $fornecedor_celular, 'fornecedor_id !=' => $fornecedor_id))) {
//            $this->form_validation->message('check_celular', 'Esse celular já existe');
//            return FALSE;
//        } else {
//            return TRUE;
//        }
//    }
//
//    public function valida_cpf($cpf) {
//
//        if ($this->input->post('fornecedor_id')) {
//
//            $fornecedor_id = $this->input->post('fornecedor_id');
//
//            if ($this->core_model->get_by_id('fornecedores', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_cpf_cnpj' => $cpf))) {
//                $this->form_validation->set_message('valida_cpf', 'Este CPF já existe');
//                return FALSE;
//            }
//        }
//
//        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
//        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
//        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
//
//            $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
//            return FALSE;
//        } else {
//            // Calcula os números para verificar se o CPF é verdadeiro
//            for ($t = 9; $t < 11; $t++) {
//                for ($d = 0, $c = 0; $c < $t; $c++) {
//                    //$d += $cpf{$c} * (($t + 1) - $c); // Para PHP com versão < 7.4
//                    $d += $cpf[$c] * (($t + 1) - $c);
////                    Para PHP com versão < 7.4
//                }
//                $d = ((10 * $d) % 11) % 10;
//                if ($cpf[$c] != $d) {
//                    $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
//                    return FALSE;
//                }
//            }
//            return TRUE;
//        }
//    }
//
//    public function valida_cnpj($cnpj) {
//
//        // Verifica se um número foi informado
//        if (empty($cnpj)) {
//            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
//            return false;
//        }
//
//        if ($this->input->post('fornecedor_id')) {
//
//            $fornecedor_id = $this->input->post('fornecedor_id');
//
//            if ($this->core_model->get_by_id('fornecedores', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_cpf_cnpj' => $cnpj))) {
//                $this->form_validation->set_message('valida_cnpj', 'Esse CNPJ já existe');
//                return FALSE;
//            }
//        }
//
//        // Elimina possivel mascara
//        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
//        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);
//
//
//        // Verifica se o numero de digitos informados é igual a 11 
//        if (strlen($cnpj) != 14) {
//            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
//            return false;
//        }
//
//        // Verifica se nenhuma das sequências invalidas abaixo 
//        // foi digitada. Caso afirmativo, retorna falso
//        else if ($cnpj == '00000000000000' ||
//                $cnpj == '11111111111111' ||
//                $cnpj == '22222222222222' ||
//                $cnpj == '33333333333333' ||
//                $cnpj == '44444444444444' ||
//                $cnpj == '55555555555555' ||
//                $cnpj == '66666666666666' ||
//                $cnpj == '77777777777777' ||
//                $cnpj == '88888888888888' ||
//                $cnpj == '99999999999999') {
//            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
//            return false;
//
//            // Calcula os digitos verificadores para verificar se o
//            // CPF é válido
//        } else {
//
//            $j = 5;
//            $k = 6;
//            $soma1 = "";
//            $soma2 = "";
//
//            for ($i = 0; $i < 13; $i++) {
//
//                $j = $j == 1 ? 9 : $j;
//                $k = $k == 1 ? 9 : $k;
//
//                //$soma2 += ($cnpj{$i} * $k);
//                //$soma2 = intval($soma2) + ($cnpj{$i} * $k); //Para PHP com versão < 7.4
//                $soma2 = intval($soma2) + ($cnpj[$i] * $k); //Para PHP com versão > 7.4
//
//                if ($i < 12) {
//                    //$soma1 = intval($soma1) + ($cnpj{$i} * $j); //Para PHP com versão < 7.4
//                    $soma1 = intval($soma1) + ($cnpj[$i] * $j); //Para PHP com versão > 7.4
//                }
//
//                $k--;
//                $j--;
//            }
//
//            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
//            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;
//
//            if (!($cnpj[12] == $digito1) and ( $cnpj[13] == $digito2)) {
//                $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
//                return false;
//            } else {
//                return true;
//            }
//        }
//    }
//
//    public function del($fornecedor_id = NULL) {
//        if (!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id))) {
//            $this->session->set_flashdata('error', 'Cliente não encontrado');
//            redirect('fornecedores');
//        } else {
//            $this->core_model->delete('fornecedores', array('fornecedor_id' => $fornecedor_id));
//            redirect('fornecedores');
//        }
//    }
}