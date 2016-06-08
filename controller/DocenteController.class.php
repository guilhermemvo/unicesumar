<?php

class DocenteController {

    const CREATE_DOCENTES_SUCCESS = 'Docente inserido com sucesso.';
    const CREATE_DOCENTES_FAIL = 'O docente não pode ser cadastrado. Tente novamente mais tarde.';
    const DELETE_DOCENTE_SUCCESS = 'Docente deletado com sucesso.';
    const DELETE_DOCENTE_FAIL = 'O docente não pode ser deletado. Tente novamente mais tarde.';
    const EDIT_DOCENTE_SUCCESS = 'Docente alterado com sucesso.';
    const EDIT_DOCENTE_FAIL = 'O docente não pode ser alterado. Tente novamente mais tarde.';
    const INVALID_DATA = 'Dados inválidos, preencha corretamento o formulário.';
    const EMPTY_DATA = 'Preencha todos os campos do formulário.';
    const EMPTY_LIST = 'Não há nenhum docente, insira um novo.';
    const NO_POSSIBLE = 'Não foi possível realizar essa operação, tente novamente mais tarde.';
    const VIEW = 'docente/';

    public function create()
    {
        if (empty($_POST)) {
            View::output(self::VIEW . 'new');
            exit();
        }

        $request = $_POST;
        $this->isValidRequest($request);

        try {
            $docenteObject = new DocenteObject($request);
            $docenteModel = new DocenteModel();

            if ($docenteModel->create($docenteObject)) {
                View::setAlert('success', self::CREATE_DOCENTES_SUCCESS);
                $this->read();
            } else {
                View::setParams(array('danger' => self::CREATE_DOCENTES_FAIL));
            }
        } catch (Exception $exc) {
            // log $exc->getMessage();
            View::setAlert('danger', self::CREATE_DOCENTES_FAIL);
            View::output(self::VIEW . 'new');
        }
    }

    public function edit($id)
    {
        $docenteModel = new DocenteModel();

        try {

            $docente = $docenteModel->edit($id);
            View::setParams(array('data' => $docente));
            View::output(self::VIEW . 'edit');

        } catch (Exception $exc) {
            //log $exc->getMessage()
            View::setAlert('danger', self::NO_POSSIBLE);
            View::output(self::VIEW . 'list');
        }
    }

    public function read()
    {
        $docenteModel = new DocenteModel();

        try {

            $objectList = $docenteModel->select();

            if (empty($objectList)) {
                View::setAlert('info', self::EMPTY_LIST);
                View::output(self::VIEW . 'new');
                exit();
            }

            View::setParams(array('data' => $objectList));
            View::output(self::VIEW . 'list');

        } catch (Exception $exc) {
            // logar erro $exc->getMessage()));
            View::setAlert('danger', self::NO_POSSIBLE);
            View::output('index');
            exit();
        }
    }

    public function update($id)
    {

        $request = $_POST;
        $this->isValidRequest($request);

        try {
            $docenteObject = new DocenteObject($_POST);
            $docenteModel = new DocenteModel();

            if ($docenteModel->update($id, $docenteObject)) {
                View::setAlert('success', self::EDIT_DOCENTE_SUCCESS);
                $this->read();
            } else {
                View::setAlert('danger', self::EDIT_DOCENTE_FAIL);
            }
        } catch (Exception $exc) {
            // log $exc->getMessage()
            View::setAlert('danger', self::NO_POSSIBLE);
            $this->edit($id);
        }
    }

    public function delete($id)
    {
        $docenteModel = new DocenteModel();

        try {
            $docenteModel->delete($id);
            View::setAlert('success', self::DELETE_DOCENTE_SUCCESS);
            $this->read();
        } catch (Exception $exc) {
            View::setAlert('danger', self::DELETE_DOCENTE_FAIL);
            $this->read();
        }
    }

    private function isValidRequest(&$request)
    {
        $nome = filter_input(INPUT_POST, 'nome',FILTER_SANITIZE_STRING);
        $matricula = filter_input(INPUT_POST, 'matricula',FILTER_SANITIZE_SPECIAL_CHARS);

        if (!empty($nome) && !empty($matricula)) {
            $request = array(
                'nome' => $nome,
                'matricula' => $matricula,
            );
        } else {
            View::setParams(array('data' => array((object)$request)));
            View::setAlert('danger', self::EMPTY_DATA);
            View::output(self::VIEW . 'new');
            exit();
        }
    }
}
