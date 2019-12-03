
function init()
{
    let d = new Date()
    d = d.getFullYear() + "-" + String(d.getMonth()+1).padStart(2,'0') + "-" + String(d.getDate()).padStart(2,'0')   
    r = getJSON("../api/aula/checar.php?" + d + "&" + location.href.split("?")[1])[0].resp
    document.getElementById("btncad").href += "?"+ location.href.split("?")[1]
    $('#pesq').bind("keyup", pesquisar)
    if (r == 1)
    {
        document.getElementById("btncad").style.display = "none"
        document.getElementById("pesq2").style.setProperty("grid-template-columns", "auto auto", "important")
        
    }
    ler()
}
function montar()
{
    let t = ""
    ths = "nome,data,observação,Ações".split(",")
    for (let i of ths)
    t += "<label class='th'>" + i.toUpperCase() +  "</label>"
    for (let i of lista)
    {
        t += "<label class=' first'>" + i.nome + "</label>"
        t += "<label>" + formatarData(i.data) + "</label>"
        t += "<label>" + i.obs + "</label>"
        t += "<div class='direita2 last'>"
        t += "<a href='aulaVer.php?" + i.id + "&" + location.href.split("?")[1] + "'>Ver</a>"
        t += "<a href='aulaEdit.php?" + i.id + "&" + location.href.split("?")[1] +"'>Editar</a>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t
}
function ler()
{
    lista = getJSON("../api/aula/listSimples.php?1&" + location.href.split("?")[1])
    montar()
}
function pesquisar()
{
    let d1 = document.getElementById("d1").value
    let d2 = document.getElementById("d2").value
    if (d1 == "" && d2 == "")
    {
        ler()
        return
    }
    lista = getJSON("../api/aula/pesq.php?" + d1 + "&" + d2 + "&1&" + location.href.split("?")[1])
    montar()
}
function mudarPesqPlaceholder(e)
{
    document.getElementById("pesq").placeholder = "Pesquisar por " + e.target[e.target.selectedIndex].innerText
}