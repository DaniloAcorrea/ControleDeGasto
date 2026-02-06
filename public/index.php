<?php
header("Content-Type: application/json");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Caminho base do projeto (fora da pasta public)
define('BASE_PATH', dirname(__DIR__));

// Helpers
require_once BASE_PATH . "/helpers/ResponseHelper.php";
require_once BASE_PATH . "/helpers/AuthHelper.php";
require_once BASE_PATH . "/helpers/ValidationHelper.php";

// Controllers
require_once BASE_PATH . "/controllers/PerfilController.php";
require_once BASE_PATH . "/controllers/CategoriaController.php";
require_once BASE_PATH . "/controllers/TransacaoController.php";

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
        require BASE_PATH . "/routes/perfil.php";
        break;

    case 'categoria':
        require BASE_PATH . "/routes/categoria.php";
        break;

    case 'transacao':
        require BASE_PATH . "/routes/transacao.php";
        break;

    default:
        ResponseHelper::error("Módulo não encontrado", 404);
}
