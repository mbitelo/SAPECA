<?php
session_start();
require_once("classes/listar.php");
$objListar = new Listar();
$senhaerrada = false;
if(@$_POST["senha"]){ if(@md5($_POST["senha"]) == "eefefad1a47e1b8d9fb7293ee3a8e184"){ $_SESSION["logado"] = true;}else{$senhaerrada = true;}}
if(isset($_GET["sair"])){session_destroy(); $_SESSION["logado"] = false;}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>SAPECA · <?php echo isset($_titulo) ? $_titulo : "Início"; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        .subtitulo{
            font-size: 1rem;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="assets/css/album.css" rel="stylesheet">
    <script src="assets/js/jquery-3.3.1.min.js"></script>

</head>
<body>
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">Sobre</h4>
                        <p class="text-muted">Somos uma startup comunitária com colaboração de diversas pessoas alimentando informações de animais perdidos e encontrados, com a finalidade de fazer a ligação deste com sua familia.</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Área reservada</h4>
                        <ul class="list-unstyled">
                            <?php if(@$_SESSION["logado"] == false){ ?>
                            <form class="form-inline" method="post" action="aprovacao.php">
                                <label class="sr-only" for="inlineFormInputName2">Name</label>
                                <input type="password" class="form-control-sm mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Senha" name="senha" required autofocus>
                                <button type="submit" class="btn btn-primary mb-2 btn-sm">Entrar</button>
                            </form><?php } else { ?>
                            <li><a href="aprovacao.php" class="text-white">Aprovar publicações</a></li>
                            <li><a href="index.php?sair" class="text-white">Sair</a></li><?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="index.php" class="navbar-brand d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="-2 0 22 18" focusable="false" role="img"><image width="20" height="20" xlink:href="assets/img/White_paw_print.svg.png" preserveAspectRatio="none" /></svg>
                    <strong>SAPECA</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>