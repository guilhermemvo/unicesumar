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

<div class="row">
    <p>Novo Curso</p>
</div>

<div class="row">

    <form role="form" action="index.php?class=Curso&function=create" method="POST" autocomplete="on">

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?=$nome?>" placeholder="Nome do curso" required autofocus>
        </div>

        <div class="form-group">

            <label for="tipo">Tipo do curso</label>
            <select id="tipo" name="tipo" class="form-control">
                <option></option>
                <option>Técnico</option>
                <option>Bacharelado</option>
                <option>Especialização</option>
                <option>Mestrado</option>
                <option>Doutorado</option>
            </select>

        </div>

        <div class="row">
            <div class="col-md-6 text-left"><a href="index.php?class=Curso&function=read">
                <button type="button" class="btn btn-warning">Voltar</button></a>
            </div>
            <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
        </div>
    </form>
</div>
