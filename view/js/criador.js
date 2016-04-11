$(document).ready(function(){

  $("#criador").show();
  $("#criarcampanha").hide();
  $("#campativa").hide();
  $("#campfinalizada").hide();
  $("#todascamp").hide();


  $("#botaocriarCampanha").click(function(){
    $("#criador").hide();
    $("#criarcampanha").show();
    $("#campativa").hide();
    $("#campfinalizada").hide();
    $("#todascamp").hide();

  });

  $("#botaocampanhasAtivas").click(function(){
    $("#criador").hide();
    $("#criarcampanha").hide();
    $("#campativa").show();
    $("#campfinalizada").hide();
    $("#todascamp").hide();

  });

  $("#botaocampanhasFinalizadas").click(function(){
    $("#criador").hide();
    $("#criarcampanha").hide();
    $("#campativa").hide();
    $("#campfinalizada").show();
    $("#todascamp").hide();

  });

  $("#botaotodasCampanhas").click(function(){
    $("#criador").hide();
    $("#criarcampanha").hide();
    $("#campativa").hide();
    $("#campfinalizada").hide();
    $("#todascamp").show();

  });

});
