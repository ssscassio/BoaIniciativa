 <?php 
 require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."facade/CriadorFacade.php");

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."model/Campanha.php");

require_once($_SERVER["DOCUMENT_ROOT"]."/BoaIniciativaV3/"."database/CampanhaDAO.php");


 $campanha = new Campanha(null, "nome", "descricao", date("d-m-Y"), 'default', "83802223500", true, date("d-m-Y"));
$campanha->setTituloAgradecimento("titulo");
$campanha->setAgradecimento("agradecimento");
  print "========= campanha direto foi<pre>";
 var_dump($campanha);
 print "<pre>=========";



 $id = CampanhaDAO::getInstance()->adicionarCampanha($campanha);
  print "========= campanha dao id<pre>";
 var_dump($id);
 print "<pre>=========";

 print "========= campanha dao<pre>";
 var_dump(CampanhaDAO::getInstance()->buscarCampanha($id));
 print "<pre>=========";

 ?>