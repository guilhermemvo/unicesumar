<?php

class DocenteObject {

    private $id, $name, $titulacao;

    public function __construct($request)
    {
        if (!$this->validateData($request)) {
            throw new Exception("Dados inválidos. Preencha o formulário corretamente.", 1);
        }

        $this->setName($request['nome']);
        $this->setTitulacao($request['titulacao']);
    }

    public function getId() {
        return $this->id;
    }

    private function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    private function setName($name) {
        $this->name = $name;
    }

    public function getTitulacao() {
        return $this->titulacao;
    }

    private function setTitulacao($titulacao) {
        $this->titulacao = $titulacao;
    }

    private function validateData($data) {
        if ($data) {
            return 1;
        } else {
            return 0;
        }
    }
}
