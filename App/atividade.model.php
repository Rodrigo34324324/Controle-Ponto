<?php

class Atividade {
	private $idatividade;
	private $fk_idfuncionario;
	private $fk_idstatus;
	private $data;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}
}

?>