<?php

switch ($acao) {

    case 'create':
        CategoriaController::create();
        break;

    case 'list':
        CategoriaController::list();
        break;

    default:
        ResponseHelper::error("Rota de categoria inválida", 404);
}
