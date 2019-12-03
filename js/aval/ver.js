let frequencia = []
function enviar()
{
    t = ""
    for (let i = 0; i < alunos.length; i++) 
    {
        j = alunos[i]
        if (document.getElementById("i" + i).value == "")
        {
            alert("Campo obrigatório não preenchido.")
            return
        }
        else
        {
            if (t != "") t += ","
            t += j.id + ";" + document.getElementById("i" + i).value.replace(",",".")
        }
    }
    if (checarVazio("nome".split(",")))
    {
        document.getElementById("notas").value = t
        document.form.submit()
    }
}
function voltar()
{
    location.href = "avalList.php?" + location.href.split("?")[1].split("&")[1]
}
function init()
{
    el =   getJSON("../api/aval/ver.php?" + location.href.split("?")[1].split("&")[0])[0]
    alunos =   getJSON("../api/nota/listSimples.php?" + location.href.split("?")[1].split("&")[0])
    montarLista()
    document.getElementById("idturma").value = location.href.split("?")[1].split("&")[1]
    document.getElementById("idaval").value = location.href.split("?")[1].split("&")[0]
    document.getElementById("nome").value = el.nome
    document.getElementById("turmanome").value = el.turma
    document.getElementById("data").value = el.data
    document.getElementById("obs").value = el.obs
}
function checarValor(id)
{
    console.log(id)
    v = parseFloat(document.getElementById(id).value.replace(',',"."))
    if (v > 10)
        document.getElementById(id).value = ''
    else
    {
        pos = id.substring(1)
        alunos[pos].nota = document.getElementById(id).value.replace(',',".")
        console.log(alunos)
    }
}
function montarLista()
{
    let t = "", c = 0
    for (let i of alunos)
        t += "<label>" + i.nome + "</label><input type='text' id='i" + c + "' placeholder='Nota de " + i.nome +"' maxlength='5' readonly onblur='checarValor(\"i" + c++ + "\")' value='" + i.nota.replace(".",",") + "'>"
    document.getElementById("lista").innerHTML = t
}