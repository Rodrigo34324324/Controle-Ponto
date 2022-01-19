<?php

date_default_timezone_set('America/Sao_Paulo');
//$hora_atual = date('H:i:s');

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
//$data_atual = strftime('%A, %d de %B de %Y');
//$data_relatorio = strftime('%Y-%m');
//$data_relatorio = isset($_GET['data_relatorio']) ? $_GET['data_relatorio'] : strftime('%Y-%m');

$acao = 'mostrar_form';
require 'funcionario_controller.php'

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- CSS Style -->
    <link rel="stylesheet" type="text/css" href="css/estilo.css">

    <!-- JS File -->
    <script src="js/main.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0c25f323b8.js" crossorigin="anonymous"></script>

    <title>App Controle Ponto</title>
  </head>
  <body>
    <!-- <nav class="navbar navbar-light border-bottom mb-4">
      <div class="container">
        <div class="navbar-brand mb-0 h1">
          <h3>App Controle Ponto</h3>
        </div>
      </div>
    </nav> -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-5 shadow">
      <form class="d-none d-sm-inline-block form-inline ml-md-3">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0" placeholder="Procure por...">
          <div class="input-group-append"><button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button></div>
        </div>
      </form>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="procurar-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search text-black-50"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right p-3 shadow" aria-labelledby="procurar-dropdown">
            <form class="form-inline">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0" placeholder="Procure por...">
                <div class="input-group-append"><button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button></div>
              </div>
            </form>
          </div>
        </li>

        <li class="nav-item dropdown mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="notificacoes-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell text-black-50"></i><span class="badge badge-danger badge-counter">3+</span>
          </a>
          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow" aria-labelledby="notificacoes-dropdown">
            <h6 class="dropdown-header">Notificações</h6>
            <?php
              foreach($historico_atividades as $indice => $atividade) {
                $icn_atividade = $atividade->fk_idstatus == 1 ? 'fas fa-user' :
                ($atividade->fk_idstatus == 2 ? 'fas fa-file' : 'fas fa-paper-plane');

                $desc_atividade = $atividade->fk_idstatus == 1 ? "$atividade->nome registrou ponto!" :
                ($atividade->fk_idstatus == 2 ? 'Relatório acessado' : 'Email encaminhado');

                $data_atividade = date('d M Y', strtotime($atividade->data));

                $complemento = $atividade->fk_idstatus == 2 ? 'font-weight-bold' : ''
            ?>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3"><i class="<?= $icn_atividade ?>"></i></div>
                <div>
                  <div class="small"><?= $data_atividade ?></div> <span class="<?= $complemento ?>"><?= $desc_atividade ?></span>
                </div>
              </a>
            <?php } ?>
            <!-- <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="mr-3"><i class="fas fa-file"></i></div>
              <div>
                <div class="small">12 Fev 2022</div> <span class="font-weight-bold">Relatório acessado</span>
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="mr-3"><i class="fas fa-user"></i></div>
              <div>
                <div class="small">12 Fev 2022</div> Rodrigo registrou ponto!
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="mr-3"><i class="fas fa-paper-plane"></i></div>
              <div>
                <div class="small">12 Fev 2022</div> Amanda enviou email
              </div>
            </a> -->
            <a class="dropdown-item text-center small" href="#">Mostrar Tudo</a>
          </div>
        </li>

        <li class="nav-item dropdown mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="menu-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-stream text-black-50"></i>
          </a>
          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow" aria-labelledby="menu-dropdown">
            <h6 class="dropdown-header">Menu</h6>
            <a class="dropdown-item d-flex align-items-center" href="index.php">
              <div class="mr-3"><i class="fas fa-fingerprint"></i></div>
              <div>Bater Ponto</div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="mr-3"><i class="fas fa-user-plus"></i></div>
              <div>Adicionar Funcionário</div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="todos_funcionarios.php">
              <div class="mr-3"><i class="fas fa-users"></i></i></div>
              <div>Funcionários</div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="relatorio.php">
              <div class="mr-3"><i class="fas fa-folder-open"></i></div>
              <div>Gerar Relatório</div>
            </a>
            <a class="dropdown-item text-center small" href="#"><i class="fas fa-ellipsis-h"></i></a>
          </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="usuario-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline small font-weight-bold">George Was...</span>
            <img class="rounded-circle" src="img/funcionario_3.jpeg">
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="usuario-dropdown">
            <a class="dropdown-item" href="#">
              <i class="fas fa-user mr-2"></i> Perfil
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-cogs mr-2"></i> Configurações
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-list mr-2"></i> Atividades
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logout-modal">
              <i class="fas fa-sign-out-alt mr-2"></i> Sair
            </a>
          </div>
        </li>
      </ul>
    </nav>

    <div class="container">
      <div class="mb-5 text-center status-inclusao">
        <!-- <ul class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="fab fa-github"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fab fa-gitlab"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
        </ul> -->

        <?php if(isset($_GET['inclusao']) == null) { ?>
          <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
            <span class="negrito">Atenção!</span> Certifique-se do preenchimento correto de todos os campos.
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php } ?>

        <?php if(isset($_GET['inclusao']) && $_GET['inclusao'] == 1) { ?>
          <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
            <span class="negrito">Sucesso!</span> Registro inserido em nossa base de dados.
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php } ?>

        <?php if(isset($_GET['inclusao']) && $_GET['inclusao'] == 0) { ?>
          <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <span class="negrito">Erro!</span> E-mail já registrado em nossa base de dados.
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php } ?>
      </div>

      <div class="row">
        <!-- <div class="d-none d-lg-block col-2 order-2 ml-auto">
          <div class="mt-5">
            <ul class="navbar-nav border-left">
              <li class="nav-item"><a href="index.php" class="nav-link">Pontos</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Adicionar</a></li>
              <li class="nav-item"><a href="relatorio.php" class="nav-link">Relatório</a></li>
              <li class="nav-item"><a href="todos_funcionarios.php" class="nav-link">Funcionários</a></li>
            </ul>
          </div>
        </div> -->

        <div id="area-formulario" class="col-12 col-sm-11 col-md-10 mx-auto"><!-- order-1 -->
          <h4 class="mb-3">Formulário</h4>

          <form method="post" enctype="multipart/form-data" action="funcionario_controller.php?acao=inserir">
            <div class="form-row">
              <div class="col-4 form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="João">
              </div>
              <div class="col-8 form-group">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Silva">
              </div>
            </div>

            <div class="form-row">
              <div class="col-7 form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="joao@teste.com">
                <small class="form-text text-muted">Não compartilhamos seu email com terceiros</small>
              </div>
              <div class="col-5 form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(37) 99999 8922">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-3">
                <input type="text" class="form-control" name="cep" placeholder="CEP" onblur="getDadosEnderecoPorCEP(this.value)">
              </div>
              <div class="col-9">
                <input type="text" class="form-control" id="logradouro" name="rua" placeholder="Logradouro" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-6">
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" readonly>
              </div>
              <div class="col-4">
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" readonly>
              </div>
              <div class="col-2">
                <input type="text" class="form-control" id="uf" name="estado" placeholder="UF" readonly>
              </div>
            </div>

            <div class="row">
              <div class="col-5 col-lg-4 form-group">
                <label for="admissao">Admissão</label>
                <input type="date" class="form-control" id="admissao" name="admissao">
              </div>
              <div class="col-7 col-lg-8 form-group">
                <label for="foto-perfil">Foto de perfil</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="foto-perfil" name="foto-perfil">
                  <label class="custom-file-label" for="foto-perfil">Escolher arquivo</label>
                </div>
              </div>
            </div>

            <!-- <hr>

            <h4 class="mb-3">Configuração</h4>
            <div class="row">
              <div class="col-5 col-lg-4 form-group">
                <label for="palavra-passe">Palavra-passe</label>
                <input type="text" class="form-control" id="palavra-passe" name="palavra-passe">
              </div>
            </div>

            <hr> -->

            <button class="btn btn-primary btn-lg btn-block mt-4">Cadastrar</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center">
        <p class="mb-1">&copy; 2021-2022 Controle Ponto</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacidade</a></li>
          <li class="list-inline-item"><a href="#">Termos</a></li>
          <li class="list-inline-item"><a href="#">Suporte</a></li>
        </ul>
      </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>