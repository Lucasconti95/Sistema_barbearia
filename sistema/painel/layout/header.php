<?php
require_once("../conexao.php");
require_once("verificar.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>AgendaPro</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="layout/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>


<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="../painel/index.php">AgendaPro</a>
        <!-- Sidebar Toggle-->

        <div class="d-flex align-items-center">
            <div class="bg-warning text-white p-3 circle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
            </div>
        </div>

        <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> -->

        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-warning" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Configurações</a></li>
                    <li><a class="dropdown-item" href="#!">Log de Atividades</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../painel/logout.php">Sair</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <!-- <div class="sb-sidenav-menu-heading">Menu de Navegação</div> -->

                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Home
                        </a>

                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Nova Comanda
                        </a>

                        <!-- Pessoas Menu -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePessoas" aria-expanded="false" aria-controls="collapsePessoas">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Pessoas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapsePessoas" aria-labelledby="headingPessoas" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../painel/pessoas_usuarios.php">Usuários</a>
                                <a class="nav-link" href="../painel/pessoas_funcionarios.php">Funcionarios</a>
                                <a class="nav-link" href="../painel/pessoas_clientes.php">Clientes</a>
                                <a class="nav-link" href="../painel/pessoas_retornos.php">Clientes Retornos</a>
                                <a class="nav-link" href="../painel/pessoas_fornecedores.php">Fornecedores</a>
                            </nav>
                        </div>
                        <!-- Fim Pessoas Menu -->

                        <!-- Cadastro Menu -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCadastros" aria-expanded="false" aria-controls="collapseCadastros">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Cadastros
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseCadastros" aria-labelledby="headingCadastros" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../painel/cadastro_servicos.php">Serviços</a>
                                <a class="nav-link" href="../painel/cadastro_cargos.php">Cargos</a>
                                <a class="nav-link" href="../painel/cadastro_categoria_servicos.php">Categoria Serviços</a>
                                <a class="nav-link" href="../painel/cadastro_grupo_acessos.php">Grupo Acessos</a>
                                <a class="nav-link" href="../painel/cadastro_acesso.php">Acessos</a>
                                <a class="nav-link" href="../painel/cadastro_formas_pagamento.php">Formas de Pagamento</a>
                                <a class="nav-link" href="../painel/cadastro_bloqueio_dias.php">Bloqueio de Dias</a>
                            </nav>
                        </div>
                        <!-- Fim Cadastro Menu -->

                        <!-- Produtos Menu -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProdutos" aria-expanded="false" aria-controls="collapseProdutos">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Produtos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseProdutos" aria-labelledby="headingProduto" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionProduto">
                                <a class="nav-link" href="../painel/produtos_produtos.php">Produtos</a>
                                <a class="nav-link" href="../painel/produtos_categorias.php">Categorias</a>
                                <a class="nav-link" href="../painel/produtos_estoque_baixo">Estoque Baixo</a>
                                <a class="nav-link" href="../painel/produtos_saidas.php">Saídas</a>
                                <a class="nav-link" href="../painel/produtos_entradas.php">Entradas</a>
                            </nav>
                        </div>
                        <!-- Fim Produtos Menu -->

                        <!-- Financeiro Menu -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFinanceiro" aria-expanded="false" aria-controls="collapseFinanceiro">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Financeiro
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseFinanceiro" aria-labelledby="headingFinanceiro" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionFinanceiro">
                                <a class="nav-link" href="../painel/financeiro_vendas.php">Vendas</a>
                                <a class="nav-link" href="../painel/financeiro_compras.php">Compras</a>
                                <a class="nav-link" href="../painel/financeiro_contasapagar.php">Contas à Pagar</a>
                                <a class="nav-link" href="../painel/financeiro_contasareceber.php">Contas à Receber</a>
                                <a class="nav-link" href="#">Comissões</a>
                            </nav>
                        </div>
                        <!-- Fim Financeiro Menu -->

                        <!-- Agenda / Serviço Menu -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseServico" aria-expanded="false" aria-controls="collapseServico">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Agenda / Serviço
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseServico" aria-labelledby="headingServico" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionServico">
                                <a class="nav-link" href="#">Agendamentos</a>
                                <a class="nav-link" href="#">Serviços</a>
                            </nav>
                        </div>
                        <!-- Fim Agenda / Serviço Menu -->

                        <!-- Relatorios Menu -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRelatorio" aria-expanded="false" aria-controls="collapseRelatorio">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Relatórios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseRelatorio" aria-labelledby="headingRelatorio" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionRelatorio">
                                <a class="nav-link" href="#">Relatório de Produtos</a>
                                <a class="nav-link" href="#">Entradas / Ganhos</a>
                                <a class="nav-link" href="#">Saídas / Despesas</a>
                                <a class="nav-link" href="#">Relatório de Comissões</a>
                                <a class="nav-link" href="#">Relatório de Contas</a>
                                <a class="nav-link" href="#">Relatório de Serviços</a>
                                <a class="nav-link" href="#">Relatório de Aniversáriantes</a>
                                <a class="nav-link" href="#">Demonstrativo de Lucro</a>
                            </nav>
                        </div>
                        <!-- Fim Relatorios Menu -->

                        <a class="nav-link" href="../painel/campanha_marketing.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Campanha de Mkt
                        </a>

                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Calendário
                        </a>

                        <!-- Dados do Site Menu -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSite" aria-expanded="false" aria-controls="collapseSite">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Dados do Site
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseSite" aria-labelledby="headingSite" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionSite">
                                <a class="nav-link" href="../painel/dados_site_texto.php">Textos Index</a>
                                <a class="nav-link" href="../painel/dados_site_comentarios.php">Comentarios</a>
                            </nav>
                        </div>
                        <!-- Fim Dados do Site Menu -->

                        <a class="nav-link" href="../painel/minha_agenda.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Minha Agenda
                        </a>

                        <a class="nav-link" href="../painel/meus_Servicos.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Meus Serviços
                        </a>

                        <a class="nav-link" href="../painel/minhas_comissoes.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Minhas Comissões
                        </a>

                        <!-- Horarios / dias Menu -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseHorarios" aria-expanded="false" aria-controls="collapseHorarios">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Meus Horarios / Dias
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseHorarios" aria-labelledby="headingHorarios" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionHorarios">
                                <a class="nav-link" href="../painel/meus_horarios_dias.php">Horarios / Dias</a>
                                <a class="nav-link" href="../painel/meus_horarios_dias_servicos.php">Lançar Serviços</a>
                                <a class="nav-link" href="../painel/meus_horarios_dias_bloqueio_dias.php">Bloqueio de Dias</a>
                            </nav>
                        </div>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Seja Bem Vindo:</div>
                    <?php
                    echo @$_SESSION['nome'] . '<br><br>';
                    ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">