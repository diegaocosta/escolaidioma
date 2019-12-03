let iduser
function logar()
{
    if (checarVazio(["nome", "senha"]))
    r = getJSON("../api/usuario/login.php?" + document.getElementById("nome").value + "&" + btoa(document.getElementById("senha").value))[0].r
    switch(parseInt(r))
    {
        case 0: alert("Usuário Inexistente"); break;
        case 1: alert("Senha incorreta"); break;
        case 2: location.href = "../api/usuario/logar.php?" + document.getElementById("nome").value; break;
    }
}
function registrar()
{
    location.href = "userCad.php"
}
function click(e)
{
    console.log(e.keyCode)
    if (e.keyCode == 13)
        logar()
}
function init()
{
    $('#cpf').bind('keypress', validarInteiro);
    $('#cpf').bind('keypress', checarCpf);
    $('#cpf').mask('999.999.999-99');
    document.getElementById("senha").addEventListener("keydown", function(event){click(event)})
    document.getElementById("nome").addEventListener("keydown", function(event){click(event)})
}
function trocar()
{    
    let s1 = document.getElementById("senha1").value
    let s2 = document.getElementById("senha2").value
    if (checarVazio("senha1,senha2".split(",")))
    {
        if (s1 == s2)
            location.href = "../api/usuario/trocarSenha.php?" + iduser + "&" + s1
        else
        {
            alert("As senhas informadas\nnão são as mesmas.")
            return
        }
    }
}
function checarCpf()
{
    let cpf = document.getElementById("cpf").value
    if (cpf.length == 14)
    {
        let usuarionome = document.getElementById("usuarionome").value
        let resp = getJSON("../api/usuario/checarUsuario.php?" + usuarionome + "&" + cpf)[0].resp       

        if (resp != 0)
        {
            iduser = resp
            let s1 = document.getElementById("senha1")
            let s2 = document.getElementById("senha2")
            s1.disabled = ""
            s2.disabled = ""
        }
        else
        {
            alert("Não há nenhum usuário com\neste CPF no sistema.")
            return
        }
    }
    console.log(cpf)
}