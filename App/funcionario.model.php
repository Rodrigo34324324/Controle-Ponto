<?php

class Funcionario {
	private $id;
	private $nome;
	private $sobrenome;
	private $email;
	private $telefone;
	private $data_admissao;
	private $foto;
	private $palavra_passe;
	private $data_desligamento;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}
}

?>