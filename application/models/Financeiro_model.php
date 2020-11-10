<?php

defined('BASEPATH') or exit('Ação não permitida!');

class Financeiro_model extends CI_Model {
     
    public function get_all_pagar() {
        $this->db->select([
            'contas_pagar.*',
            'fornecedores.fornecedor_id',
            'fornecedores.fornecedor_nome_fantasia as fornecedor',
        ]);
        $this->db->join('fornecedores', 'fornecedor_id = conta_pagar_fornecedor_id', 'LEFT' );
        
        return $this->db->get('contas_pagar')->result();
    }
    
     public function get_all_receber() {
        $this->db->select([
            'contas_receber.*',
            'cliente_id',
            'cliente_nome',
        ]);
        $this->db->join('clientes', 'cliente_id = conta_receber_cliente_id', 'LEFT' );
        
        return $this->db->get('contas_receber')->result();
    }
}

