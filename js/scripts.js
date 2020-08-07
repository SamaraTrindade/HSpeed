/* global sessao */

function povoaDependentes(id, cpf) {
    document.getElementById("nomeResp").innerHTML = sessao.Nome;
    document.getElementById("cpfResp").innerHTML = sessao.CPF;
    
    $.ajax({
        method: "POST",
        url: "control/dependentes.php",
        data: { op: "listar", idResponsavel: id, cpf: cpf }
    })
    .done(function(retorno){
        var lista = document.getElementById("dependentes");

        while (lista.firstChild) {
            lista.removeChild(lista.firstChild);
        }

        if(retorno != -1) {
            var dependentes = JSON.parse(retorno);
            console.log(dependentes);
            dependentes.forEach(function (dependente) {
                var li = document.createElement("li");
                li.appendChild(document.createTextNode(dependente.nomePaciente));
                lista.appendChild(li);
            })
            
        } else {
            // ERRO
            var li = document.createElement("li");
            li.appendChild(document.createTextNode("Não foram encontrados dependentes!"));
            lista.appendChild(li);
        }
    })
    .fail(function(jqXHR, textStatus, msg){
        alert(msg);
    });
}

$(document).ready(function(){   
    $('#btnLogin').click(function() {
        var cpf = $("input[name='cpf']").val();
        var senha = $("input[name='senha']").val();

        $.ajax({
            method: "POST",
            url: "control/login.php",
            data: { cpf: cpf, senha: senha }
        })
        .done(function(retorno){
            if(retorno === '1') {
                // Faz Login
                window.location.replace("index.html");
            } else {
                // ERRO
                alert("Não foi possível fazer login, verifique sua senha!");
            }
        })
        .fail(function(jqXHR, textStatus, msg){
            alert(msg);
        });
  
    });
    
    $('#btnLogout').click(function() {
        $.ajax({
            method: "POST",
            url: "control/login.php",
            data: { cpf: null, senha: null }
        })
        .done(function(){
            // Retorna pra página inicial
            window.location.replace("login.html");
        });
    });
});
