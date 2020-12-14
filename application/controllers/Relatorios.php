<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Relatorios extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function vendas() {

        $data = array(
            'titulo' => 'Relatório de vendas',
        );

        $data_inicial = $this->input->post('data_inicial');

        $data_final = $this->input->post('data_final');

        if ($data_inicial) {
            $this->load->model('vendas_model');

            if ($this->vendas_model->gerar_ralatorio_vendas($data_inicial, $data_final)) {

                //montar o pdf

                $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

                $vendas = $this->vendas_model->gerar_ralatorio_vendas($data_inicial, $data_final);

                $file_name = 'Relatótio de vendas Nº' . $venda->venda_id;

                //Inicio do HTML
                $html = '<html>';

                $html .= '<head>';
                $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatótio de vendas</title>';

                $html .= '</head>';

                $html .= '<body style="font-size:12px">';

                $html .= '<h4 align="center">
                ' . $empresa->sistema_razao_social . '<br/>
                ' . 'CNPJ: ' . $empresa->sistema_cnpj . '<br/>
                ' . $empresa->sistema_endereco . ',&nbsp;' . $empresa->sistema_numero . '<br/>
                ' . 'CEP: ' . $empresa->sistema_cep . ',&nbsp;' . $empresa->sistema_cidade . ',&nbsp;' . $empresa->sistema_estado . '<br/>
                ' . 'Telefone: ' . $empresa->sistema_telefone_fixo . '<br/>
                ' . 'E-mail: ' . $empresa->sistema_email . '<br/>
                </h4>';

                $html .= '<hr>';


                //Dados da venda

                $html .= '<p style="font-size: 12px">Relatório de vendas realizado no período de </p>';

                if ($data_inicial && $data_final) {
                    $html .= '<p align="center" style="font-size: 12px">' . formata_data_banco_com_hora($data_inicial) . ' - ' . formata_data_banco_com_hora($data_final) . '</p>';
                } else {
                    $html .= '<p align="center" style="font-size: 12px">' . formata_data_banco_com_hora($data_inicial) . '</p>';
                }

//                $html .= '<p>'
//                        . '<strong>Cliente: </strong>' . $venda->cliente_nome_completo . '<br/>'
//                        . '<strong>CPF: </strong>' . $venda->cliente_cpf_cnpj . '<br/>'
//                        . '<strong>Celular: </strong>' . $venda->cliente_celular . '<br/>'
//                        . '<strong>Data de emissão: </strong>' . formata_data_banco_com_hora($venda->venda_data_emissao) . '<br/>'
//                        . '<strong>Forma de pagamento: </strong>' . $venda->forma_pagamento . '<br/>'
//                        . '</p>';


                $html .= '<hr>';

                //Dados da ordem

                $html .= '<table width="100%" border: solid #ddd 1px>';

                $html .= '<tr>';

                $html .= '<th>Venda</th>';
                $html .= '<th>Data</th>';
                $html .= '<th>Cliente</th>';
                $html .= '<th>Forma pagamento</th>';
                $html .= '<th>Valor total</th>';

                $html .= '</tr>';

//                $vendas_venda = $this->vendas_model->get_all_produtos($venda_id);

//                $valor_final_venda = $this->vendas_model->get_valor_final_venda($venda_id);

                foreach ($vendas as $venda):

                    $html .= '<tr>';
                    $html .= '<td>' . $venda->venda_id . '</td>';
                    $html .= '<td>' . formata_data_banco_com_hora($vena->venda_data_emissao) . '</td>';
                    $html .= '<td>' . $venda->cliente_nome_completo . '</td>';
                    $html .= '<td>' . $venda->forma_pagamento . '</td>';
                    $html .= '<td>' . 'R$&nbsp;' . $venda->venda_valor_total . '</td>';
                    $html .= '</tr>';

                endforeach;

                $html .= '<th colspan="4">';

                $html .= '<td style="border-top: solid #ddd 1px"><strong>Valor final</strong></td>';
                $html .= '<td style="border-top: solid #ddd 1px">' . 'R$&nbsp;' . $valor_final_venda->venda_valor_total . '</td>';

                $html .= '</th>';

                $html .= '</table>';

                $html .= '</body>';

                $html .= '<html>';
                
                  echo '<pre>';
            print_r($ordem_servico);
                exit();

                $this->pdf->createPDF($html, $file_name, FALSE);
            }
        }
    }

}
