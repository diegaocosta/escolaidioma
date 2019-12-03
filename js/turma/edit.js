let mate = [], aux = [], news = [], aux2 = [], aux3 = []
function enviar()
{
    if (document.getElementById("nome").value != ""  && document.getElementById("idcurso").selectedIndex != 0 && document.getElementById("idfun").selectedIndex != 0)
    {        
        document.form.submit() 
    }
}
function voltar()
{
    location.href = "turmaList.php"
}
function init()
{
    ler()
    montarDias()
}
function montarDias()
{
    let t = "", n = "Segunda,Terça,Quarta,Quinta,Sexta".split(","),c = 0
    for (let i of n)
        t += "<div><label>" + ((el["semana"].charAt(c++) == 1) ? "X " : " ") + i + "</label></div>"
    document.getElementById("dias").innerHTML = t

}
function ler()
{
    montarLista(getJSON("../api/curso/listSimples.php?1"), "idcurso", "Curso")
    montarLista(getJSON("../api/fun/listEsp.php?1"), "idfun", "Professor")
    el = getJSON("../api/turma/ver.php?" + location.href.split("?")[1])[0]
    document.form.action += "?" + el["id"]
    document.getElementById("status").selectedIndex = parseInt(el["status"])
    l = Object.keys(el)
    l.splice(0, 1)
    l.pop()
    for (let i of l)
        document.getElementById(i).value = el[i]
        
}
function montarLista(a, id, n)
{
    let t = "<option value='0'>" + n + "</option>"
    for (let i of a)
        t += "<option value='" + i.id + "'>" + i.nome + "</option>"
    document.getElementById(id).innerHTML = t
}