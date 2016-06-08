<?php

class CursoModel extends BaseModel
{

    const CREATE_QUERY = 'INSERT INTO curso (NM_CURSO,CD_MATRICULA) VALUES (:name,:matricula)';
    const LIST_ALL_QUERY = 'SELECT ID_CURSO as id, NM_CURSO as nome, CD_MATRICULA as matricula FROM CURSO ORDER BY NM_CURSO ASC';
    const SELECT_QUERY = 'SELECT NM_CURSO as nome, CD_MATRICULA as matricula FROM CURSO WHERE ID_CURSO = :id';
    const UPDATE_QUERY = 'UPDATE curso SET NM_CURSO=:name,CD_MATRICULA=:matricula WHERE ID_CURSO=:id';
    const DELETE_QUERY = 'DELETE FROM curso WHERE ID_CURSO=:id';


    public function __construct()
    {
        parent::__construct();
    }

    public function create(CursoObject $cursoObject)
    {
        $params = array(
            'name' => $cursoObject->getName(),
            'matricula' => $cursoObject->getMatricula(),
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

    public function update($id, CursoObject $cursoObject)
    {
        $params = array(
            'id'            => $id,
            'name'          => $cursoObject->getName(),
            'matricula'    => $cursoObject->getMatricula(),
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
