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

    <!-- CSS Styles -->
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/estilo-novo-funcionario.css">

    <!-- JS File -->
    <script src="js/main.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0c25f323b8.js" crossorigin="anonymous"></script>

    <title>App Controle Ponto</title>
  </head>
  <body id="novo-funcionario">
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
            <img class="rounded-circle" src="img/adm.jpg">
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

    <div>
      <div class="container rounded border">
        <div class="row">
          <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center py-5">
              <img class="rounded-circle mt-5" src="img/adm.jpg" width="90">
              <span class="font-weight-bold">George W.</span>
              <span class="text-black-50">george@teste.com</span>
              <span>Administrador</span>
            </div>
          </div>
          <div class="col-md-5 border-right">
            <div class="p-3 py-5">
              <div class="d-flex mb-3">
                <h6>Formulário de cadastro</h6>
              </div>
              <?php
                $desc_status_cadastro = isset($_GET['inclusao']) && $_GET['inclusao'] == 0 ? 'Email em uso, tente novamente' :
                (isset($_GET['inclusao']) && $_GET['inclusao'] == 1 ? 'Cadastrado com sucesso!' :
                (isset($_GET['inclusao']) == null ? '' : ''));

                $status_cadastro = isset($_GET['inclusao']) && $_GET['inclusao'] == 0 ? 'badge-danger' :
                (isset($_GET['inclusao']) && $_GET['inclusao'] == 1 ? 'badge-primary' :
                (isset($_GET['inclusao']) == null ? 'd-none' : ''));
              ?>
              <span class="badge shadow-sm <?= $status_cadastro ?>"><?= $desc_status_cadastro ?></span>
              <form method="post" enctype="multipart/form-data" action="funcionario_controller.php?acao=inserir">
              <div class="row">
                <div class="col-md-6">
                  <label class="labels" for="nome">Nome</label>
                  <input type="text" class="form-control" id="nome" name="nome" placeholder="João" required>
                </div>
                <div class="col-md-6">
                  <label class="labels" for="sobrenome">Sobrenome</label>
                  <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Silva" required>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12">
                  <label class="labels" for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="joao@teste.com" required>
                </div>
                <div class="col-md-6 mt-3">
                  <label class="labels" for="telefone">Telefone</label>
                  <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(xx) xxxxx xxxx" required>
                </div>
                <div class="col-md-6 mt-3">
                  <label class="labels">CEP</label>
                  <input type="text" class="form-control" name="cep" placeholder="00000-000" onblur="getDadosEnderecoPorCEP(this.value)" required>
                </div>
                <div class="col-md-12 mt-4">
                  <input type="text" class="form-control" id="logradouro" name="rua" placeholder="Logradouro" readonly>
                </div>
                <div class="col-md-12 mt-4">
                  <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" readonly>
                </div>
                <div class="col-md-6 mt-4">
                  <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" readonly>
                </div>
                <div class="col-md-6 mt-4">
                  <input type="text" class="form-control" id="uf" name="estado" placeholder="UF" readonly>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  <label class="labels" for="admissao">Admissão</label>
                  <input type="date" class="form-control" id="admissao" name="admissao" required>
                </div>
                <div class="col-md-6">
                  <label class="foto-perfil" for="foto-perfil" data-toggle="tooltip" data-placement="bottom" title="Selecione foto de perfil">
                    <i class="fas fa-cloud-upload-alt"></i>
                  </label>
                  <input type="file" id="foto-perfil" name="foto-perfil" required>
                </div>
              </div>
              <div class="mt-5 text-center"><button class="btn btn-block btn-primary cadastrar-button">Cadastrar</button></div>
              </form>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-3 py-5">
              <div class="d-flex justify-content-between align-items-center">
                <span>Siga-nos também</span><!--<span class="range-us px-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></span>-->
              </div>
              <div class="redes-sociais">
                <div class="d-flex flex-row mt-3">
                  <i class="fab fa-linkedin-in"></i>
                  <div class="ml-1">
                    <span class="font-weight-bold d-block">143.423 seguidores</span>
                    <span class="d-block text-black-50 labels">Linkedin, Inc.</span>
                    <span class="d-block text-black-50 labels">Nov 2021 - Jan 2022</span>
                  </div>
                </div>
                <hr>
                <div class="d-flex flex-row">
                  <i class="fab fa-facebook"></i>
                  <div class="ml-1">
                    <span class="font-weight-bold d-block">105.412 seguidores</span>
                    <span class="d-block text-black-50 labels">Facebook, Inc.</span>
                    <span class="d-block text-black-50 labels">Nov 2021 - Jan 2022</span>
                  </div>
                </div>
              </div>
              <hr>
            </div>
          </div>
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