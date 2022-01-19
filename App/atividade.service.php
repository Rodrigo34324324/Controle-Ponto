<?php

class AtividadeService {
	private $conexao;
	private $atividade;

	public function __construct(Conexao $conexao, Atividade $atividade) {
		$this->conexao = $conexao->conectar();
		$this->atividade = $atividade;
		//$this->status = $status;
	}

	public function inserir() {
		$fk_idstatus = $this->atividade->__get('fk_idstatus');
		$fk_idfuncionario = $this->atividade->__get('fk_idfuncionario');

		$query = '';
		if($fk_idstatus == 1) {
			$query = "insert into historico_atividades(fk_idfuncionario, fk_idstatus)values(:fk_idfuncionario, $fk_idstatus)";
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':fk_idfuncionario', $fk_idfuncionario);
			$stmt->execute();
		} else if($fk_idstatus == 2 || $fk_idstatus == 3) {
			$query = "insert into historico_atividades(fk_idstatus)values($fk_idstatus)";
			$this->conexao->query($query);
		}
	}

	public function recuperar() {
		$query = 'select h.fk_idstatus, h.data, f.nome from historico_atividades as h left join funcionarios as f on (h.fk_idfuncionario = f.idfuncionario) order by idatividade desc limit 3';
		$stmt = $this->conexao->query($query);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	/*public function inserir() {
		$fk_idstatus = $this->jornada->__get('fk_idstatus');

		$query = $fk_idstatus == 1 ?
		'update jornadas_trabalho set fk_idstatus = 2, inicio_intervalo = now() where fk_idfuncionario = :fk_idfuncionario' :
		($fk_idstatus == 2 ?
		'update jornadas_trabalho set fk_idstatus = 3, volta_intervalo = now() where fk_idfuncionario = :fk_idfuncionario' :
		($fk_idstatus == 3 ?
		'update jornadas_trabalho set fk_idstatus = 4, saida = now() where fk_idfuncionario = :fk_idfuncionario' :
		('insert into jornadas_trabalho(fk_idfuncionario, fk_idstatus, entrada)values(:fk_idfuncionario, 1, now())')));
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':fk_idfuncionario', $this->jornada->__get('fk_idfuncionario'));
		$stmt->execute();*/
		/*
		$query = 'insert into funcionarios(nome, sobrenome, email, data_admissao)values(:nome, :sobrenome, :email, :data_admissao)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':nome', $this->funcionario->__get('nome'));
		$stmt->bindValue(':sobrenome', $this->funcionario->__get('sobrenome'));
		$stmt->bindValue(':email', $this->funcionario->__get('email'));
		$stmt->bindValue(':data_admissao', $this->funcionario->__get('data_admissao'));
		$stmt->execute();

		$query = 'select idfuncionario from funcionarios where email = "'.$this->funcionario->__get('email').'"';
		$stmt = $this->conexao->query($query);
		$registro = $stmt->fetch(PDO::FETCH_OBJ);

		$query = 'insert into enderecos(fk_idfuncionario, cep, rua, bairro, cidade, estado)values('.$registro->idfuncionario.', :cep, :rua, :bairro, :cidade, :estado)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':cep', $this->endereco->__get('cep'));
		$stmt->bindValue(':rua', $this->endereco->__get('rua'));
		$stmt->bindValue(':bairro', $this->endereco->__get('bairro'));
		$stmt->bindValue(':cidade', $this->endereco->__get('cidade'));
		$stmt->bindValue(':estado', $this->endereco->__get('estado'));
		$stmt->execute();
		*/
	/*}*/

	/*public function recuperar($limit, $offset) {
		$query = "select f.idfuncionario, f.palavra_passe, j.fk_idstatus, f.nome, f.sobrenome, f.email, j.entrada, j.inicio_intervalo, j.volta_intervalo, j.saida, f.foto, date_format(f.data_admissao, '%d/%m/%y') as data_admissao from funcionarios as f left join (select * from jornadas_trabalho where `data` = curdate()) as j on (f.idfuncionario = j.fk_idfuncionario) limit $limit offset $offset";
		$stmt = $this->conexao->query($query);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}*/

	/*public function atualizar() {*/
		/*
		$query = 'update funcionarios set nome = :nome, sobrenome = :sobrenome, email = :email, data_admissao = :data_admissao where idfuncionario = :idfuncionario';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':nome', $this->funcionario->__get('nome'));
		$stmt->bindValue(':sobrenome', $this->funcionario->__get('sobrenome'));
		$stmt->bindValue(':email', $this->funcionario->__get('email'));
		$stmt->bindValue(':data_admissao', $this->funcionario->__get('data_admissao'));
		$stmt->bindValue(':idfuncionario', $this->funcionario->__get('id'));
		$atualizacaoFuncionario = $stmt->execute();

		$query = 'update enderecos set cep = :cep, rua = :rua, bairro = :bairro, cidade = :cidade, estado = :estado where fk_idfuncionario = :fk_idfuncionario';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':cep', $this->endereco->__get('cep'));
		$stmt->bindValue(':rua', $this->endereco->__get('rua'));
		$stmt->bindValue(':bairro', $this->endereco->__get('bairro'));
		$stmt->bindValue(':cidade', $this->endereco->__get('cidade'));
		$stmt->bindValue(':estado', $this->endereco->__get('estado'));
		$stmt->bindValue(':fk_idfuncionario', $this->endereco->__get('fk_id'));
		$atualizacaoEndereco = $stmt->execute();

		$retorno = array(
			'atualizacaoFuncionario' => $atualizacaoFuncionario,
			'atualizacaoEndereco' => $atualizacaoEndereco
		);
		return $retorno;
		*/
	/*}*/

	/*public function remover() {*/
		/*
		$query = 'delete from enderecos where fk_idfuncionario = :fk_idfuncionario';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':fk_idfuncionario', $this->endereco->__get('fk_id'));
		$stmt->execute();

		$query = 'delete from funcionarios where idfuncionario = :idfuncionario';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':idfuncionario', $this->funcionario->__get('id'));
		$stmt->execute();

		header('Location: todos_funcionarios.php');
		*/
	/*}*/

	/*public function recuperarTotal() {
		$query = "select count(*) as total from funcionarios";
		$stmt = $this->conexao->query($query);
		return $stmt->fetch(PDO::FETCH_OBJ);
	}*/

	/*public function gerarRelatorio($data_relatorio) {
		$stmt = $this->recuperarTotal();
		$total_funcionarios = $stmt->total;

		$query = 'select nome, sobrenome, email, telefone from funcionarios where idfuncionario not in (select fk_idfuncionario from jornadas_trabalho where `data` = curdate())';
		$stmt = $this->conexao->query($query);
		$faltosos = $stmt->fetchAll(PDO::FETCH_OBJ);*/

		/* */
		/*$query = "select f.nome, f.sobrenome, f.email, date_format(j.data, '%d/%m/%Y') as data, j.entrada, j.inicio_intervalo, j.volta_intervalo, j.saida from jornadas_trabalho as j inner join funcionarios as f on (j.fk_idfuncionario = f.idfuncionario) where j.data like '$data_relatorio-__'";
		$stmt = $this->conexao->query($query);
		$pontos = $stmt->fetchAll(PDO::FETCH_OBJ);*/
		/* */

		/*$relatorio = array(
			'total_funcionarios' => $total_funcionarios,
			'faltosos' => $faltosos,
			'pontos' => $pontos
		);
		return $relatorio;
	}*/
}

?>