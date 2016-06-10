<?php

class DisciplinaObject {

    private $id, $name, $horas;

    public function __construct($request)
    {
        if (!$this->validateData($request)) {
            throw new Exception("Dados inválidos. Preencha o formulário corretamente.", 1);
        }

        $this->setName($request['nome']);
        $this->setHoras($request['horas']);
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

    public function getHoras() {
        return $this->horas;
    }

    private function setHoras($horas) {
        $this->horas = $horas;
    }

    private function validateData($data) {
        if ($data) {
            return 1;
        } else {
            return 0;
        }
    }
}
