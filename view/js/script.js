$(document).ready(function(){

  $("#editarPerfil").hide();
  $("#editarSenha").hide();
  $("#excluirConta").hide();


  $("#botaoEditarPerfil").click(function(){
    $("#editarPerfil").show();
    $("#editarSenha").hide();
    $("excluirConta").hide();

  });

  $("#botaoEditarSenha").click(function(){
    $("#editarPerfil").hide();
    $("#editarSenha").show();
    $("#excluirConta").hide();

  });

  $("#botaoExcluirConta").click(function(){
    $("#editarPerfil").hide();
    $("#editarSenha").hide();
    $("#excluirConta").show();

  });

});
