<?php

date_default_timezone_set('America/Sao_Paulo');

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
$data_atual = strftime('%d '.ucfirst(strftime('%b')).' %Y');

$acao = 'recuperar';
require 'jornada_controller.php'

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
    <link rel="stylesheet" type="text/css" href="css/estilo-index.css">

    <!-- JS File -->
    <script src="js/main.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0c25f323b8.js" crossorigin="anonymous"></script>

    <title>App Controle Ponto</title>
  </head>
  <body id="index">
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
          <input type="text" class="form-control bg-light border-0" id="barra-pesquisa" placeholder="Procure por..." onkeyup="pesquisarFuncionarioIndex('barra-pesquisa')">
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
                <input type="text" class="form-control bg-light border-0" id="barra-pesquisa-sm" placeholder="Procure por..." onkeyup="pesquisarFuncionarioIndex('barra-pesquisa-sm')">
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
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="mr-3"><i class="fas fa-fingerprint"></i></div>
              <div>Bater Ponto</div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#" onclick="acessarRecursoRestrito('novo_funcionario.php', 1)">
              <div class="mr-3"><i class="fas fa-user-plus"></i></div>
              <div>Adicionar Funcionário</div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#" onclick="acessarRecursoRestrito('todos_funcionarios.php', 1)">
              <div class="mr-3"><i class="fas fa-users"></i></i></div>
              <div>Funcionários</div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#" onclick="acessarRecursoRestrito('relatorio.php', 1)">
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

    <div class="container">
      <div class="mb-4 text-center redes-sociais">
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
        </ul>
      </div>

      <div class="row">
        <!-- <div class="d-none d-lg-block col-2 order-2">
          <div class="mt-5">
            <ul class="navbar-nav border-left">
              <li class="nav-item"><a href="#" class="nav-link">Pontos</a></li>
              <li class="nav-item"><a href="novo_funcionario.php" class="nav-link">Adicionar</a></li>
              <li class="nav-item"><a href="relatorio.php" class="nav-link">Relatório</a></li>
              <li class="nav-item"><a href="todos_funcionarios.php" class="nav-link">Funcionários</a></li>
            </ul>
          </div>
        </div> -->

        <div class="col-12"><!-- col-lg-10 order-1 -->

          <div class="mt-5 d-flex justify-content-between align-items-center text-black-50">
            <div class="hora-atual"><i class="far fa-clock"></i><span class="ml-2" id="hora-atual"></span></div>
            <!-- <div class="info-funcionarios"><span>Expedientes concluídos(3)</span></div> -->
            <div class="opcoes">
              <i class="fas fa-search"></i><i class="fas fa-envelope ml-1"></i><!--<i class="fas fa-folder-open ml-1"></i>--><i class="fas fa-users ml-1"></i>
            </div>
          </div>

          <div class="mt-3">
            <ul class="lista list-inline">
              <?php
                foreach($registros as $indice => $registro) {
                  $presente_sn = $registro->fk_idstatus % 2 != 0 ? 'presente' : 'ausente';

                  $nome_completo = $registro->nome.' '.$registro->sobrenome;

                  $entrada = strtotime($registro->entrada == null ? date('H:i:s') : $registro->entrada);
                  $inicio_intervalo = strtotime($registro->inicio_intervalo == null ? date('H:i:s') : $registro->inicio_intervalo);
                  $volta_intervalo = strtotime($registro->volta_intervalo == null ? date('H:i:s') : $registro->volta_intervalo);
                  $saida = strtotime($registro->saida == null ? date('H:i:s') : $registro->saida);
                  $jornada_trabalho = (($inicio_intervalo - $entrada) + ($saida - $volta_intervalo)) / 3600;
                  $jornada_trabalho = floor($jornada_trabalho);

                  $ultimo_ponto = $registro->fk_idstatus == 1 ? $registro->entrada :
                  ($registro->fk_idstatus == 2 ? $registro->inicio_intervalo :
                  ($registro->fk_idstatus == 3 ? $registro->volta_intervalo :
                  ($registro->fk_idstatus == 4 ? $registro->saida : 0)));
                  $ultimo_ponto = $ultimo_ponto == 0 ? '<i class="fas fa-exclamation-triangle"></i>' :
                  date('H', strtotime($ultimo_ponto)).'h'.date('i', strtotime($ultimo_ponto))
              ?>
                <li id="<?= $registro->idfuncionario ?>" class="d-flex justify-content-between li">
                  <div class="d-flex flex-row align-items-center">
                    <i class="fas fa-check-circle <?= $presente_sn ?>"></i>
                    <div class="ml-2">
                      <h6 class="mb-0" data-toggle="tooltip" data-placement="top" title="<?= $registro->email ?>"><?= $nome_completo ?></h6>
                      <div class="d-flex flex-row mt-1 data-tempo-trabalho text-black-50">
                        <div><i class="far fa-calendar"></i><span class="ml-2"><?= $data_atual ?> <?= $ultimo_ponto ?></span></div>
                        <div class="ml-3"><i class="far fa-clock"></i><span class="ml-2"><?= $jornada_trabalho ?>h</span></div>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center">
                    <div class="d-flex flex-column mr-2">
                      <div class="d-flex flex-row">
                        <img class="rounded-circle" src="img/<?= $registro->foto ?>" width="33">
                        <button class="btn-primary ml-2 align-self-center negrito" data-toggle="tooltip" data-placement="bottom" title="Registrar ponto" onclick="baterPonto(<?= $registro->idfuncionario ?>, '<?= $registro->palavra_passe ?>', '<?= $pagina ?>', <?= $registro->fk_idstatus ?>)">Registrar</button>
                        <!-- <h5 class="mb-0 ml-1" onclick="baterPonto(<?= $registro->idfuncionario ?>, <?= $registro->fk_idstatus ?>)"><span class="badge badge-primary">Registrar</span></h5> -->
                      </div>
                      <span class="data-tempo-trabalho text-black-50">Admissão <?= $registro->data_admissao ?></span>
                    </div>
                    <i class="fas fa-times" type="button" data-toggle="tooltip" data-placement="bottom" title="Ocultar" onclick="fecharElemento(<?= $registro->idfuncionario ?>)"></i>
                  </div>
                </li>
              <?php } ?>
            </ul>
          </div>

          <nav class="mt-5" aria-label="Páginas de registro de ponto">
            <ul class="pagination justify-content-center">
              <?php for($i = 1; $i <= $total_paginas; $i++) { ?>
                <li class="page-item <?= $pagina_ativa == $i ? 'active' : '' ?> mr-1">
                  <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                </li>
              <?php } ?>
            </ul>
          </nav>
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

    <!-- <a class="scroll" href="#bottom"><i class="fas fa-chevron-down"></i></a>
    <span id="bottom"></span> -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>