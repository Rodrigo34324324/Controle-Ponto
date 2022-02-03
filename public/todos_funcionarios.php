<?php

$acao = 'recuperar';
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
    <link rel="stylesheet" type="text/css" href="css/estilo-todos-funcionarios.css">

    <!-- JS File -->
    <script src="js/main.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0c25f323b8.js" crossorigin="anonymous"></script>

    <title>App Controle Ponto</title>
  </head>
  <body id="todos-funcionarios">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-5 shadow">
      <form class="d-none d-sm-inline-block form-inline ml-md-3">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0" id="barra-pesquisa" placeholder="Procure por..." onkeyup="pesquisarFuncionario('barra-pesquisa')">
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
                <input type="text" class="form-control bg-light border-0" id="barra-pesquisa-sm" placeholder="Procure por..." onkeyup="pesquisarFuncionario('barra-pesquisa-sm')">
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
            <a class="dropdown-item d-flex align-items-center" href="#">
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

    <div class="container">
      <!-- <div class="mb-4 text-center redes-sociais">
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
        </ul>
      </div> -->

      <div class="row">
        <div class="col-12">
          <div class="mt-5 d-flex justify-content-between align-items-center text-black-50">
            <div class="hora-atual"><i class="far fa-clock"></i><span class="ml-2" id="hora-atual"></span></div>
            <!-- <div class="info-funcionarios"><span>Funcionários(3)</span></div> -->
            <div class="opcoes">
              <i class="fas fa-search"></i><i class="fas fa-envelope ml-1"></i><!--<i class="fas fa-folder-open ml-1"></i>--><i class="fas fa-users ml-1"></i>
            </div>
          </div>

          <div class="mt-2 d-flex justify-content-around flex-wrap">
            <?php
              foreach($registros as $indice => $registro) {
                $nome_completo = $registro->nome.' '.$registro->sobrenome
            ?>
              <div class="card-funcionario">
                <div class="card my-2 p-3 border">
                  <div class="d-flex align-items-center">
                    <div class="img-fluid">
                      <img src="img/<?= $registro->foto ?>" class="rounded" width="155">
                    </div>

                    <div class="ml-3 w-100">
                      <h4 class="mb-0 mt-0" data-toggle="tooltip" data-placement="top" title="<?= $nome_completo ?>">
                        <?php echo strlen($nome_completo) <= 12 ? $nome_completo : substr($nome_completo, 0, 11).'...' ?>
                      </h4>
                      <span><?= $registro->cidade.', '.$registro->estado ?></span>

                      <div class="p-2 mt-2 d-flex justify-content-between rounded dados">
                        <div class="d-flex flex-column">
                          <span class="tipo-dado">Email</span>
                          <span class="dado text-muted text-center">
                            <i type="button" class="fas fa-envelope" data-toggle="tooltip" data-placement="bottom" title="<?= $registro->email ?>" onclick="toggleCardEmail(1, '<?= $registro->foto ?>', '<?= $nome_completo ?>', '<?= $registro->email ?>')"></i>
                          </span>
                        </div>

                        <div class="d-flex flex-column">
                          <span class="tipo-dado">Endereço</span>
                          <span class="dado text-muted text-center">
                            <i class="fas fa-map-marker-alt" data-toggle="tooltip" data-placement="bottom" title="<?= $registro->rua.', '.$registro->bairro ?>"></i>
                          </span>
                        </div>

                        <div class="d-flex flex-column">
                          <span class="tipo-dado">Admissão</span>
                          <span class="dado text-muted text-center" data-toggle="tooltip" data-placement="bottom" title="<?= $registro->data_admissao ?>">
                            <?= substr($registro->data_admissao, 3, 3).substr($registro->data_admissao, 8) ?>
                          </span>
                        </div>
                      </div>

                      <div class="mt-2 d-flex flex-row">
                        <button type="button" class="btn btn-sm btn-outline-primary w-100" data-toggle="modal" data-target="#modal" onclick="toggleFormEditarFuncionario(); editarFuncionario(<?= $registro->idfuncionario ?>, '<?= $registro->foto ?>', '<?= $registro->nome ?>', '<?= $registro->sobrenome ?>', '<?= $registro->email ?>', '<?= $registro->telefone ?>', '<?= $registro->cep ?>', '<?= $registro->data_admissao ?>')">Editar</button>
                        <button type="button" class="btn btn-sm btn-primary w-100 ml-2" onclick="removerFuncionario(<?= $registro->idfuncionario ?>, <?= $pagina ?>)">Deletar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

            <!--<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="titulo-modal" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-light">
                    <h5 class="modal-title" id="titulo-modal">Atualizar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="container-fluid">
                      <form method="post" enctype="multipart/form-data" action="funcionario_controller.php?acao=atualizar">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="arquivo" name="arquivo">

                        <div class="form-row">
                          <div class="col-4 form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                          </div>
                          <div class="col-8 form-group">
                            <label for="sobrenome">Sobrenome</label>
                            <input type="text" class="form-control" id="sobrenome" name="sobrenome">
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="col-7 form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <small class="form-text text-muted">Não compartilhamos seu email com terceiros</small>
                          </div>
                          <div class="col-5 form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone">
                          </div>
                        </div>

                        <div class="form-row mb-3">
                          <div class="col-4">
                            <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" onblur="getDadosEnderecoPorCEP(this.value)">
                          </div>
                          <div class="col-8">
                            <input type="text" class="form-control" id="logradouro" name="rua" placeholder="Logradouro" readonly>
                          </div>
                        </div>

                        <div class="form-row mb-3">
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
                          <div class="col-6 col-sm-5 form-group">
                            <label for="admissao">Admissão</label>
                            <input type="date" class="form-control" id="admissao" name="admissao">
                          </div>
                          <div class="col-6 col-lg-7 form-group">
                            <label for="foto-perfil">Foto de perfil</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="foto-perfil" name="foto-perfil">
                              <label class="custom-file-label" for="foto-perfil">Escolher arquivo</label>
                            </div>
                          </div>
                        </div>

                        <button class="btn btn-primary btn-block btn-lg mt-4">Salvar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>-->

            <div class="d-none" id="atualizar-funcionario">
            <div class="container rounded border">
              <div class="row">
                <div class="col-md-3 border-right">
                  <div class="d-flex flex-column align-items-center py-5">
                    <img class="rounded-circle mt-5" id="img-funcionario-atualizar" width="90">
                    <span class="font-weight-bold" id="nome-funcionario-atualizar"></span>
                    <span class="text-black-50" id="email-funcionario-atualizar"></span>
                    <span>Funcionário(a)</span>
                  </div>
                </div>
                <div class="col-md-5 border-right">
                  <div class="p-3 py-5">
                    <div class="d-flex mb-3">
                      <h6>Formulário de atualização</h6>
                    </div>
                    <?php
                      //$desc_status_cadastro = isset($_GET['inclusao']) && $_GET['inclusao'] == 0 ? 'Email em uso, tente novamente' :
                      //(isset($_GET['inclusao']) && $_GET['inclusao'] == 1 ? 'Cadastrado com sucesso!' :
                      //(isset($_GET['inclusao']) == null ? '' : ''));

                      //$status_cadastro = isset($_GET['inclusao']) && $_GET['inclusao'] == 0 ? 'badge-danger' :
                      //(isset($_GET['inclusao']) && $_GET['inclusao'] == 1 ? 'badge-primary' :
                      //(isset($_GET['inclusao']) == null ? 'd-none' : ''));
                    ?>
                    <!--<span class="badge shadow-sm <?= $status_cadastro ?>"><?= $desc_status_cadastro ?></span>-->
                    <form method="post" enctype="multipart/form-data" action="funcionario_controller.php?acao=atualizar&pagina=<?= $pagina ?>">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="arquivo" name="arquivo">
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
                        <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" onblur="getDadosEnderecoPorCEP(this.value)" required>
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
                        <input type="file" id="foto-perfil" name="foto-perfil">
                      </div>
                    </div>
                    <div class="mt-5 text-center">
                      <button type="button" class="btn btn-block btn-outline-primary cancelar-button" onclick="toggleFormEditarFuncionario()">Cancelar</button>
                      <button class="btn btn-block btn-primary atualizar-button">Atualizar</button>
                    </div>
                    </form>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center">
                      <span>Siga-nos também</span><!--<span class="range-us px-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></span>-->
                    </div>
                    <div class="redes-sociais-atualizar">
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
            </div>

            <div class="d-none" id="card-email">
              <div class="card shadow">
                <div class="row px-3">
                  <img class="img-perfil mr-3 rounded-circle" id="img-card-email">
                  <div>
                    <h3 class="mb-0" id="nome-card-email"></h3>
                    <span id="email-card-email"></span>
                  </div>
                </div>
                <form method="post" action="funcionario_controller.php?acao=enviar_email">
                  <input type="hidden" id="para" name="para">

                  <div class="row px-3 form-group">
                    <textarea class="bg-light mt-4 mb-3" name="mensagem" placeholder="Oi George, o que está em sua mente hoje?" required></textarea>
                  </div>
                  <div class="row px-3">
                    <div class="d-flex align-items-center">
                      <i class="fas fa-bold opcoes mr-4"></i>
                      <i class="fas fa-italic opcoes mr-4"></i>
                      <i class="fas fa-underline opcoes mr-5"></i>

                      <i class="far fa-image opcoes mr-4"></i>
                      <i class="fas fa-ellipsis-h opcoes"></i>
                    </div>
                    <div class="ml-auto">
                      <button type="button" class="btn btn-sm btn-outline-primary px-4" onclick="toggleCardEmail()">Cancelar</button>
                      <button class="btn btn-sm btn-primary ml-1 px-4">Enviar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <nav class="mt-5" aria-label="Páginas de listagem de funcionários">
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

      <footer class="border-top my-5 pt-5 text-muted text-center">
        <p class="mb-1">&copy; 2021-2022 Controle Ponto</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacidade</a></li>
          <li class="list-inline-item"><a href="#">Termos</a></li>
          <li class="list-inline-item"><a href="#">Suporte</a></li>
        </ul>

        <div class="redes-sociais">
          <ul class="list-inline">
            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-discord"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-github"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
          </ul>
        </div>
      </footer>
    </div>

    <!-- <a class="scroll" href="#bottom"><i class="fas fa-chevron-down"></i></a>
    <span id="bottom"></span> -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>