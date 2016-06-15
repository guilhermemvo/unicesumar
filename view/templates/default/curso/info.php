<?php
    foreach ($data as $key => $object) {
        $cursoID = $object->id;
        $cursoNome = $object->nome;
        $cursoTipo = $object->tipo;
    }
?>

<!-- Curso -->
<div class="row"><p><?=$cursoNome?></p></div>
<div class="row">
    <div class="col-md-12">
        <label>Curso: </label><input class="form-control" disabled type="text" value="<?=$cursoNome?>"><br>
        <label>Tipo: </label><input class="form-control" disabled type="text" value="<?=$cursoTipo?>"><br>
    </div>
</div>

<br>
<hr>
<br>

<!-- Turma -->
<div class="row">
    <div class="col-md-6"><p class="text-left">Turmas</p></div>
    <div class="col-md-6"><p class="text-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#turmaModal">Nova Turma</button></p></div>
</div>

<!-- Modal para Nova Turma -->
<div class='modal fade' id='turmaModal' tabindex='-1' role='dialog' aria-labelledby='turmaModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <form action="index.php?class=Turma&function=create" method="POST" role="form">
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <div class="row"><p>Nova Turma</p></div>
                    <div class="row">
                        <div class="form-group"><input autofocus class="form-control" id="nomeTurma" maxlength="100" name="nomeTurma" placeholder="Nome da turma" required type="text"></div>
                        <div class="form-group"><input class="form-control" id="anoTurma" name="anoTurma" placeholder="Ano" required type="number"></div>
                        <div class="form-group"><input class="form-control" id="semestresTurma" name="semestresTurma" placeholder="Semestres" required type="number"></div>
                    </div>
                    <input type="hidden" name="cursoID" value="<?=$cursoID?>">
                </div>
                <div class='modal-footer'>
                    <input type="submit" class="btn btn-default" data-dismiss='modal' value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Enviar">
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Listagem de Turmas -->
<div class="row col-md-12 table-responsive">

    <table class="table table-bordered table-hover">

        <thead>
            <tr>
                <th class="col-md-4">TURMA</th>
                <th class="col-md-3">ANO</th>
                <th class="col-md-3">SEMESTRES</th>
                <th class="col-md-2">OPÇÕES</th>
            </tr>
        </thead>

        <tbody>
            <?php
                if (isset($infos)) {
                    foreach ($infos as $key => $info) {
                        echo "
                        <tr>
                            <td> $info->nome </td>
                            <td> $info->ano </td>
                            <td> $info->semestres </td>
                            <td>
                                <div class='btn-group btn-group-sm' role='group'>
                                    <a class='btn btn-warning' href='index.php?class=Turma&function=edit&id=$cursoID' role='button'><span class='glyphicon glyphicon-pencil'></span></a>
                                    <a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' role='button'><span class='glyphicon glyphicon-trash'></span></a>
                                </div>
                            </td>
                        </tr>

                        <!-- modal -->
                        <div class='modal fade' id='deleteModal' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                        <h4 class='modal-title' id='deleteModalLabel'>Turma</h4>
                                    </div>
                                    <div class='modal-body'>Tem certeza que deseja excluir a Turma?</div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Voltar</button>
                                        <a class='btn btn-danger' href='index.php?class=Turma&function=delete&id=$info->id' role='button'>Excluir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<br>
<hr>
<br>

<div class="row text-right">
    <input type="submit" class="btn btn-warning" value="Voltar" onclick="javascript:history.back()">
</div>
