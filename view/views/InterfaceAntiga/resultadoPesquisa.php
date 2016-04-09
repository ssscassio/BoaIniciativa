 <?php 

	require_once('../../facade/LucasUsuarioFacade.php');
	/* to fazendo isso aq pra ver se ele nao ta buscando pq nao tem nada cadastrado e copiar e colar
	é mais fácil do que pensar */
	require_once('../../database/TagCampanhaDAO.php');
	require_once('../../database/TagDAO.php');
	require_once('../../database/UsuarioDAO.php');


	/********* LISTAR CAMPANHAS*************/
	$listaCampanhas = array();
	$listaCampanhas = CampanhaDAO::getInstance()->listarCampanhas();
/*

	print "lista de campanhas cadastradas <br><br>";
	print "<pre>===============\n";
		var_dump($listaCampanhas);
	print "===================</pre>";

*/

	$totalCampanhasNaPagina = 4;
	$pagina = $_GET['pagina'];
	if (!$pagina){
		$pc = "1";
	}
	else{
		$pc = $pagina;
	}

	print "pc: $pc<br>";
	print "pagina: $pagina<br>";
	//determinando o valor inicial das buscas
	$inicio = $pc - 1;
	$inicio = $inicio * $totalCampanhasNaPagina;

	print "inicio: $inicio<br>";
	$tagPesquisada = $_GET['tag'];
	print "TagPesquisada: $tagPesquisada<br><br>";
	//pegando total de linhas e calculando total de paginas

	$campanhasNoBD = LucasUsuarioFacade::getInstance()->pesquisarCampanhasPorTag($tagPesquisada);	
	$qtdCampanhas = count($campanhasNoBD);


	$totalPaginas = $qtdCampanhas / $totalCampanhasNaPagina;

	print "totalCampanhas: $qtdCampanhas<br>";

	echo "<br>";
	print "totalPaginas: $totalPaginas<br>";
	//colocando todas as campanhas com um offset por pagina

	$campanhasPorPagina = LucasUsuarioFacade::getInstance()->buscarCampanhasParaPagina($tagPesquisada, $inicio, $totalPaginas);
	
	//colocando todas as campanhas por tag numa variavel
	
	
	print "<pre>===============================var_dump CampanhasNoBD \n";
		var_dump($campanhasNoBD);
	print "=======================================================================</pre>";
	
	$indexCampanhas = 0; 

	//criando a visualização
	
	print "total campanhas: $qtdCampanhas<br>";

	while ($qtdCampanhas > $indexCampanhas) {
		$nome = $campanhasNoBD[$indexCampanhas]->getNome(); //tentando pegar o nome de uma campanha tal

		$descricao = $campanhasNoBD[$indexCampanhas]->getDescricao(); //tentando pegar a descricao de uma campanha

		echo "Campanha: $nome <br>";
		echo "Descricao: $descricao<br>";
		$indexCampanhas += 1;
	}

	$anterior = $pc - 1;
	$proximo = $pc + 1;

	if ($pc>1){
		echo " <a href=resultadoPesquisa.php'?pagina = $anterior'>< - Anterior</a>";
	}
	echo "|";
	if ($pc<$totalPaginas){
		echo " <a href=resultadoPesquisa.php'pagina=$proximo'>Próximo -></a>";
	}



?>

