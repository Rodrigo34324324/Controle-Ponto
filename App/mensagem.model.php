<?php

class Mensagem {
	private $para;
	private $mensagem;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	public function mensagemValida() {
		if(empty($this->mensagem)) {
			return false;
		}

		return true;
	}
}

?>