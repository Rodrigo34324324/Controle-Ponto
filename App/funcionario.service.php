<?php

class FuncionarioService {
	private $conexao;
	private $funcionario;
	private $endereco;

	public function __construct(Conexao $conexao, Funcionario $funcionario, Endereco $endereco) {
		$this->conexao = $conexao->conectar();
		$this->funcionario = $funcionario;
		$this->endereco = $endereco;
	}

	public function inserir() {
		$query = 'insert into funcionarios(nome, sobrenome, email, telefone, data_admissao, foto, palavra_passe)values(:nome, :sobrenome, :email, :telefone, :data_admissao, :foto, :palavra_passe)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':nome', $this->funcionario->__get('nome'));
		$stmt->bindValue(':sobrenome', $this->funcionario->__get('sobrenome'));
		$stmt->bindValue(':email', $this->funcionario->__get('email'));
		$stmt->bindValue(':telefone', $this->funcionario->__get('telefone'));
		$stmt->bindValue(':data_admissao', $this->funcionario->__get('data_admissao'));
		$stmt->bindValue(':foto', $this->funcionario->__get('foto'));
		$stmt->bindValue(':palavra_passe', $this->funcionario->__get('palavra_passe'));
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
	}

	public function recuperar($limit, $offset) {
		$query = "select f.idfuncionario, f.foto, f.nome, f.sobrenome, e.cidade, e.estado, f.email, e.rua, e.bairro, date_format(f.data_admissao, '%d/%m/%Y') as data_admissao, f.telefone, e.cep from funcionarios as f inner join enderecos as e on (f.idfuncionario = e.fk_idfuncionario) limit $limit offset $offset";
		$stmt = $this->conexao->query($query);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar() {
		$query = 'update funcionarios set nome = :nome, sobrenome = :sobrenome, email = :email, telefone = :telefone, data_admissao = :data_admissao, foto = :foto where idfuncionario = :idfuncionario';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':nome', $this->funcionario->__get('nome'));
		$stmt->bindValue(':sobrenome', $this->funcionario->__get('sobrenome'));
		$stmt->bindValue(':email', $this->funcionario->__get('email'));
		$stmt->bindValue(':telefone', $this->funcionario->__get('telefone'));
		$stmt->bindValue(':data_admissao', $this->funcionario->__get('data_admissao'));
		$stmt->bindValue(':idfuncionario', $this->funcionario->__get('id'));
		$stmt->bindValue(':foto', $this->funcionario->__get('foto'));
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
	}

	public function remover() {
		$query = 'delete from enderecos where fk_idfuncionario = :fk_idfuncionario';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':fk_idfuncionario', $this->endereco->__get('fk_id'));
		$stmt->execute();

		$query = 'delete from jornadas_trabalho where fk_idfuncionario = :fk_idfuncionario';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':fk_idfuncionario', $this->funcionario->__get('id'));
		$stmt->execute();

		$query = 'delete from historico_atividades where fk_idfuncionario = :fk_idfuncionario';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':fk_idfuncionario', $this->funcionario->__get('id'));
		$stmt->execute();

		$query = 'delete from funcionarios where idfuncionario = :idfuncionario';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':idfuncionario', $this->funcionario->__get('id'));
		$stmt->execute();
	}

	public function recuperarTotal() {
		$query = "select count(*) as total from funcionarios";
		$stmt = $this->conexao->query($query);
		return $stmt->fetch(PDO::FETCH_OBJ);
	}
}

?>