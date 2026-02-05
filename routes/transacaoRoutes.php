<?php

switch ($acao) {

    case 'create':
        TransacaoController::create();
        break;

    case 'list':
        TransacaoController::listByPerfil();
        break;

    case 'saldo':
        TransacaoController::saldo();
        break;

    default:
        ResponseHelper::error("Rota de transação inválida", 404);
}
