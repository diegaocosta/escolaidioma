
function init()
{
    nomes="Turma,Professor,Curso".split(",")
    t = ""
    for (let i = 0; i < nomes.length; i++) 
        t += "<option value="+ i + ">" + nomes[i] + "</option>"
    document.getElementById("tipo").innerHTML = t
    $('#pesq').bind("keyup", pesquisar)
    document.getElementById("status").selectedIndex = 1
    document.getElementById("status").addEventListener("change", function(){ler()})
    ler()
}
function montar()
{
    let t = ""
    ths = "Turma,Professor,Curso,Dias de Aula,Ações".split(",")
    for (let i of ths)
    t += "<label class='th'>" + i.toUpperCase() +  "</label>"
    for (let i of lista)
    {
        t += "<label class=' first'>" + i.turma + "</label>"
        t += "<label>" + i.professor + "</label>"
        t += "<label>" + i.curso + "</label>"
        t += "<label>" + i.semana + "</label>"
        t += "<div class='direita2 last'>"
        t += "<a href='turmaVer.php?" + i.id + "'>Ver</a>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t
}
function ler()
{
    lista = getJSON("../api/turma/listEsp.php?" + usernome + "&" + document.getElementById("status").selectedIndex)
    montar()
}
function pesquisar()
{
    let p = document.getElementById("pesq").value
    let tipo = document.getElementById("tipo").selectedIndex
    lista = getJSON("../api/turma/pesq.php?" + p + "&" + tipo + "&" + document.getElementById("status").selectedIndex)
    montar()
}
function mudarPesqPlaceholder(e)
{
    document.getElementById("pesq").placeholder = "Pesquisar por " + e.target[e.target.selectedIndex].innerText
}