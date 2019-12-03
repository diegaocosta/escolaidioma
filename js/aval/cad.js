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
    location.href = "avalList.php?" + location.href.split("?")[1]
}
function init()
{
    el =   getJSON("../api/turma/ver.php?" + location.href.split("?")[1])[0]
    alunos =   getJSON("../api/matricula/listEsp.php?" + location.href.split("?")[1])
    montarLista()
    document.getElementById("idturma").value = el.id
    document.getElementById("turmanome").value = el.nome
    let d = new Date()
    document.getElementById("data").value = d.getFullYear() + "-" + String(d.getMonth()+1).padStart(2,'0') + "-" + String(d.getDate()).padStart(2,'0')   
    getNotas()
}
function checarValor(id)
{
    v = parseFloat(document.getElementById(id).value.replace(',',"."))
    if (v > 10)
        document.getElementById(id).value = ''
}
function montarLista()
{
    let t = "", c = 0
    for (let i of alunos)
        t += "<label>" + i.nome + "</label><input type='text' id='i" + c + "' placeholder='Nota de " + i.nome +"' maxlength='5' onkeyup='checarValor(\"i" + c++ + "\")'>"
    document.getElementById("lista").innerHTML = t
    c = 0
    for (let i of alunos)
    {      
        t = "#i" + c++ 
        $(t).bind('keypress', validarDecimal);
        $(t).mask("#9,99", {reverse: true})
    }
}
function getNotas()
{
    let r = getJSON("../api/aval/sumNotas.php?"+ location.href.split("?")[1])[0].resp
    let p = parseInt((r == "") ? 0 : r)
    document.getElementById("peso").value = 100 - p
    console.log(p)
}