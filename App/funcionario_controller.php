<?php

require "../App/conexao.php";
require "../App/funcionario.model.php";
require "../App/endereco.model.php";
require "../App/mensagem.model.php";
require "../App/atividade.model.php";
require "../App/funcionario.service.php";
require "../App/atividade.service.php";

require "../App/bibliotecas/PHPMailer/Exception.php";
require "../App/bibliotecas/PHPMailer/OAuth.php";
require "../App/bibliotecas/PHPMailer/PHPMailer.php";
require "../App/bibliotecas/PHPMailer/POP3.php";
require "../App/bibliotecas/PHPMailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if($acao == 'inserir') {
	$funcionario = new Funcionario();
	$funcionario->__set('nome', $_POST['nome']);
	$funcionario->__set('sobrenome', $_POST['sobrenome']);
	$funcionario->__set('email', $_POST['email']);
	$funcionario->__set('telefone', $_POST['telefone']);
	$funcionario->__set('data_admissao', $_POST['admissao']);
	//$funcionario->__set('palavra_passe', $_POST['palavra-passe']);
	$codigo_identidade = substr(uniqid(), 5);
	//$codigo_identidade = uniqid();
	$funcionario->__set('palavra_passe', strtoupper(md5($codigo_identidade)));
	$nome_completo = $funcionario->__get('nome').' '.$funcionario->__get('sobrenome');

	$mensagem = new Mensagem();

	$mensagem->__set('para', $_POST['email']);
	$mensagem->__set('mensagem', "<strong>$codigo_identidade</strong> é o código para verificação de identidade. <strong>Não</strong> compartilhe seu código!");

	$tmp_nome = $_FILES['foto-perfil']['tmp_name'];
	//$novo_nome = uniqid();
	//$extensao = strtolower(pathinfo($_FILES['foto-perfil']['name'], PATHINFO_EXTENSION));
	$arquivo = $_FILES['foto-perfil']['name'];
	$pasta = 'C:\Users\User\Desktop\TCC\public\img';
	move_uploaded_file($tmp_nome, "$pasta/$arquivo");

	$funcionario->__set('foto', $arquivo);

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

		$mail = new PHPMailer(true);
		//Server settings
		$mail->SMTPDebug = false;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'rodrigo3284024@gmail.com';                     //SMTP username
		$mail->Password   = '!$lophi_in_2083';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		//Recipients
		$mail->setFrom('rodrigo3284024@gmail.com', 'Rodrigo Miranda');
		$mail->addAddress($mensagem->__get('para'), $nome_completo);     //Add a recipient
		//$mail->addAddress('ellen@example.com');               //Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Chave de identidade';
		$mail->Body    = $mensagem->__get('mensagem');
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		//echo 'E-mail enviado!';		

	} catch(PDOException $e) {

		if($e->getCode() == 23000) {
			header('Location: novo_funcionario.php?inclusao=0');
			die();
		} else if($e->getCode() == 2) {
			echo 'Não foi possível enviar este e-mail! Por favor, tente novamente mais tarde.';
			echo 'Detalhes do erro: ' . $mail->ErrorInfo;
		}

	}

	header('Location: novo_funcionario.php?inclusao=1');//Trate a possiblidade de campos vazios antes do redirect
} else if($acao == 'recuperar') {
	$funcionario = new Funcionario();

	$endereco = new Endereco();

	$conexao = new Conexao();

	$total_registros_pagina = 6;
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
	$deslocamento = ($pagina - 1) * $total_registros_pagina;

	$funcionarioService = new FuncionarioService($conexao, $funcionario, $endereco);
	$registros = $funcionarioService->recuperar($total_registros_pagina, $deslocamento);

	$total_registros = $funcionarioService->recuperarTotal();
	$total_paginas = ceil($total_registros->total / $total_registros_pagina);
	$pagina_ativa = $pagina;

	$atividade = new Atividade();

	$atividadeService = new AtividadeService($conexao, $atividade);

	$historico_atividades = $atividadeService->recuperar();
} else if($acao == 'atualizar') {
	$funcionario = new Funcionario();
	$funcionario->__set('id', $_POST['id']);
	$funcionario->__set('nome', $_POST['nome']);
	$funcionario->__set('sobrenome', $_POST['sobrenome']);
	$funcionario->__set('email', $_POST['email']);
	$funcionario->__set('telefone', $_POST['telefone']);
	$funcionario->__set('data_admissao', $_POST['admissao']);

	if($_FILES['foto-perfil']['error'] == 4) {
		$funcionario->__set('foto', $_POST['arquivo']);
	} else {
		$tmp_nome = $_FILES['foto-perfil']['tmp_name'];
		//$novo_nome = uniqid();
		//$extensao = strtolower(pathinfo($_FILES['foto-perfil']['name'], PATHINFO_EXTENSION));
		$arquivo = $_FILES['foto-perfil']['name'];
		$pasta = 'C:\Users\User\Desktop\TCC\public\img';
		move_uploaded_file($tmp_nome, "$pasta/$arquivo");

		$funcionario->__set('foto', $arquivo);
	}

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
} else if($acao == 'remover') {
	$funcionario = new Funcionario();
	$funcionario->__set('id', $_GET['id']);

	$endereco = new Endereco();
	$endereco->__set('fk_id', $_GET['id']);

	$conexao = new Conexao();

	$funcionarioService = new FuncionarioService($conexao, $funcionario, $endereco);
	$funcionarioService->remover();
} else if($acao == 'enviar_email') {
	$mensagem = new Mensagem();

	$mensagem->__set('para', $_POST['para']);
	$mensagem->__set('mensagem', $_POST['mensagem']);

	if(!$mensagem->mensagemValida()) {
		echo 'Mensagem não é válida';
		die();
	}

	$mail = new PHPMailer(true);
	try {
		//Server settings
		$mail->SMTPDebug = false;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'george.washington.merlin@gmail.com';                     //SMTP username
		$mail->Password   = '!$lophi_in_2083';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		//Recipients
		$mail->setFrom('george.washington.merlin@gmail.com', 'George Washington Merlin');
		$mail->addAddress($mensagem->__get('para'), 'Rodrigo do Nascimento Miranda');     //Add a recipient
		//$mail->addAddress('ellen@example.com');               //Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Sem Assunto';
		$mail->Body    = $mensagem->__get('mensagem');
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		//echo 'E-mail enviado!';

		$conexao = new Conexao();

		$atividade = new Atividade();
		$atividade->__set('fk_idstatus', 3);

		$atividadeService = new AtividadeService($conexao, $atividade);
		$atividadeService->inserir();

		header('Location: todos_funcionarios.php');
	} catch (Exception $e) {
		echo 'Não foi possível enviar este e-mail! Por favor, tente novamente mais tarde.';
		echo 'Detalhes do erro: ' . $mail->ErrorInfo;
	}
} else if($acao == 'mostrar_form') {
	$conexao = new Conexao();

	$atividade = new Atividade();

	$atividadeService = new AtividadeService($conexao, $atividade);

	$historico_atividades = $atividadeService->recuperar();
}

?>