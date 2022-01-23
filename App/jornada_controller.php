<?php

require "../App/conexao.php";
require "../App/jornada.model.php";
require "../App/status.model.php";
require "../App/atividade.model.php";
require "../App/jornada.service.php";
require "../App/atividade.service.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if($acao == 'inserir') {
	$jornada = new Jornada();
	$jornada->__set('fk_idfuncionario', $_GET['id']);
	$jornada->__set('fk_idstatus', $_GET['status']);

	$status = new Status();

	$conexao = new Conexao();

	$jornadaService = new JornadaService($conexao, $jornada, $status);
	$jornadaService->inserir();

	$atividade = new Atividade();
	$atividade->__set('fk_idfuncionario', $_GET['id']);
	$atividade->__set('fk_idstatus', 1);

	$atividadeService = new AtividadeService($conexao, $atividade);
	$atividadeService->inserir();

	$pagina = $_GET['pagina'];
	header("Location: index.php?pagina=$pagina");
	/*
	$funcionario = new Funcionario();
	$funcionario->__set('nome', $_POST['nome']);
	$funcionario->__set('sobrenome', $_POST['sobrenome']);
	$funcionario->__set('email', $_POST['email']);
	$funcionario->__set('data_admissao', $_POST['admissao']);

	$endereco = new Endereco();
	$endereco->__set('cep', $_POST['cep']);
	$endereco->__set('rua', $_POST['rua']);
	$endereco->__set('bairro', $_POST['bairro']);
	$endereco->__set('cidade', $_POST['cidade']);
	$endereco->__set('estado', $_POST['estado']);

	$conexao = new Conexao();

	$funcionarioService = new FuncionarioService($conexao, $funcionario, $endereco);

	try {

		$funcionarioService->inserir();

	} catch(PDOException $e) {

		if($e->getCode() == 23000) {
			header('Location: novo_funcionario.php?inclusao=0');
			die();
		}

	}

	header('Location: novo_funcionario.php?inclusao=1');//Trate a possiblidade de campos vazios antes do redirect
	*/
} else if($acao == 'recuperar') {
	$jornada = new Jornada();

	$status = new Status();

	$conexao = new Conexao();

	$total_registros_pagina = 6;
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
	$deslocamento = ($pagina - 1) * $total_registros_pagina;

	$jornadaService = new JornadaService($conexao, $jornada, $status);
	$registros = $jornadaService->recuperar($total_registros_pagina, $deslocamento);

	$total_registros = $jornadaService->recuperarTotal();
	$total_paginas = ceil($total_registros->total / $total_registros_pagina);
	$pagina_ativa = $pagina;

	$atividade = new Atividade();

	$atividadeService = new AtividadeService($conexao, $atividade);

	$historico_atividades = $atividadeService->recuperar();
} else if($acao == 'atualizar') {
	/*
	$funcionario = new Funcionario();
	$funcionario->__set('id', $_POST['id']);
	$funcionario->__set('nome', $_POST['nome']);
	$funcionario->__set('sobrenome', $_POST['sobrenome']);
	$funcionario->__set('email', $_POST['email']);
	$funcionario->__set('data_admissao', $_POST['admissao']);

	$endereco = new Endereco();
	$endereco->__set('fk_id', $_POST['id']);
	$endereco->__set('cep', $_POST['cep']);
	$endereco->__set('rua', $_POST['rua']);
	$endereco->__set('bairro', $_POST['bairro']);
	$endereco->__set('cidade', $_POST['cidade']);
	$endereco->__set('estado', $_POST['estado']);

	$conexao = new Conexao();

	$funcionarioService = new FuncionarioService($conexao, $funcionario, $endereco);
	$retorno = $funcionarioService->atualizar();
	if($retorno['atualizacaoFuncionario'] && $retorno['atualizacaoEndereco']) {
		header('Location: todos_funcionarios.php');
	}
	*/
} else if($acao == 'remover') {
	/*
	$funcionario = new Funcionario();
	$funcionario->__set('id', $_GET['id']);

	$endereco = new Endereco();
	$endereco->__set('fk_id', $_GET['id']);

	$conexao = new Conexao();

	$funcionarioService = new FuncionarioService($conexao, $funcionario, $endereco);
	$funcionarioService->remover();
	*/
} else if($acao == 'gerarRelatorio') {
	$jornada = new Jornada();

	$status = new Status();

	$conexao = new Conexao();

	$jornadaService = new JornadaService($conexao, $jornada, $status);
	$relatorio = $jornadaService->gerarRelatorio($data_relatorio);

	$atividade = new Atividade();
	$atividade->__set('fk_idstatus', 2);

	$atividadeService = new AtividadeService($conexao, $atividade);
	$atividadeService->inserir();

	$historico_atividades = $atividadeService->recuperar();

	//echo "<pre>";
	//print_r($historico_atividades);
	//echo "</pre>";
}

?>