<?php

class Application_Model_Faturamento extends Zend_Db_Table_Abstract {

    protected $_name = 'tbl_faturamento';
    protected $_primary = 'faturamento';

    public function _get($id) {

        $id = (int) $id;
        $row = $this->fetchRow("faturamento = {$id}");
        if ($row) {
            return $row->toArray();
        }

        return false;
    }

    public function _save(Array $data) {

        if (empty($data["faturamento"])) {
            $this->insert($data);
        } else {
            $this->update($data, "faturamento = {$data['faturamento']}");
        }
    }

    public function _delete($id) {
        $this->delete("faturamento = {$id}");
    }

}


