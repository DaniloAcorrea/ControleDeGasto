<?php
header("Content-Type: application/json");

require_once "../helpers/ResponseHelper.php";
require_once "../helpers/AuthHelper.php";
require_once "../helpers/ValidationHelper.php";

require_once "../controllers/PerfilController.php";
require_once "../controllers/CategoriaController.php";
require_once "../controllers/TransacaoController.php";

/*
 Exemplo:
 ?rota=perfil/login
 ?rota=categoria/list
*/

$rota = $_GET['rota'] ?? '';

if (!$rota) {
    ResponseHelper::error("Rota não informada", 400);
}

$partes = explode('/', $rota);

$modulo = $partes[0] ?? null;
$acao   = $partes[1] ?? null;

if (!$modulo || !$acao) {
    ResponseHelper::error("Rota inválida", 400);
}

switch ($modulo) {

    case 'perfil':
        require "../routes/perfil.php";
        break;

    case 'categoria':
        require "../routes/categoria.php";
        break;

    case 'transacao':
        require "../routes/transacao.php";
        break;

    default:
        ResponseHelper::error("Módulo não encontrado", 404);
}
