$(document).ready(function(){

  $("#cpfUsuario").on("input", function(){
    if($("#cpfUsuario").val() == ""){
      $('#cpfUsuarioerror').fadeOut();
    }else{
      var verificacao = validarCPF($("#cpfUsuario").val());
      if(!verificacao){
        $('#cpfUsuarioerror').html("<div class='alert alert-danger'> CPF Inválido! </div>");
        $('#cpfUsuarioerror').fadeIn();
      }else{
        $('#cpfUsuarioerror').html("<div class='alert alert-success'> CPF válido! </div>");
        $('#cpfUsuarioerror').fadeIn();
        $('#cpfUsuarioerror').fadeOut(1500);
      }
    }
  });


    $('#botaoVerDoacoes').click(function(){
      document.formVerDoacoes.submit();
    });

    $("#SelecaoMateriais").hide();

    $( "[name=doacao]" ).on( "click", function(){
       $('#doacaoId').val($(this).val());
       $('#doacaoTitle').html("<strong> Doacao de Id: "+ $(this).val()+"</strong>")
       $("#SelecaoMateriais").show();
    });


    $('#mais').click(function(){
      const opcoes = '<?php echo $opcoes; ?>';
      console.log(opcoes);
      //recuperando o próximo numero da linha
      var next = $('#lista tbody').children('tr').length + 1;

      //inserindo formulário
      $('#lista tbody').append('<tr>' +
      '<td><select name="material'+ next +'">'+$('[name=material1]').html()+'</select></td>' +
      '<td><input type="number" required name="quantidade' + next + '" /></td>' +
      '</tr>');

      //armazenando a quantidade de linhas ou registros no elemento hidden
      $('#quantidade_itens').val(next);

      return false;
    });

    $('#enviar').click(function(){
      $('#confirmarDoacao').submit();
    });

});

function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g,'');
    if(cpf == '') return false;
    // Elimina CPFs invalidos conhecidos
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
            return false;
    // Valida 1o digito
    add = 0;
    for (i=0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;
    // Valida 2o digito
    add = 0;
    for (i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
    return true;
}
