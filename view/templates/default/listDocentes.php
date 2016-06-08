<div class="row">
    <div class="col-md-6">
        <p class="text-left">Docentes</p>
    </div>
    <div class="col-md-6">
        <p class="text-right"><a href="index.php?class=Docente&function=create"><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-plus'></button></a></p>
    </div>
</div>

<div class="table-responsive">

    <table class="table table-bordered table-hover">

        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>DATA DE NASCIMENTO</th>
                <th>OPÇÕES</th>
            </tr>
        </thead>
        <tbody>

            <?php

                foreach ($data as $key => $object) {

                    echo "

                        <tr>
                            <td> $object->id </td>
                            <td> $object->nome </td>
                            <td>" . dateToBr($object->nascimento) . "</td>
                            <td>
                                <div class='btn-group btn-group-sm' role='group'>
                                    <a class='btn btn-info' href='index.php?class=Docente&function=edit&id=$object->id' role='button'><span class='glyphicon glyphicon-eye-open'></span></a>
                                    <a class='btn btn-warning' href='index.php?class=Docente&function=edit&id=$object->id' role='button'><span class='glyphicon glyphicon-pencil'></span></a>
                                    <a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' role='button'><span class='glyphicon glyphicon-trash'></span></a>
                                </div>
                            </td>
                        </tr>

                        <div class='modal fade' id='deleteModal' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                        <h4 class='modal-title' id='deleteModalLabel'>Docente</h4>
                                    </div>
                                    <div class='modal-body'>Tem certeza que deseja excluir o docente?</div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Voltar</button>
                                        <a class='btn btn-danger' href='index.php?class=Docente&function=delete&id=$object->id' role='button'>Excluir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>
