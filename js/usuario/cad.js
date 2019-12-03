let lista, idfunc = 0
function init()
{

}
function enviar()
{
    let s1 = document.getElementById("senha").value
    let s2 = document.getElementById("senha1").value
    if (checarVazio("login,senha,senha1".split(',')) && idfunc != 0)
        if (s1 == s2)
            document.form.submit()
        else
        {
            alert("As duas senhas devem\nser iguais.")
            return
        }
}
function buscar()
{
    let pesq =  document.getElementById("nome").value
    if (pesq == "")
    {
        alert("É preciso informar ao menos\num funcionário.")
        return
    }
    resp = getJSON("../api/fun/ver2.php?" + pesq)[0]
    if (resp.nome == 0)
    {
        alert("Este funcionário já possui conta")
        return
    }
    else
    {
        document.getElementById("nomefun").value = resp.nome
        document.getElementById("cargofun").value = (resp.cargo == 1) ? "Secretaria" : "Professor" 
        document.getElementById("cargoid").value = resp.cargo 
        document.form.action = "../api/usuario/cad.php?" + resp.id
        idfunc = resp.id
    }
}
function voltar()
{
    location.href = "userList.php"
}