<?php

    $nome = null;
    $horas = null;

    if (isset($data)) {
        foreach ($data as $key => $object) {
            $nome = $object->nome;
            $horas = $object->horas;
        }
    }

?>

<div class="row">
    <p>Editar Disciplina</p>
</div>

<div class="row">

    <form role="form" action="index.php?class=Disciplina&function=update&id=<?=$_GET['id']?>" method="POST">

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?=$nome?>" placeholder="Nome do disciplina" required autofocus>
        </div>

        <div class="form-group">
            <label for="horas">Horas</label>
            <input type="text" class="form-control" id="horas" name="horas" value="<?=$horas?>" placeholder="Horas" required autofocus>
        </div>

        <div class="row">
            <div class="col-md-6 text-left"><a href="index.php?class=Disciplina&function=read">
                <button type="button" class="btn btn-warning">Voltar</button></a>
            </div>
            <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
        </div>
    </form>
</div>
