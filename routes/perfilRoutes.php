<?php

switch ($acao) {

    case 'register':
        PerfilController::register();
        break;

    case 'login':
        PerfilController::login();
        break;

    default:
        ResponseHelper::error("Rota de perfil inválida", 404);
}
