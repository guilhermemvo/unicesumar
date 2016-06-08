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

<div class="row">
    <p>Editar Aluno</p>
</div>

<div class="row">

    <form role="form" action="index.php?class=Aluno&function=update&id=<?=$_GET['id']?>" method="POST" autocomplete="on">

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?=$nome?>" placeholder="Nome do aluno" required autofocus>
        </div>

        <div class="form-group">
            <label for="nascimento">Data de Nascimento</label>
            <input type="text" class="form-control" id="nascimento" name="nascimento" value="<?=$nascimento?>" placeholder="01/01/1990">
        </div>

        <div class="row">
            <div class="col-md-6 text-left"><a href="index.php?class=Aluno&function=read">
                <button type="button" class="btn btn-warning">Voltar</button></a>
            </div>
            <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(function() {
        $('input[name="nascimento"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                "format": "DD/MM/YYYY",
                "daysOfWeek": ["Dom","Seg","Ter","Qua","Qui","Sex","Sab"],
                "monthNames": [
                    "Janeiro","Fevereiro","Maço","Abril","Maio","Junho",
                    "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"
                ],
            },
            "startDate": "20/10/1990",
        });
    });
</script>
