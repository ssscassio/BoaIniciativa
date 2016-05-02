$(document).ready(function(){
  $('#formDenuncia').hide();

  $('#botaoDenunciar').click(function(){
      $('#formDenuncia').show();
  });

  $('#valor1').click( function(){
    alert("clicou");
    $('#valorDoado').text($(this).val());
  });

  $('#valordoado').on("input", function(){
    $("#paypalvalue").val($('#valordoado').val());

  })
})
