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

<div class="row"><p>Novo Docente</p></div>
<div class="row">

    <form action="index.php?class=Docente&function=create" method="POST" role="form">

        <div class="form-group"><input autofocus class="form-control" id="nome" maxlenght="100" name="nome" placeholder="Nome do docente" required type="text" value="<?=$nome?>"></div>

        <div class="form-group">
            <select class="form-control" id="titulacao" name="titulacao" required>
                <option></option>
                <option>Consultor</option>
                <option>Tecnico</option>
                <option>Bacharel</option>
                <option>Mestre</option>
                <option>Doutor</option>
            </select>
        </div>

        <div class="form-group text-right">
            <input type="submit" class="btn btn-warning" value="Voltar" onclick="javascript:history.back()">
            <input type="submit" class="btn btn-success" value="Enviar">
        </div>

    </form>
</div>


    