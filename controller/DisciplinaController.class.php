<?php

class DisciplinaController {

    const CREATE_DISCIPLINAS_SUCCESS = 'Disciplina inserido com sucesso.';
    const CREATE_DISCIPLINAS_FAIL = 'O disciplina não pode ser cadastrado. Tente novamente mais tarde.';
    const DELETE_DISCIPLINA_SUCCESS = 'Disciplina deletado com sucesso.';
    const DELETE_DISCIPLINA_FAIL = 'O disciplina não pode ser deletado. Tente novamente mais tarde.';
    const EDIT_DISCIPLINA_SUCCESS = 'Disciplina alterado com sucesso.';
    const EDIT_DISCIPLINA_FAIL = 'O disciplina não pode ser alterado. Tente novamente mais tarde.';
    const INVALID_DATA = 'Dados inválidos, preencha corretamento o formulário.';
    const EMPTY_DATA = 'Preencha todos os campos do formulário.';
    const EMPTY_LIST = 'Não há nenhuma disciplina cadastrada, insira uma nova.';
    const NO_POSSIBLE = 'Não foi possível realizar essa operação, tente novamente mais tarde.';
    const VIEW = 'disciplina/';


    public function create()
    {
        if (empty($_POST)) {
            View::output(self::VIEW . 'new');
            exit();
        }

        $request = $_POST;
        $this->isValidRequest($request);

        try {
            $disciplinaObject = new DisciplinaObject($request);
            $disciplinaModel = new DisciplinaModel();

            if ($disciplinaModel->create($disciplinaObject)) {
                View::setAlert('success', self::CREATE_DISCIPLINAS_SUCCESS);
                $this->read();
            } else {
                View::setParams(array('danger' => self::CREATE_DISCIPLINAS_FAIL));
            }
        } catch (Exception $exc) {
            View::setAlert('info', self::CREATE_DISCIPLINAS_FAIL);
            View::setAlert('danger', $exc->getMessage());
            View::output(self::VIEW . 'new');
        }
    }

    public function edit($id)
    {
        $disciplinaModel = new DisciplinaModel();

        try {

            $disciplina = $disciplinaModel->edit($id);
            View::setParams(array('data' => $disciplina));
            View::output(self::VIEW . 'edit');

        } catch (Exception $exc) {
            //log $exc->getMessage()
            View::setAlert('info', self::NO_POSSIBLE);
            View::output(self::VIEW . 'list');
        }
    }

    public function read()
    {
        $disciplinaModel = new DisciplinaModel();

        try {

            $objectList = $disciplinaModel->select();

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
            $disciplinaObject = new DisciplinaObject($request);
            $disciplinaModel = new DisciplinaModel();

            if ($disciplinaModel->update($id, $disciplinaObject)) {
                View::setAlert('success', self::EDIT_DISCIPLINA_SUCCESS);
                $this->read();
            } else {
                View::setAlert('danger', self::EDIT_DISCIPLINA_FAIL);
            }
        } catch (Exception $exc) {
            View::setAlert('info', self::NO_POSSIBLE);
            View::setAlert('danger', $exc->getMessage());
            $this->edit($id);
        }
    }

    public function delete($id)
    {
        $disciplinaModel = new DisciplinaModel();

        try {
            $disciplinaModel->delete($id);
            View::setAlert('success', self::DELETE_DISCIPLINA_SUCCESS);
            $this->read();
        } catch (Exception $exc) {
            View::setAlert('danger', self::DELETE_DISCIPLINA_FAIL);
            $this->read();
        }
    }

    private function isValidRequest(&$request)
    {
        $nome = filter_input(INPUT_POST, 'nome',FILTER_SANITIZE_STRING);
        $horas = filter_input(INPUT_POST, 'horas',FILTER_SANITIZE_SPECIAL_CHARS);

        if (!empty($nome) && !empty($horas)) {

            $nome = htmlentities($nome);

            $request = array(
                'nome' => $nome,
                'horas' => $horas,
            );
        } else {
            View::setParams(array('data' => array((object)$request)));
            View::setAlert('danger', self::EMPTY_DATA);
            View::output(self::VIEW . 'new');
            exit();
        }
    }


}
