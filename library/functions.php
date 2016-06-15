<?php

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'matricula':
            matricula();
        break;
        default:
            exit();
        break;
    }
}


function dateToEn($data)
{
    $data = explode("/", $data);
    list($day, $month, $year) = $data;
    $date = "$year-$month-$day";
    return $date;
}

function dateToBr($date)
{
    $date = explode("-", $date);
    list($ano, $mes, $dia) = $date;
    $data = "$dia/$mes/$ano";
    return $data;
}

function sanitizeCaracters(&$string)
{
    $string = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $string ) );
}

//matricula(7);

function matricula($cursoID = null)
{
    include './configure.php';
    include './ConnectionDB.class.php';
    include '../model/BaseModel.class.php';
    include '../model/TurmaModel.class.php';

    if (isset($_POST['cursoID'])) {
        $cursoID = $_POST['cursoID'];
    }

    //echo json_encode($cursoID); exit;

    try {

        $turmaModel = new TurmaModel();
        $turmas = $turmaModel->edit($cursoID);
        $resposta['status'] = 'error';

        if ($turmas) {
            $resposta['status'] = 'success';
            foreach ($turmas as $key => $turma) {
                $resposta['turmas'][] = array(
                    'id' => $turma->id,
                    'nome' => $turma->nome,
                    'ano' => $turma->ano,
                    'semestres' => $turma->semestres,
                );
            }
        }

        echo json_encode($resposta);

    } catch (Exception $exc) {
        echo json_encode($exc->getMessage());
    }
}
