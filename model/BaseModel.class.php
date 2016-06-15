<?php

class BaseModel extends ConnectionDB
{

    public function __construct()
    {
        parent::__construct();
    }

    public function call($sql, $params = null, $select = null)
    {
        try {
            return $this->query($sql, $params, $select);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }
}
