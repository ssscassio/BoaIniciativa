$(document).ready(function(){


  $("#cpflogin").on("input", function(){
    if($("#cpflogin").val() == ""){
      $('#cpfloginerror').fadeOut();
    }else{
      var verificacao = validarCPF($("#cpflogin").val());
      if(!verificacao){
        $('#cpfloginerror').html("<div class='alert alert-danger'> CPF Inválido! </div>");
        $('#cpfloginerror').fadeIn();
      }else{
        $('#cpfloginerror').html("<div class='alert alert-success'> CPF válido! </div>");
        $('#cpfloginerror').fadeIn();
        $('#cpfloginerror').fadeOut(1500);
      }
    }
  });



  $('#formlogin').submit(function(){
     var valido = true;
     var cpf = $('#cpflogin').val();
     var senha = $('#senhalogin').val();
     if(cpf == ""){
       $('#cpfloginerror').html("<div class='alert alert-warning'> Digite o CPF! </div>");
       $('#cpfloginerror').fadeIn();
       $('#cpfloginerror').fadeOut(2000);
       valido = false;
     }else{
       valido = validarCPF(cpf);
     }

     if(senha == ""){
       $('#senhaloginerror').html("<div class='alert alert-warning'> Digite a Senha! </div>");
       $('#senhaloginerror').fadeIn();
       $('#senhaloginerror').fadeOut(2000);

       valido = false;
     }

     if(valido){//Caso os dados estejam corretos, ir para a pagina de validação
       $.ajax({
         url: "../views/rotas.php",
         type: 'POST',
         data: { cpf: cpf, senha: senha, botaoLogar: "botaoLogar"},
         dataType : "json",
         success: function(data){
           var mensagem = data.mensagem;
           $('#loginerror').html(mensagem);
           if(data.atualiza){
             location.href="../views/home.php";
           }
         }
       });
     }

    return false;


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
