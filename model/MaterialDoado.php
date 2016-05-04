<?php
/*
*Classe MaterialDoado
* Casse com informações referentes aos materiais doado em uma Campanha.
*/
//importação de classe necessária
	require_once('Material.php');

	class MaterialDoado
	{
		/**
		* Instância referente a um material.
		*/
		private $material;
		/**
		* Quantidade do material doado.
		*/
		private $quantidade;

		/**< Construtor da classe MaterialDoado que recebe como parâmetro suas características*/
		public function __construct($material, $quantidade)
		{
			$this->material = $material;
			$this->quantidade = $quantidade;
		}

		/**
		* Getters e Setteres
		* Métodos de acessos às variáveis da classe MaterialDoado.
		*/
		public function setQuantidade($quantidade){
			$this->quantidade = $quantidade;
		}

		public function getQuantidade(){
			return $this->quantidade;
		}

		public function getNomeMaterial(){
			return $this->material->getNome();
		}

		public function getMedidaMaterial(){
			return $this->material->getMedida();
		}
	}


 ?>
