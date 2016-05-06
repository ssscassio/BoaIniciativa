
  <?php
 require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/CriadorFacade.php");


  $categoria = $_POST['categoria'];
  $cpf = $_POST['cpf'];

  $nomeCampanha = $_POST['nome'];

  $descricao = $_POST['descricao'];

  $dataInicio = date("d-m-Y");
  $dataFim = null;
  if (isset($_POST['md'])){
    if ($_POST['md'] == 'data'){

      $metaOuData = TRUE;
      $dataFim = $_POST['diaF'].'-'.$_POST['mesF'].'-'.$_POST['anoF'];
    }
    else if($_POST['md'] == "meta"){
      $metaOuData = FALSE;
    }

  }



  $materialDoacao = $_POST['materialDoacao'];
  $quantidade = $_POST['quantidadeMaterial'];

  $agradecimento = $_POST['agradecimento'];

  $titulo = $_POST['titulo'];
  $valores = array();

  if(isset($_POST['valor1'])){
    $valorMeta = $_POST['metaMonetaria'];
    $valores[0] = intval($_POST['valor1']);
    $valores[1] = intval($_POST['valor2']);
    $valores[2] = intval($_POST['valor3']);
  }

  $imagem = "campanha.png";
  $idCampanha = CriadorFacade::getInstance()->criarCampanha($nomeCampanha, $descricao, $dataInicio, $imagem, $cpf, $metaOuData, $dataFim, $agradecimento, $titulo, $valores, $categoria);


  $materialMonetaria = "";

  if(isset($_POST['mm'])){
    if ($_POST['mm'] === 'monetaria') {
      $materialMonetaria = "monetaria";
      CriadorFacade::getInstance()->cadastrarMetaMaterial($idCampanha, 0, $valorMeta);
    }
    elseif ($_POST['mm'] === "material"){
      $materialMonetaria = "material";
      #verificando se foram adicionados materiais nao cadastrados
      if (isset($_POST['nomeMaterial'])) {
        $nomeMaterial = $_POST['nomeMaterial'];
        $medidaMaterial = $_POST['medidaMaterial'];
        if($_POST['md'] == "meta"){ #por Meta
          $qtd = $_POST['quantidadeMaterial'];
          for ($i = 0; $i < count($nomeMaterial); $i++) { #cadastrando material com quantidade na meta #$idCampanha, $codMaterial, $qtd
            $codMaterial = CriadorFacade::getInstance()->cadastrarMaterial($nomeMaterial[$i], $medidaMaterial[$i]);
            CriadorFacade::getInstance()->cadastrarMetaMaterial($idCampanha, $codMaterial, $qtd[$i]);
          }
        }
        else if ($_POST['md'] == "data"){ #por data
          for ($i = 0; $i < count($nomeMaterial); $i++) { #por data #$idCampanha, $codMaterial, $qtd
            $codMaterial = CriadorFacade::getInstance()->cadastrarMaterial($nomeMaterial[$i], $medidaMaterial[$i]);
            CriadorFacade::getInstance()->cadastrarMetaMaterial($idCampanha, $codMaterial, 0);
          }
        }
      }
      #verificando se foram adicionados materiais cadastrados
      if(isset($_POST['materialDoacao'])){
        $materialDoacao = $_POST['materialDoacao'];
        if($_POST['md'] == "meta"){ #por Meta
          $qtdMaterial = $_POST['quantidadeMaterial'];
          for ($i = 0; $i < count($qtdMaterial) ; $i++) {
            CriadorFacade::getInstance()->cadastrarMetaMaterial($idCampanha, $materialDoacao[$i], $qtdMaterial[$i]);
          }
        }
        else if ($_POST['md'] == "data"){ #por data
          for ($i = 0; $i < count($materialDoacao) ; $i++) {
            CriadorFacade::getInstance()->cadastrarMetaMaterial($idCampanha, $materialDoacao[$i], 0);
          }
        }
      }
    }


    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    if($cep[0] != ""){
      for ($i = 0; $i < count($cep); $i++) {
        CriadorFacade::getInstance()->cadastrarPontoCampanha($idCampanha, $cep[$i], $estado[$i], $bairro[$i], $cidade[$i], $logradouro[$i], $numero[$i], $complemento[$i]);
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
    window.location="campanha.php?campanha=<?php echo $idCampanha;?>";
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
