<?php

class TurmaObject {

    private $id, $name, $ano, $semestres, $curso;

    public function __construct($request)
    {
        if (!$this->validateData($request)) {
            throw new Exception("Dados inválidos. Preencha o formulário corretamente.", 1);
        }

        $this->setName($request['nomeTurma']);
        $this->setAno($request['anoTurma']);
        $this->setSemestres($request['semestresTurma']);
        $this->setCurso($request['cursoID']);
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

    public function getAno() {
        return $this->ano;
    }

    private function setAno($ano) {
        $this->ano = $ano;
    }

    public function getSemestres() {
        return $this->semestres;
    }

    private function setSemestres($semestres) {
        $this->semestres = $semestres;
    }

    public function getCurso() {
        return $this->curso;
    }

    private function setCurso($curso) {
        $this->curso = $curso;
    }

    private function validateData($data) {
        if ($data) {
            return 1;
        } else {
            return 0;
        }
    }
}
