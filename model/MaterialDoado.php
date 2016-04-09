<?php

	include 'Material.php';
	/**
	* Esta classe é referente ao Material de Doação tendo ela um valor associado(Quantidade)
	*/
	class MaterialDoado
	{
		private $material;
		private $quantidade;

		public function __construct($material, $quantidade)
		{
			$this->material = $material;
			$this->quantidade = $quantidade;
		}

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
