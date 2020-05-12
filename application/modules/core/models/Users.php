<?php

class Core_Model_Users
    extends
    Zend_Db_Table_Abstract

{
    /**
     * @var Zend_Db_Table_Select
     */
    protected $select = null;
    protected $params = array();
    protected $_name = 'users';


    /**
     * @return Zend_Db_Table_Select
     */
    public function getSelect(){
        if (is_null($this->select)){
            $this->select = $this->select();
        }
        return $this->select;
    }

    public function myfetchAll()
    {
        $select = $this->getSelect();
        $select->bind($this->params);
        $rows = $this->fetchAll($select);
        $rows = $rows->toArray();
        return $rows;
    }
//    public function getAllUsers($select) {
//        return $this->fetchAll()->toArray();
//    }

    public function whereUserId($id){
        $select = $this->getSelect()->where('id = :id_param');
        $this->params['id_param'] = $id;
        return $this;
    }

    public function whereFullnameLike($fullname){
        $fullname =  '%' . $fullname . '%';
        $this->getSelect()->where('fullname like :fullnameLikeParam');
        $this->params['fullnameLikeParam'] = $fullname;
        return $this;
    }

    public function addUser(array $data) {
        $this->insert($data);
        return $this->getDefaultAdapter()->lastInsertId();
    }

    public function updateUserById(array $data, $id){
        $where = $this->getDefaultAdapter()->quoteInto('id = ?', $id);
        $this->update($data, $where);
    }

    public function deleteUserWithMaxId() {
        $query = $this->select()->from($this->_name, 'MAX(id) AS last');

        // fetchRow - извлечение одной строки.
        $id = $this->fetchRow($query)->last;
        $this->delete('id = ' . $id);
    }


}

