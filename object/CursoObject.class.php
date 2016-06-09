<?php

class CursoObject {

    private $id, $name, $tipo;

    public function __construct($request)
    {
        if (!$this->validateData($request)) {
            throw new Exception("Dados inválidos. Preencha o formulário corretamente.", 1);
        }

        $this->setName($request['nome']);
        $this->setTipo($request['tipo']);
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

    public function getTipo() {
        return $this->tipo;
    }

    private function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    private function validateData($data) {
        if ($data) {
            return 1;
        } else {
            return 0;
        }
    }
}
