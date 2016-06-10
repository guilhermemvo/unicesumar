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

<div class="row"><p>Nova Disciplina</p></div>
<div class="row">
    <form action="index.php?class=Disciplina&function=create" method="POST" role="form">
        <div class="form-group"><input autofocus class="form-control" id="nome" maxlength="100" name="nome" placeholder="Nome da disciplina" required type="text" value="<?=$nome?>"></div>
        <div class="form-group"><input class="form-control" id="horas" name="horas" placeholder="Horas Aula" required type="number" value="<?=$horas?>"></div>
        <div class="form-group text-right">
            <input type="submit" class="btn btn-warning" value="Voltar" onclick="javascript:history.back()">
            <input type="submit" class="btn btn-success">
        </div>
    </form>
</div>
