<?php

class Application_Model_CondicaoPagamento extends Zend_Db_Table_Abstract {

    protected $_name = 'tbl_condicao_pagamento';
    protected $_primary = 'condicao_pagamento';

    public function _get($id) {

        $id = (int) $id;
        $row = $this->fetchRow("condicao_pagamento = {$id}");
        if ($row) {
            return $row->toArray();
        }

        return false;
    }

    public function _save(Array $data) {

        if (empty($data["condicao_pagamento"])) {
            $this->insert($data);
        } else {
            $this->update($data, "condicao_pagamento = {$data['condicao_pagamento']}");
        }
    }

    public function _delete($id) {
        $this->delete("condicao_pagamento = {$id}");
    }

}

