<?php

class AlunoModel extends BaseModel
{

    const CREATE_QUERY = 'INSERT INTO aluno (NM_ALUNO,DT_NASCIMENTO) VALUES (:name,:nascimento)';
    const LIST_ALL_QUERY = 'SELECT ID_ALUNO as id, NM_ALUNO as nome, DT_NASCIMENTO as nascimento FROM ALUNO';
    const SELECT_QUERY = 'SELECT NM_ALUNO as nome, DT_NASCIMENTO as nascimento FROM ALUNO WHERE ID_ALUNO = :id';
    const UPDATE_QUERY = 'UPDATE aluno SET NM_ALUNO=:name,DT_NASCIMENTO=:nascimento WHERE ID_ALUNO=:id';
    const DELETE_QUERY = 'DELETE FROM aluno WHERE ID_ALUNO=:id';


    public function __construct()
    {
        parent::__construct();
    }

    public function create(AlunoObject $alunoObject)
    {
        $params = array(
            'name' => $alunoObject->getName(),
            'nascimento' => $alunoObject->getNascimento(),
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

    public function update($id, AlunoObject $alunoObject)
    {
        $params = array(
            'id'            => $id,
            'name'          => $alunoObject->getName(),
            'nascimento'    => $alunoObject->getNascimento(),
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
