<?php

class Application_Model_Abstract {

    protected $_dbTable;

    public function procurar($id) {
        return $this->_dbTable->find($id)->current();
    }

    public function apagar($id) {
        return $this->_dbTable->delete(array('id', $id));
    }

    public function save($id) {
        if (isset($data['id'])) {
            return $this->_dbTable->_update($data);
        } else {
            return $this->_dbTable->_insert($data);
        }
    }

    abstract public function _insert(array $data);

    abstract public function _update(array $data);

    public function fetchAll() {
        return $this->_dbTable->fetchAll();
    }

}