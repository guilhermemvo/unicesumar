<?php

    $nome = null;
    $tipo = null;

    if (isset($data)) {
        foreach ($data as $key => $object) {
            $nome = $object->nome;
            $tipo = $object->tipo;
        }
    }

?>

<div class="row"><p>Novo Curso</p></div>
<div class="row">
    <form required role="form" action="index.php?class=Curso&function=create" method="POST">
        <div class="form-group"><input autofocus class="form-control" id="nome" maxlenght="100" name="nome" placeholder="Nome do curso" required type="text" value="<?=$nome?>"></div>
        <div class="form-group">
            <select class="form-control" id="tipo" name="tipo" required>
                <option></option>
                <option>Técnico</option>
                <option>Bacharelado</option>
                <option>Especialização</option>
                <option>Mestrado</option>
                <option>Doutorado</option>
            </select>
        </div>
        <div class="form-group text-right">
            <input type="submit" class="btn btn-warning" value="Voltar" onclick="javascript:history.back()">
            <input type="submit" class="btn btn-success" value="Enviar">
        </div>
    </form>
</div>
