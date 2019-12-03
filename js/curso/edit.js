let mate = [], aux = [], news = [], aux2 = [], aux3 = []
function enviar()
{
    let t = ""
    if (checarVazio("nome,valor,totaldemes,multa".split(",")))
    {
        for (let i of news)
        {
            if(t != "") t += ","
            t += i.id
        }
        document.getElementById("matelist").value = t
        document.form.submit()
    }
}
function voltar()
{
    location.href = "cursoList.php"
}
function init()
{
    ler()
    $('#nome').bind('keypress', validarTexto);
    $('#cargahoraria').bind('keypress', validarInteiro);
    $('#valor').bind('keypress', validarDecimal);
    $("#valor").mask("#####9,99", {reverse: true})
    
    mate = getJSON("../api/mate/listSimples.php?1")
    aux2 = getJSON("../api/matecurso/listSimples.php?" + location.href.split("?")[1])

    for (let i = 0; i < aux2.length; i++) 
        for (let j = 0; j < mate.length; j++) 
            if (mate[j].nome == aux2[i].nome)
            {
                mate.splice(j,1)
                continue
            }

    aux = mate
    news = aux2
    montarNew()
    montarMate(aux)
}
function ler()
{
    el = getJSON("../api/curso/ver.php?" + location.href.split("?")[1])[0]
    document.form.action += "?" + el["id"]
    document.getElementById("status").selectedIndex = parseInt(el["status"])
    l = Object.keys(el)
    l.splice(0, 1)
    l.pop()
    for (let i of l)
        document.getElementById(i).value = el[i]
    document.getElementById("valor").value = document.getElementById("valor").value.replace(".",",")
    document.getElementById("multa").value = document.getElementById("multa").value.replace(".",",")
}
function montarMate(m)
{
    console.log(m)
    let t = "", c = 0
    for (let i of m)
        t += "<div>" + i.nome + "</div><img src='../recursos/plus.png' alt='' onclick='add(" + c++ + ")'>"
    document.getElementById("lista1").innerHTML = t
}
function montarNew()
{
    console.log(news)
    let t = "", c = 0
    for (let i of news)
        t += "<div>" + i.nome + "</div><img src='../recursos/minus.png' alt='' onclick='remove(" + c++ + ")'>"
    document.getElementById("lista2").innerHTML = t
}
function add(num)
{
    news.push(aux[num])
    aux.splice(num,1)
    montarMate(aux)   
    montarNew()
}
function remove(num)
{
    aux.push(news[num])
    news.splice(num,1)
    montarMate(aux)   
    montarNew()
}
function pesquisar()
{
    let pesq = document.getElementById("pesqcampo").value.toLowerCase()
    console.log(document.getElementById("pesqcampo").value)
    let a1 = []
    if (pesq != "")
    {
        for (let i of mate)
            if (i.nome.toLowerCase().indexOf(pesq) != -1)
                a1.push(i)
        aux = a1
    }
    else
        aux = mate
    montarMate(aux)  
    console.log(aux) 
}