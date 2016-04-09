<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Pesquise por uma campanha</title>
  </head>
  <body>


    <form action="resultadoPesquisa.php?" method="GET"> <!-- action é o arquivo q vai fazer a pesquisa-->
          <label for="consulta">Procurar campanhas:  </label>
          <input type="hidden" name="pagina" value="1" />
         <input type="search" maxlength="255"  name="campanhas" autocomplete="on"></input>
         <input type="submit" ></input>
</form>
   
  </body>
</html>