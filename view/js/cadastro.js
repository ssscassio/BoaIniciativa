$(document).ready(function(){


  $("#cadastrar").click(function(){
  var valido = true;

  function verificarSenhasIguais(senha, repetirsenha){
    if ( repetirsenha === senha){
      $('#senhacadastroerror').empty();
      $('#senhacadastroerror').html('<p class="alert alert-success">Senhas conferem</p>');
      $('#senhacadastroerror').fadeOut(1500);
      return true;
    } else {
      $('#senhacadastroerror').empty();
      $('#senhacadastroerror').html('<p class="alert alert-warning" >Senhas não conferem</p>');
      return false;
    }
  }

  $('#repetirsenhacadastro').on('input', function(){
     var senha = $('#senhacadastro').val();
     var repetirsenha = $(this).val();
     verificarSenhasIguais(senha,repetirsenha);
   });

   $('#senhacadastro').on('input', function(){
      var repetirsenha = $('#repetirsenhacadastro').val();
      var senha = $(this).val();
      verificarSenhasIguais(senha,repetirsenha);
    });



   function verificarCamposVazios(IDCampo, IDerror, mensagem) {
        var val = $.trim($(IDCampo).val());
        if (val.length == 0) {
          $(IDerror).html('<p class="alert alert-danger">'+ mensagem + '</p>');
          $(IDerror).fadeIn();
          valido = false;
        }else{
          $(IDerror).fadeOut(300);
        }
      }

    verificarCamposVazios('#nomecadastro','#nomecadastroerror','Insira seu Nome e Sobrenome');
    verificarCamposVazios('#cpfcadastro','#cpfcadastroerror','Insira seu CPF');
    verificarCamposVazios('#senhacadastro','#senhacadastroerror','Insira sua Senha');
    verificarCamposVazios('#repetirsenhacadastro','#repetirsenhacadastroerror','Repita sua Senha');
    verificarCamposVazios('#emailcadastro','#emailcadastroerror','Digite seu email');
    verificarCamposVazios('#nascimentocadastro','#nascimentocadastroerror','Informe sua data de nascimento');

    if(!verifircarSenhasIguais($('#senhacadastro').val(),$('#repetirsenhacadastro').val())){
      valido = false;
    }

  });




  $("#cpfcadastro").on("input", function(){
    if($("#cpfcadastro").val() == ""){
      $('#cpfcadastroerror').fadeOut();
    }else{
      var verificacao = validarCPF($("#cpfcadastro").val());
      if(!verificacao){
        $('#cpfcadastroerror').html("<div class='alert alert-danger'> CPF Inválido! </div>");
        $('#cpfcadastroerror').fadeIn();
      }else{
        $('#cpfcadastroerror').html("<div class='alert alert-success'> CPF válido! </div>");
        $('#cpfcadastroerror').fadeIn();
        $('#cpfcadastroerror').fadeOut(1500);
      }
    }
  });

  $("#senhacadastro").on("input", function(){
    var forca = verificaSenha('senhacadastro');
    var colorStyle = verificaColorSenha(forca);
    if($("#senhacadastro").val() == ""){
      $('#senhaforca').fadeOut(300);
    }else{
      $('#senhaforca').html("<div class='progress'><div class='progress-bar "+colorStyle+"' role='progressbar' aria-valuenow='"+forca+"' aria-valuemin='0' aria-valuemax='100' style='width:"+forca+"%'></div></div>");
      $('#senhaforca').fadeIn();
    }
  });
});

function getLatitude(){
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
      return position.coords.latitude;
    });
    }
}

function getLongitude(){
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
    return position.coords.longitude;
  });
  }
}

function verificaSenha(tiposenha){
  senha = document.getElementById(tiposenha).value;
	var forca = 0;
	if((senha.length >= 4) && (senha.length <= 7)){
		forca += 10;
	}else if(senha.length>7){
		forca += 25;
	}
	if(senha.match(/[a-z]+/)){
		forca += 10;
	}
	if(senha.match(/[A-Z]+/)){
		forca += 20;
	}
	if(senha.match(/d+/)){
		forca += 20;
	}
	if(senha.match(/W+/)){
		forca += 25;
	}
  return forca;
}

function verificaColorSenha(forca){
  var classColor;
  if(forca  <= 0){
    classColor = "progress-bar-danger";
  }else if( forca <70){
    classColor = "progress-bar-warning";
  }else{
      classColor = "progress-bar-success";
  }
  return classColor;
}


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
