<?php

class DisciplinaModel extends BaseModel
{

    const CREATE_QUERY = 'INSERT INTO disciplina (NM_DISCIPLINA,NR_HORAS) VALUES (:name,:horas)';
    const LIST_ALL_QUERY = 'SELECT ID_DISCIPLINA as id, NM_DISCIPLINA as nome, NR_HORAS as horas FROM DISCIPLINA ORDER BY NM_DISCIPLINA ASC';
    const SELECT_QUERY = 'SELECT NM_DISCIPLINA as nome, NR_HORAS as horas FROM DISCIPLINA WHERE ID_DISCIPLINA = :id';
    const UPDATE_QUERY = 'UPDATE disciplina SET NM_DISCIPLINA=:name,NR_HORAS=:horas WHERE ID_DISCIPLINA=:id';
    const DELETE_QUERY = 'DELETE FROM disciplina WHERE ID_DISCIPLINA=:id';


    public function __construct()
    {
        parent::__construct();
    }

    public function create(DisciplinaObject $disciplinaObject)
    {
        $params = array(
            'name' => $disciplinaObject->getName(),
            'horas' => $disciplinaObject->getHoras(),
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

    public function update($id, DisciplinaObject $disciplinaObject)
    {
        $params = array(
            'id'            => $id,
            'name'          => $disciplinaObject->getName(),
            'horas'          => $disciplinaObject->getHoras(),
        );

        try {
            return $this->call(self::UPDATE_QUERY, $params, false);
        } catch (Exception $exc) {
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
