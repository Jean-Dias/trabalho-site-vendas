<?php


function gerar_token_csrf() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validar_csrf() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf_token'] ?? '';
        if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            http_response_code(403);
            exit('<p style="color:red;font-family:sans-serif;text-align:center;margin-top:3rem">❌ Token CSRF inválido. <a href="javascript:history.back()">Voltar</a></p>');
        }
    }
}

function campo_csrf() {
    $token = gerar_token_csrf();
    return '<input type="hidden" name="csrf_token" value="' . $token . '">';
}

function definir_cookie_usuario($nome) {
    setcookie('ultimo_usuario', $nome, [
        'expires' => time() + (86400 * 30),
        'path' => '/',
        'secure' => false,  
        'httponly' => true, 
        'samesite' => 'Lax' 
    ]);
}

function obter_cookie_usuario() {
    return $_COOKIE['ultimo_usuario'] ?? null;
}

function remover_cookie_usuario() {
    setcookie('ultimo_usuario', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}
