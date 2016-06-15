<?php
    foreach ($data as $key => $alunos) {
        $id = $alunos->id;
        $nome = $alunos->nome;
        $nascimento = $alunos->nascimento;
    }
?>

<div class="row">
    <div class="col-md-12">
        <p>Aluno <?=$nome?></p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label>Nome Completo: </label><input class="form-control" disabled type="text" value="<?=$nome?>"><br>
        <label>Data de Nascimento: </label><input class="form-control" disabled type="date" value="<?=$nascimento?>"><br>
    </div>
</div>

<br>
<br>

<div class="row">
    <div class="col-md-6"><p class="text-left">Cursos Matriculados</p></div>
    <div class="col-md-6"><p class="text-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#matriculaModal">Nova Matrícula</button></p></div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="col-md-4">CURSO</th>
                        <th class="col-md-2">TURMA</th>
                        <th class="col-md-1">ANO</th>
                        <th class="col-md-1">SEMESTRES</th>
                        <th class="col-md-2">TIPO</th>
                        <th class="col-md-2">OPÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (isset($infos)) {
                            foreach ($infos as $key => $info) {
                                echo "
                                <tr>
                                    <td> $info->curso </td>
                                    <td> $info->turma </td>
                                    <td> $info->ano </td>
                                    <td> $info->semestres </td>
                                    <td> $info->tipo </td>
                                    <td>
                                        <div class='btn-group btn-group-sm' role='group'>

                                            <a class='btn btn-info' href='index.php?class=Curso&function=info&id=$info->cursoID' role='button'><span class='glyphicon glyphicon-eye-open'></span></a>
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
                                                <h4 class='modal-title' id='deleteModalLabel'>Excluir Turma</h4>
                                            </div>
                                            <div class='modal-body'>Tem certeza que deseja excluir a turma?</div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-default' data-dismiss='modal'>Voltar</button>
                                                <a class='btn btn-danger' href='index.php?class=Turma&function=delete&id=$info->turmaID' role='button'>Excluir</a>
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
    </div>
</div>
<div class="row text-right">
    <input type="submit" class="btn btn-warning" value="Voltar" onclick="javascript:history.back()">
</div>

<!-- modal matricula-->
<div class='modal fade' id='matriculaModal' tabindex='-1' role='dialog' aria-labelledby='matriculaModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>

            <form action="index.php?class=Aluno&function=matricula" method="post" name="matricula" role="form">

                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <h4 class='modal-title' id='matriculaModalLabel'>Matricula</h4>
                </div>

                <div class='modal-body'>
                    <div class="row">
                        <label for="cursoID">Curso</label>
                        <select class="form-control" id="cursoID" name="cursoID" required>
                            <option>Escolha o Curso</option>
                            <?php
                                foreach ($cursos as $key => $curso) {
                                    echo '<option value="' . $curso->id . '">' . $curso->nome . '</option>"';
                                }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="row">
                        <label for="">Turmas</label>
                        <select class="form-control" id="turmaID" name="turmaID" required>
                            <option>Escolha a Turma</option>
                        </select>
                    </div>

                    <input type="hidden" name="alunoID" value="<?=$id?>">

                </div>

                <div class='modal-footer'>
                    <input type="submit" class="btn btn-default" data-dismiss='modal' value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Enviar">
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        $('#cursoID').on('change', function() {
            $.ajax({
                url: 'library/functions.php',
                type: 'POST',
                dataType: 'json',
                data: {action: 'matricula', cursoID: this.value},
                success: function(retorno){
                    if (retorno['status'] === 'error') {
                        var html;
                        html = '<option value=""></option>';
                        $('#turmaID').html(html);
                        alert('Não há turmas cadastradas');
                    } else {
                        turmas = retorno['turmas'];
                        for (var variable in turmas) {
                            if (turmas.hasOwnProperty(variable)) {
                                var html;
                                html += '<option value="'+turmas[variable].id+'">'+turmas[variable].nome+'</option>';
                            }
                        }
                        $('#turmaID').html(html);
                    }
                },
                error: function(e) {
                    alert("error");
                    console.log(e);
                }
            });
        });
    });
</script>
