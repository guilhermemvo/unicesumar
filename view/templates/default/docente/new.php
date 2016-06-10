<?php

    $nome = null;
    $matricula = null;

    if (isset($data)) {
        foreach ($data as $key => $object) {
            $nome = $object->nome;
            $matricula = $object->matricula;
        }
    }

?>

<div class="row">
    <p>Novo Docente</p>
</div>

<div class="row">

    <form role="form" action="index.php?class=Docente&function=create" method="POST" autocomplete="on">

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?=$nome?>" placeholder="Nome do docente" required autofocus>
        </div>

        <div class="form-group">
            <label for="titulacao">Titulação</label>
            <select id="titulacao" name="titulacao" class="form-control">
                <option></option>
                <option>Consultor</option>
                <option>Tecnico</option>
                <option>Bacharel</option>
                <option>Mestre</option>
                <option>Doutor</option>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 text-left"><a href="index.php?class=Docente&function=read">
                <button type="button" class="btn btn-warning">Voltar</button></a>
            </div>
            <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
        </div>
    </form>
</div>
