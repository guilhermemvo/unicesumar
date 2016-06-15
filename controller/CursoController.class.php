<?php

class CursoController {

    const CREATE_CURSOS_SUCCESS = 'Curso inserido com sucesso.';
    const CREATE_CURSOS_FAIL = 'O curso não pode ser cadastrado. Tente novamente mais tarde.';
    const DELETE_CURSO_SUCCESS = 'Curso deletado com sucesso.';
    const DELETE_CURSO_FAIL = 'O curso não pode ser deletado. Tente novamente mais tarde.';
    const EDIT_CURSO_SUCCESS = 'Curso alterado com sucesso.';
    const EDIT_CURSO_FAIL = 'O curso não pode ser alterado. Tente novamente mais tarde.';
    const INVALID_DATA = 'Dados inválidos, preencha corretamento o formulário.';
    const EMPTY_DATA = 'Preencha todos os campos do formulário.';
    const EMPTY_LIST = 'Não há nenhum curso cadastrado, insira um novo.';
    const NO_POSSIBLE = 'Não foi possível realizar essa operação, tente novamente mais tarde.';
    const VIEW = 'curso/';

    const CREATE_TURMA_SUCCESS = 'Truma inserida com sucesso.';

    public function create()
    {
        if (empty($_POST)) {
            View::output(self::VIEW . 'new');
            exit();
        }

        $request = $_POST;
        $this->isValidRequest($request);

        try {
            $cursoObject = new CursoObject($request);
            $cursoModel = new CursoModel();

            if ($cursoModel->create($cursoObject)) {
                View::setAlert('success', self::CREATE_CURSOS_SUCCESS);
                $this->read();
            } else {
                View::setParams(array('danger' => self::CREATE_CURSOS_FAIL));
            }
        } catch (Exception $exc) {
            View::setAlert('info', self::CREATE_CURSOS_FAIL);
            View::setAlert('danger', $exc->getMessage());
            View::output(self::VIEW . 'new');
        }
    }

    public function edit($id)
    {
        $cursoModel = new CursoModel();

        try {

            $curso = $cursoModel->edit($id);
            View::setParams(array('data' => $curso));
            View::output(self::VIEW . 'edit');

        } catch (Exception $exc) {
            //log $exc->getMessage()
            View::setAlert('info', self::NO_POSSIBLE);
            View::output(self::VIEW . 'list');
        }
    }

    public function read()
    {
        $cursoModel = new CursoModel();

        try {

            $objectList = $cursoModel->select();

            if (empty($objectList)) {
                View::setAlert('info', self::EMPTY_LIST);
                View::output(self::VIEW . 'new');
                exit();
            }

            View::setParams(array('data' => $objectList));
            View::output(self::VIEW . 'list');

        } catch (Exception $exc) {
            View::setAlert('info', self::NO_POSSIBLE);
            View::setAlert('danger', $exc->getMessage());
            View::output('index');
            exit();
        }
    }

    public function update($id)
    {

        $request = $_POST;
        $this->isValidRequest($request);

        try {
            $cursoObject = new CursoObject($request);
            $cursoModel = new CursoModel();

            if ($cursoModel->update($id, $cursoObject)) {
                View::setAlert('success', self::EDIT_CURSO_SUCCESS);
                $this->read();
            } else {
                View::setAlert('danger', self::EDIT_CURSO_FAIL);
            }
        } catch (Exception $exc) {
            View::setAlert('info', self::NO_POSSIBLE);
            View::setAlert('danger', $exc->getMessage());
            $this->edit($id);
        }
    }

    public function delete($id)
    {
        $cursoModel = new CursoModel();

        try {
            $cursoModel->delete($id);
            View::setAlert('success', self::DELETE_CURSO_SUCCESS);
            $this->read();
        } catch (Exception $exc) {
            View::setAlert('danger', self::DELETE_CURSO_FAIL);
            $this->read();
        }
    }

    private function isValidRequest(&$request)
    {
        $nome = filter_input(INPUT_POST, 'nome',FILTER_SANITIZE_STRING);
        $tipo = filter_input(INPUT_POST, 'tipo',FILTER_SANITIZE_SPECIAL_CHARS);

        if (!empty($nome) && !empty($tipo)) {

            $nome = htmlentities($nome);
            sanitizeCaracters($tipo);
            $tipo = strtolower($tipo);

            $request = array(
                'nome' => $nome,
                'tipo' => $tipo,
            );
        } else {
            View::setParams(array('data' => array((object)$request)));
            View::setAlert('danger', self::EMPTY_DATA);
            View::output(self::VIEW . 'new');
            exit();
        }
    }

    public function info($cursoID)
    {

        $cursoModel = new cursoModel();
        $turmaModel = new turmaModel();

        try {

            $curso = $cursoModel->edit($cursoID);
            $infos = $turmaModel->edit($cursoID);

            View::setParams(
                array(
                    'data' => $curso,
                    'infos' => $infos
                )
            );
            View::output(self::VIEW . 'info');
        } catch (Exception $exc) {
            View::setAlert('info', self::NO_POSSIBLE);
            View::setAlert('danger', $exc->getMessage());
            View::output(self::VIEW . 'list');
        }
    }

    public function createTurma()
    {
        $request = $_POST;

        try {
            $turmaObject = new turmaObject($request);
            $turmaModel = new turmaModel();

            if ($turmaModel->create($turmaObject)) {
                View::setAlert('success', self::CREATE_TURMA_SUCCESS);
                $this->info();
            } else {
                View::setParams(array('danger' => self::CREATE_CURSOS_FAIL));
            }
        } catch (Exception $exc) {
            View::setAlert('info', self::CREATE_CURSOS_FAIL);
            View::setAlert('danger', $exc->getMessage());
            View::output(self::VIEW . 'new');
        }
    }
}
