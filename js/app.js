window.onload = function () {
    var verificarAlertasBtn = document.getElementById("verificarAlertas");
    var contatarEmergenciaBtn = document.getElementById("contatarEmergencia");
    var chatBairroBtn = document.getElementById("chatBairro");
    var contribuicoesBtn = document.getElementById("contribuicoes");
    var btnPix = document.getElementById("btnPix");
    var btnInvista = document.getElementById("btnInvista");
    var btnSugestoes = document.getElementById("btnSugestoes");

    if (verificarAlertasBtn) {
        verificarAlertasBtn.classList.add("btn");
        verificarAlertasBtn.onclick = function () {
            window.location.href = "post";
        };
    }

    if (contatarEmergenciaBtn) {
        contatarEmergenciaBtn.classList.add("btn");
        contatarEmergenciaBtn.onclick = function () {
            window.location.href = "contatar_emergencia.html";
        };
    }

    if (chatBairroBtn) {
        chatBairroBtn.classList.add("btn");
        chatBairroBtn.onclick = function () {
            window.location.href = "chat_bairro.html";
        };
    }

    if (contribuicoesBtn) {
        contribuicoesBtn.classList.add("btn");
        contribuicoesBtn.onclick = function () {
            window.location.href = "contribuicoes.html";
        };
    }

    if (btnPix) {
        btnPix.onclick = function () {
            console.log("Clicou em Pix");
            window.location.href = "pix.html";
        };
    }

    if (btnInvista) {
        btnInvista.onclick = function () {
            console.log("Clicou em Invista");
            window.location.href = "invista.html";
        };
    }

    if (btnSugestoes) {
        btnSugestoes.onclick = function () {
            console.log("Clicou em Sugestões");
            window.location.href = "sugestoes.html";
        };
    }
};
