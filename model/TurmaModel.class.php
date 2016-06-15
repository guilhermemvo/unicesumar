<?php
class TurmaModel extends BaseModel
{

    const CREATE_QUERY = 'INSERT INTO turma (NM_TURMA,NR_ANO,NR_SEMESTRE,CURSO_ID) VALUES (:name,:ano,:semestre,:curso)';
    const LIST_ALL_QUERY = 'SELECT ID_TURMA as id, NM_TURMA as nome, TP_TIPO_TURMA as tipo FROM TURMA ORDER BY NM_TURMA ASC';
    const SELECT_QUERY = 'SELECT ID_TURMA as id, NM_TURMA as nome, NR_ANO as ano, NR_SEMESTRE as semestres FROM TURMA WHERE CURSO_ID = :id';
    const UPDATE_QUERY = 'UPDATE turma SET NM_TURMA=:name,TP_TIPO_TURMA=:tipo WHERE ID_TURMA=:id';
    const DELETE_QUERY = 'DELETE FROM turma_aluno WHERE ID_TURMA=:id';


    public function __construct()
    {
        parent::__construct();
    }

    public function create(TurmaObject $turmaObject)
    {
        $params = array(
            'name' => $turmaObject->getName(),
            'ano' => $turmaObject->getAno(),
            'semestre' => $turmaObject->getSemestres(),
            'curso' => $turmaObject->getSemestres(),
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

    public function update($id, TurmaObject $turmaObject)
    {
        $params = array(
            'id'            => $id,
            'name'          => $turmaObject->getName(),
            'tipo'          => $turmaObject->getTipo(),
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
