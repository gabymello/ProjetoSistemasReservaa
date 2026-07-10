<?php
require_once __DIR__ . '/funcoes.php';
$paginaAtual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($tituloPagina) ? e($tituloPagina) : 'Sistema de Reservas' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
<header class="topbar">
    <div class="brand">
        <span class="logo">R</span>
        <span>Reservas &amp; Emprestimos</span>
    </div>
    <?php if (logado()): ?>
    <nav class="menu">
        <a href="<?= BASE_URL ?>/index.php">Dashboard</a>
        <?php if (ehAdmin()): ?>
            <a href="<?= BASE_URL ?>/recursos/listar.php">Recursos</a>
            <a href="<?= BASE_URL ?>/categorias/listar.php">Categorias</a>
            <a href="<?= BASE_URL ?>/setores/listar.php">Setores</a>
            <a href="<?= BASE_URL ?>/reservas/listar.php">Reservas</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/reservas/reservar.php">Reservar</a>
            <a href="<?= BASE_URL ?>/reservas/historico.php">Meu Historico</a>
        <?php endif; ?>
    </nav>
    <div class="userbox">
        <span><?= e($_SESSION['usuario_nome']) ?> (<?= e($_SESSION['usuario_tipo']) ?>)</span>
        <a class="btn-sair" href="<?= BASE_URL ?>/logout.php">Sair</a>
    </div>
    <?php endif; ?>
</header>
<main class="container">
