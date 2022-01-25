<?php

date_default_timezone_set('America/Sao_Paulo');
$hora_atual = date('H:i:s');

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
$data_atual = strftime('%A, %d de %B de %Y');
//$data_relatorio = strftime('%Y-%m');
$data_relatorio = isset($_GET['data_relatorio']) ? $_GET['data_relatorio'] : strftime('%Y-%m');

$acao = 'gerarRelatorio';
require 'jornada_controller.php'

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0c25f323b8.js" crossorigin="anonymous"></script>

    <!-- CSS Styles -->
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/estilo-relatorio.css">

    <!-- JS File -->
    <script src="js/main.js"></script>

    <title>Relatório</title>
  </head>
  <body oncontextmenu="return false">
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
            <a class="dropdown-item d-flex align-items-center" href="novo_funcionario.php">
              <div class="mr-3"><i class="fas fa-user-plus"></i></div>
              <div>Adicionar Funcionário</div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="todos_funcionarios.php">
              <div class="mr-3"><i class="fas fa-users"></i></i></div>
              <div>Funcionários</div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
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

    <div class="container mt-50 mb-50">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
              <h6 class="card-title">Relatório</h6>
              <div class="d-flex align-items-center">
                <button type="button" class="btn btn-light btn-sm" onclick="window.print()"><i class="fas fa-file mr-2"></i> Salvar</button>
                <!-- <button type="button" class="btn btn-light btn-sm ml-3"><i class="fas fa-print mr-2"></i> Printar</button> -->
                <input type="month" class="ml-3 form-control-sm" id="data-relatorio" value="<?= $data_relatorio ?>" onblur="gerarRelatorio()">
              </div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="d-md-flex col-sm-6">
                  <div class="mb-4 pull-left">
                    <h6>EMPRESAXYZ.COM</h6>
                    <ul class="list-unstyled mb-0 text-left">
                      <li>R. dos Viajantes, 2269</li>
                      <li>Centro, Formiga - MG</li>
                      <li>+55 (37) 3322-4345</li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-4">
                    <div class="text-sm-right">
                      <h4 class="report-color mt-md-2">Relatório #XYZ12</h4>
                      <ul class="list-unstyled mb-0">
                        <li><?= $data_atual ?></li>
                        <li><?= $hora_atual ?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="d-md-flex">
                <div class="mb-md-2 text-left">
                  <span class="text-muted">Nº de Funcionários: <?= $relatorio['total_funcionarios'] ?></span>
                  <ul class="list-unstyled mb-0">
                    <li><h5 class="my-2">Faltas do dia:</h5></li>
                    <?php foreach($relatorio['faltosos'] as $indice => $faltoso) {
                      $nome_completo = $faltoso->nome.' '.$faltoso->sobrenome;
                    ?>
                      <li><?= $nome_completo ?></li>
                    <?php } ?>
                  </ul>
                </div>
                <div class="mb-2 ml-auto">
                  <span class="text-muted">Inf. de Contato:</span>
                  <div class="d-flex wmin-md-400">
                    <ul class="list-unstyled mb-0 text-left">
                      <li><h5 class="my-2">Email</h5></li>
                      <?php foreach($relatorio['faltosos'] as $indice => $faltoso) { ?>
                        <li><?= $faltoso->email ?></li>
                      <?php } ?>
                    </ul>
                    <ul class="list-unstyled text-right mb-0 ml-auto">
                      <li><h5 class="my-2">Telefone</h5></li>
                      <?php foreach($relatorio['faltosos'] as $indice => $faltoso) { ?>
                        <li><?= $faltoso->telefone ?></li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="table-responsive pb-5">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Contabilização Mensal</th>
                    <th>Data</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($relatorio['pontos'] as $indice => $ponto) {
                    $nome_completo = $ponto->nome.' '.$ponto->sobrenome;

                    $entrada = strtotime($ponto->entrada);
                    $inicio_intervalo = strtotime($ponto->inicio_intervalo == null ? date('H:i:s') : $ponto->inicio_intervalo);
                    $volta_intervalo = strtotime($ponto->volta_intervalo == null ? date('H:i:s') : $ponto->volta_intervalo);
                    $saida = strtotime($ponto->saida == null ? date('H:i:s') : $ponto->saida);
                    $jornada_trabalho = ($inicio_intervalo - $entrada) + ($saida - $volta_intervalo)
                  ?>
                    <tr>
                      <td>
                        <h6 class="mb-0"><?= $nome_completo ?></h6>
                        <span class="text-muted"><?= $ponto->email ?></span>
                      </td>
                      <td><?= $ponto->data ?></td>
                      <td><?= gmdate('G', $jornada_trabalho).'h'.gmdate('i', $jornada_trabalho) ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

            <!-- <div class="card-body">
              <div class="d-md-flex">
                <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                  <h6 class="mb-3 text-left">Resumo</h6>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th class="text-left">Nº de Funcionários:</th>
                          <td class="text-right"><?= $relatorio['total_funcionarios'] ?></td>
                        </tr>
                        <tr>
                          <th class="text-left">Faltas</th>
                          <td class="text-right">5</td>
                        </tr>
                        <tr>
                          <th class="text-left">Aprov.:</th>
                          <td class="text-right text-primary"><h5>72%</h5></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="text-right mt-3">
                    <button type="button" class="btn btn-primary"><i class="fas fa-file-download mr-1"></i> Download</button>
                  </div>
                </div>
              </div>
            </div> -->

            <div class="card-footer">
              <span class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis aute irure dolor in reprehenderit</span>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>