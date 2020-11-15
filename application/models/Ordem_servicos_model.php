<?php

defined('BASEPATH') or exit('Ação não permitida!');

class Ordem_servicos_model extends CI_Model {

     public function get_all() {
         $this->db->select([
            'ordens_servicos.*',
            'clientes.cliente_id',
            'clientes.cliente_nome',
            'formas_pagamentos.forma_pagamento_id',
            'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
        ]);
        $this->db->join('clientes', 'cliente_id = ordem_servico_cliente_id', 'LEFT' );
        $this->db->join('formas_pagamentos', 'forma_pagamento_id = ordem_servico_forma_pagamento_id', 'LEFT' );
        
        return $this->db->get('ordens_servicos')->result();
     }
}