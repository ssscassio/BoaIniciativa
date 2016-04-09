<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Pagina da campanha</title>
  </head>
  <body>
    <form method="post" action="rotas.php">
      <input type="number" require="require" name="cpfUsuario" placeholder="CPF do Usuario">
      <input type="text" require="require" name="idCampanha" pattern="[0-9]+$" placeholder="Id da campanha para doar">
      <input type="submit" name="doarCampanha" value="Doar">
    </form>
  </body>
</html>
