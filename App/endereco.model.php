<?php

class Endereco {
	private $id;
	private $fk_id;
	private $cep;
	private $rua;
	private $bairro;
	private $cidade;
	private $estado;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}
}

?>