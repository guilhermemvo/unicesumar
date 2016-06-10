<?php

    $nome = null;
    $nascimento = null;

    if (isset($data)) {
        foreach ($data as $key => $object) {
            $nome = $object->nome;
            $nascimento = $object->nascimento;
        }
    }

?>

<div class="row"><p>Novo Aluno</p></div>
<div class="row">
    <form role="form" action="index.php?class=Aluno&function=create" method="POST">
        <div class="form-group"><input autofocus class="form-control" id="nome" maxlength="100" name="nome" placeholder="Nome do aluno"  required type="text" value="<?=$nome?>"></div>
        <div class="form-group"><input class="form-control" id="nascimento" name="nascimento" placeholder="01/01/1990" required type="date" value="<?=$nascimento?>"></div>
        <div class="form-group text-right">
            <input type="submit" class="btn btn-warning" value="Voltar" onclick="javascript:history.back()">
            <input type="submit" class="btn btn-success" value="Enviar">
        </div>
    </form>
</div>
