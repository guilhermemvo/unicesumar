<?php

class TurmaController {

    const CREATE_TURMA_SUCCESS = 'Turma inserida com sucesso.';
    const CREATE_TURMA_FAIL = 'A turma não pode ser cadastrada. Tente novamente mais tarde.';
    const DELETE_TURMA_SUCCESS = 'Turma deletada com sucesso.';
    const DELETE_TURMA_FAIL = 'A turma não pode ser deletada. Tente novamente mais tarde.';
    const EDIT_TURMA_SUCCESS = 'Turma alterada com sucesso.';
    const EDIT_TURMA_FAIL = 'A turma não pode ser alterada. Tente novamente mais tarde.';
    const INVALID_DATA = 'Dados inválidos, preencha corretamento o formulário.';
    const EMPTY_DATA = 'Preencha todos os campos do formulário.';
    const EMPTY_LIST = 'Não há nenhuma turma cadastrada, insira uma nova.';
    const NO_POSSIBLE = 'Não foi possível realizar essa operação, tente novamente mais tarde.';
    const REGISTRATION_TURMA_SUCCESS = 'Turma matriculada com sucesso.';
    const VIEW = 'turma/';

    public function create() // insert
    {
        $request = $_POST;

        try {
            $turmaObject = new TurmaObject($request);
            $turmaModel = new TurmaModel();

            if ($turmaModel->create($turmaObject)) {
                View::setAlert('success', self::CREATE_TURMA_SUCCESS);
                $CursoController = new CursoController();
                $CursoController->info($request['cursoID']);
            } else {
                View::setParams(array('danger' => self::CREATE_TURMA_FAIL));
            }
        } catch (Exception $exc) {
            View::setAlert('info', self::CREATE_TURMA_FAIL);
            View::setAlert('danger', $exc->getMessage());
            View::output(self::VIEW . 'new');
        }
    }

    public function edit($id) // select one
    {
        $turmaModel = new TurmaModel();

        try {

            $turma = $turmaModel->edit($id);
            View::setParams(array('data' => $turma));
            View::output(self::VIEW . 'edit');

        } catch (Exception $exc) {
            View::setAlert('info', self::NO_POSSIBLE);
            View::setAlert('danger', $exc->getMessage());
            View::output(self::VIEW . 'list');
        }
    }

    public function read() // select all
    {
        $turmaModel = new TurmaModel();

        try {

            $objectList = $turmaModel->select();

            if (empty($objectList)) {
                View::setAlert('info', self::EMPTY_LIST);
                View::output(self::VIEW . 'new');
                exit();
            }

            View::setParams(array('data' => $objectList));
            View::output(self::VIEW . 'list');

        } catch (Exception $exc) {
            View::setAlert('info', self::NO_POSSIBLE);
            // View::setAlert('danger', $exc->getMessage());
            View::output('index');
            exit();
        }
    }

    public function update($id)  // update
    {

        $request = $_POST;
        $this->isValidRequest($request);

        try {
            $turmaObject = new TurmaObject($_POST);
            $turmaModel = new TurmaModel();

            if ($turmaModel->update($id, $turmaObject)) {
                View::setAlert('success', self::EDIT_TURMA_SUCCESS);
                $this->read();
            } else {
                View::setAlert('danger', self::EDIT_TURMA_FAIL);
            }
        } catch (Exception $exc) {
            // log $exc->getMessage()
            View::setAlert('info', self::NO_POSSIBLE);
            $this->edit($id);
        }
    }

    public function info($turmaID)
    {
        $turmaModel = new TurmaModel();
        $cursoModel = new cursoModel();

        try {

            $turma = $turmaModel->edit($turmaID);
            $info = $turmaModel->getMatriculas($turmaID);
            $cursos = $cursoModel->select();

            View::setParams(
                array(
                    'data' => $turma,
                    'infos' => $info,
                    'cursos' => $cursos
                )
            );
            View::output(self::VIEW . 'info');
        } catch (Exception $exc) {
            View::setAlert('info', self::NO_POSSIBLE);
            View::setAlert('danger', $exc->getMessage());
            View::output(self::VIEW . 'list');
        }
    }

    public function delete($id) // delete
    {
        $turmaModel = new TurmaModel();

        try {
            $turmaModel->delete($id);
            View::setAlert('success', self::DELETE_TURMA_SUCCESS);
            $CursoController = new CursoController();
            $CursoController->read();
        } catch (Exception $exc) {
            View::setAlert('info', self::DELETE_TURMA_FAIL);
            View::setAlert('danger', $exc->getMessage());
            $this->read();
        }
    }

    private function isValidRequest(&$request)
    {
        $nome = filter_input(INPUT_POST, 'nome',FILTER_SANITIZE_STRING);
        $nascimento = filter_input(INPUT_POST, 'nascimento',FILTER_SANITIZE_SPECIAL_CHARS);

        if (!empty($nome) && !empty($nascimento)) {
            $request = array(
                'nome' => $nome,
                'nascimento' => $nascimento,
            );
        } else {
            View::setParams(array('data' => array((object)$request)));
            View::setAlert('danger', self::EMPTY_DATA);
            View::output(self::VIEW . 'new');
            exit();
        }
    }

    public function matricula()
    {
        $request = $_POST;
        $turmaID = $request['turmaID'];
        $cursoID = $request['cursoID'];

        try {
            $turmaModel = new TurmaModel();
            if ($turmaModel->matricula($turmaID, $cursoID)) {
                View::setAlert('success', self::REGISTRATION_TURMA_SUCCESS);
                $this->info($turmaID);
            } else {
                echo '<pre>' . 'teste' . '<br></pre>'; exit('Fim');
                View::setParams(array('danger' => self::CREATE_TURMA_FAIL));
            }
        } catch (Exception $exc) {
            View::setAlert('info', self::CREATE_TURMA_FAIL);
            View::setAlert('danger', $exc->getMessage());
            View::output(self::VIEW . 'new');
        }
    }
}
