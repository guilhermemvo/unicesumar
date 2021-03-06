<?php

class DocenteModel extends BaseModel
{

    const CREATE_QUERY = 'INSERT INTO docente (NM_DOCENTE,TP_TITULACAO) VALUES (:name,:titulacao)';
    const LIST_ALL_QUERY = 'SELECT ID_DOCENTE as id, NM_DOCENTE as nome, TP_TITULACAO as titulacao FROM DOCENTE ORDER BY NM_DOCENTE ASC';
    const SELECT_QUERY = 'SELECT NM_DOCENTE as nome, TP_TITULACAO as titulacao FROM DOCENTE WHERE ID_DOCENTE = :id';
    const UPDATE_QUERY = 'UPDATE docente SET NM_DOCENTE=:name,TP_TITULACAO=:titulacao WHERE ID_DOCENTE=:id';
    const DELETE_QUERY = 'DELETE FROM docente WHERE ID_DOCENTE=:id';


    public function __construct()
    {
        parent::__construct();
    }

    public function create(DocenteObject $docenteObject)
    {
        $params = array(
            'name' => $docenteObject->getName(),
            'titulacao' => $docenteObject->getTitulacao(),
        );

        try {
            return $this->call(self::CREATE_QUERY, $params, null);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    public function select()
    {
        try {
            return $this->call(self::LIST_ALL_QUERY, null, true);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    public function edit($id)
    {
        $params = array('id' => $id,);

        try {
            return $this->call(self::SELECT_QUERY, $params, true);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }

    public function update($id, DocenteObject $docenteObject)
    {
        $params = array(
            'id'            => $id,
            'name'          => $docenteObject->getName(),
            'titulacao'    => $docenteObject->getTitulacao(),
        );

        try {
            return $this->call(self::UPDATE_QUERY, $params, false);
        } catch (Exception $exc) {
            echo '<pre>Exception!</pre>';
            throw new Exception($exc->getMessage());
        }
    }

    public function delete($id)
    {
        $params = array(
            'id' => $id,
        );

        try {
            return $this->call(self::DELETE_QUERY, $params, false);
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }
}

?>
