
  <?php 
 require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/CriadorFacade.php");
  

  $categoria = $_POST['categoria'];
  $cpf = $_POST['cpf'];

  $nomeCampanha = $_POST['nome'];

  $descricao = $_POST['descricao'];

  $dataInicio = date("Y-m-d");
  $dataFim = "";
  if (isset($_POST['metaData'])){
    if ($_POST['metaData'] === 'meta') {
      $metaOuData = false;
    }
    else if ($_POST['metaData'] === 'data'){
      $metaOuData = true;
      $dataFim = $_POST['anoF'].'-'.$_POST['mesF'].'-'.$_POST['diaF'];
    }
  }

  

  $materialDoacao = $_POST['materialDoacao'];
  $quantidade = $_POST['quantidadeMaterial'];

  $agradecimento = $_POST['agradecimento'];

  $titulo = $_POST['titulo'];
  $valores = array();
  
  if(isset($_POST['valor1'])){
    $valorMeta = $_POST['metaMonetaria'];
    $valores[0] = $_POST['valor1'];
    $valores[1] = $_POST['valor2'];
    $valores[2] = $_POST['valor3'];
  }
$imagem = "default";
  $idCampanha = CriadorFacade::getInstance()->criarCampanha($nomeCampanha, $descricao, $dataInicio, $imagem, $cpf, $metaOuData, $dataFim, $agradecimento, $titulo, $valores, $categoria);
  


  $materialMonetaria = "";

  if(!isset($_POST['materialMonetaria'])){
    if ($_POST['materialMonetaria'] === 'monetaria') {
      $materialMonetaria = "monetaria";
      CriadorFacade::getInstance()->cadastrarMetaMaterial($idCampanha, 0, $valorMeta);
    }
    elseif ($_POST['materialMonetaria'] === "material"){
      $materialMonetaria = "material";
      #verificando se foram adicionados materiais nao cadastrados
      if (isset($_POST['nomeMaterial'])) {
        $nomeMaterial = $_POST['nomeMaterial'];
        $medidaMaterial = $_POST['medidaMaterial'];
        if($metaOuData){ #por Meta
          $qtd = $_POST['quantidadeMaterial'];
          for ($i = 0; $i < $nomeMaterial.length; $i++) { #cadastrando material com quantidade na meta #$idCampanha, $codMaterial, $qtd
            $codMaterial = CriadorFacade::getInstance()->cadastrarMaterial($nomeMaterial[$i], $medidaMaterial[$i]);
            CriadorFacade::getInstance()->cadastrarMetaMaterial($idCampanha, $codMaterial, $qtd[$i]);
          }
        }
        else{
          for ($i = 0; $i < $nomeMaterial.length; $i++) { #por data #$idCampanha, $codMaterial, $qtd
            $codMaterial = CriadorFacade::getInstance()->cadastrarMaterial($nomeMaterial[$i], $medidaMaterial[$i]);
            CriadorFacade::getInstance()->cadastrarMetaMaterial($idCampanha, $codMaterial, 0);
          }
        }
      }
      #verificando se foram adicionados materiais cadastrados
      if(isset($_POST['materialDoacao'])){
        $materialDoacao = $_POST['materialDoacao'];
        

        if($metaOuData){#por meta
          $qtdMaterial = $_POST['quantidadeMaterial'];
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


    if(isset($_POST['endereco'])){
      $endereco = $_POST['endereco'];
      for ($i = 0; $i < count($endereco); $i++) { 
        CriadorFacade::getInstance()->cadastrarEndereco($idCampanha, $endereco[i]);
      }
    }


  }
  $campanha = CriadorFacade::getInstance()->buscarCampanha($idCampanha);


?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php 
  if(!is_null($idCampanha)){
    ?>

  <script type="text/javascript">
    window.location="http://campanha.php?campanha=<?php echo $idCampanha;?>";
  </script>
  <?php

  }
  else{
    ?>
    <script type="text/javascript">
      confirm("Não foi possível criar a campanha!");
      window.history.back();
    </script>  
  <?php
  }
?>



</body>
</html>