window.onload = function() {
    var verificarAlertasBtn = document.getElementById("verificarAlertas");
    var contatarEmergenciaBtn = document.getElementById("contatarEmergencia");
    var chatBairroBtn = document.getElementById("chatBairro");
    var contribuicoesBtn = document.getElementById("contribuicoes");
  
    verificarAlertasBtn.classList.add("btn");
    contatarEmergenciaBtn.classList.add("btn");
    chatBairroBtn.classList.add("btn");
    contribuicoesBtn.classList.add("btn");
  
    verificarAlertasBtn.onclick = function() {
      window.location.href = "post";
    };
  
    contatarEmergenciaBtn.onclick = function() {
      window.location.href = "contatar_emergencia.html";
    };
  
    chatBairroBtn.onclick = function() {
      window.location.href = "chat_bairro.html";
    };
  
    contribuicoesBtn.onclick = function() {
      window.location.href = "contribuicoes.html";
    };
  };
  