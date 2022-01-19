<?php

class Jornada {
	private $idjornada_trabalho;
	private $fk_idfuncionario;
	private $fk_idstatus;
	private $data;
	private $entrada;
	private $inicio_intervalo;
	private $volta_intervalo;
	private $saida;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}
}

?>