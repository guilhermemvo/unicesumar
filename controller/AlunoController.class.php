    <?php

class AlunoController {

    const CREATE_ALUNOS_SUCCESS = 'Aluno inserido com sucesso.';
    const CREATE_ALUNOS_FAIL = 'O aluno não pode ser cadastrado. Tente novamente mais tarde.';
    const DELETE_ALUNO_SUCCESS = 'Aluno deletado com sucesso.';
    const DELETE_ALUNO_FAIL = 'O aluno não pode ser deletado. Tente novamente mais tarde.';
    const EDIT_ALUNO_SUCCESS = 'Aluno alterado com sucesso.';
    const EDIT_ALUNO_FAIL = 'O aluno não pode ser alterado. Tente novamente mais tarde.';
    const INVALID_DATA = 'Dados inválidos, preencha corretamento o formulário.';
    const EMPTY_DATA = 'Preencha todos os campos do formulário.';
    const EMPTY_LIST = 'Não há nenhum aluno, insira um novo.';
    const NO_POSSIBLE = 'Não foi possível realizar essa operação, tente novamente mais tarde.';

    public function create()
    {
        if (empty($_POST)) {
            View::output('newAluno');
            exit();
        }

        $request = $_POST;
        $this->isValidRequest($request);

        try {
            $alunoObject = new AlunoObject($request);
            $alunoModel = new AlunoModel();

            if ($alunoModel->create($alunoObject)) {
                View::setAlert('success', self::CREATE_ALUNOS_SUCCESS);
                $this->read();
            } else {
                View::setParams(array('danger' => self::CREATE_ALUNOS_FAIL));
            }
        } catch (Exception $exc) {
            // log $exc->getMessage();
            View::setAlert('danger', self::CREATE_ALUNOS_FAIL);
            View::output('newAluno');
        }
    }

    public function edit($id)
    {
        $alunoModel = new AlunoModel();

        try {

            $aluno = $alunoModel->edit($id);
            View::setParams(array('data' => $aluno));
            View::output('editAluno');

        } catch (Exception $exc) {
            //log $exc->getMessage()
            View::setAlert('danger', self::NO_POSSIBLE);
            View::output('listAlunos');
        }
    }

    public function read()
    {
        $alunoModel = new AlunoModel();

        try {

            $objectList = $alunoModel->select();

            if (empty($objectList)) {
                View::setAlert('info', self::EMPTY_LIST);
                View::output('newAluno');
                exit();
            }

            View::setParams(array('data' => $objectList));
            View::output('listAlunos');

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
            $alunoObject = new AlunoObject($_POST);
            $alunoModel = new AlunoModel();

            if ($alunoModel->update($id, $alunoObject)) {
                View::setAlert('success', self::EDIT_ALUNO_SUCCESS);
                $this->read();
            } else {
                View::setAlert('danger', self::EDIT_ALUNO_FAIL);
            }
        } catch (Exception $exc) {
            // log $exc->getMessage()
            View::setAlert('danger', self::NO_POSSIBLE);
            $this->edit($id);
        }
    }

    public function delete($id)
    {
        $alunoModel = new AlunoModel();

        try {
            $alunoModel->delete($id);
            View::setAlert('success', self::DELETE_ALUNO_SUCCESS);
            $this->read();
        } catch (Exception $exc) {
            View::setAlert('danger', self::DELETE_ALUNO_FAIL);
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
            View::output('newAluno');
            exit();
        }
    }
}