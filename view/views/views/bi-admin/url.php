<?php
//a variavel atual, vai receber o que estiver na variável pag
//se não tiver nada, ela recebe o valor: principal“”
$atual = (isset($_GET['isw'])) ? $_GET['isw'] : 'principal';

//aqui setamos um diretório onde ficarão as páginas internas do site
$pasta = $_SERVER["DOCUMENT_ROOT"]."/BoaIniciativa/BoaIniciativaV2/"."view/views/bi-admin";

//vamos testar se a variável pag possui alguma “/”
//ou seja, caso a url seja: /noticia/2
if (substr_count($atual, '/') > 0) {
	//utilizamos o explode para separar os valores depois de cada “/”
	$atual = explode('/', $atual);
	/*testamos se depois do endereço do site, o valor da página é um arquivo existente
	caso não exista, iremos atribuir o valor “erro” que será uma página de erro
	 personalizada que existirá dentro da pasta '$pasta', esse arquivo será incluido sempre que um endereço invalido for digitado */
	$pagina = (file_exists("{$pasta}/" . $atual[0] . '.php')) ? $atual[0] : 'erro';
	//ao que tiver depois da segunda “/” atribuiremos a variavel $id
	$id = $atual[1];
	//ao que tiver depois da terceira “/” atribuiremos a variavel $busca
	$busca = @$atual[2];

} else {

	$pagina = (file_exists("{$pasta}/" . $atual . '.php')) ? $atual : 'erro';
	$id = 0;
	$frame=0;

}

?>
