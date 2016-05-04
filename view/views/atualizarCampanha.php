<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/AlterarFotoFacade.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");

// Nas versões do PHP anteriores a 4.1.0, $HTTP_POST_FILES deve ser utilizado ao invés
// de $_FILES.

$campanha = CampanhaDAO::getInstance()->buscarCampanha($_POST['campanha']); 

$uploaddir = "../uploads/".$campanha->getIdCampanha();
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);




if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	AlterarFotoFacade::getInstance()->editarFotoCampanha($uploadfile,$campanha->getIdCampanha()); 
	//AlterarFotoFacade::getInstance()->editarFoto($uploadfile,$_SESSION['cpf']);	
}
$idCampanha = $campanha->getIdCampanha();
$campanha->setDescricao($_POST['descricao']);

$codMaterial = CriadorFacade::getInstance()->buscarMetasCampanha();
if ($codMaterial[0]->getCodMaterial() == 0 && !$campanha->getFinalizaPorData()) {
	$valorMeta = $_POST['metaMonetaria'];
}
elseif ($codMaterial[0]->getCodMaterial() != 0) {
	$nomeMaterial = $_POST['nomeMaterial[]'];
	$medidaMaterial = $_POST['medidaMaterial[]'];
	CriadorFacade::getInstance()->removerMetasCampanha($idCampanha);
	if(!$campanha->getFinalizaPorData()){ #por Meta
	  $qtd = $_POST['quantidadeMaterial[]'];
	  for ($i = 0; $i < $nomeMaterial.length; $i++) { #cadastrando material com quantidade na meta #$idCampanha, $codMaterial, $qtd
	  	$codMaterial = CriadorFacade::getInstance()->cadastrarMaterial($nomeMaterial[$i], $medidaMaterial[$i]);
	  	CriadorFacade::getInstance()->cadastrarMetaMaterial($codMaterial, $qtd[$i], $idCampanha);
	  }
	}
	else{
	  for ($i = 0; $i < $nomeMaterial.length; $i++) { #por data #$idCampanha, $codMaterial, $qtd
	    $codMaterial = CriadorFacade::getInstance()->cadastrarMaterial($nomeMaterial[$i], $medidaMaterial[$i]);
	    CriadorFacade::getInstance()->cadastrarMetaMaterial($codMaterial, 0, $idCampanha);
	  }
	}

	if(isset($_POST['materialDoacao[]'])){
		$materialDoacao = $_POST['materialDoacao[]'];
		if(!$campanha->getFinalizaPorData()){#por meta
		  $qtdMaterial = $_POST['quantidadeMaterial[]'];
		  for ($i = 0; $i < $qtdMaterial.length ; $i++) { 
		    CriadorFacade::getInstance()->cadastrarMetaMaterial($idCampanha, $materialDoacao[i], $qtdMaterial[i]);
		  }
		}
		else{#por data
		  for ($i = 0; $i < $qtdMaterial.length ; $i++) { 
		    CriadorFacade::getInstance()->cadastrarMetaMaterial($idCampanha, $materialDoacao[i], 0);
		  }
		}
	}
}
$campanha->setAgradecimento($_POST['agradecimento']);

$campanha->setTituloAgradecimento($_POST['titulo']);

CriadorFacade::getInstance()->editarCampanha($campanha);




if(isset($_POST['cpfAtendente'])){ #por Meta
	CriadorFacade::getInstance()->removerAtendentes();
	$atendentes = $_POST['cpfAtendente'];
	for ($i = 0; $i < count($atendentes); $i++) { 
		CriadorFacade::getInstance()->adicionarAtendenteCampanha($idCampanha, $atendentes[$i]);
	}
}

?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<script type="text/javascript">
	window.location="http://campanha.php?campanha=<?php echo $idCampanha;?>";
</script>




</body>
</html>