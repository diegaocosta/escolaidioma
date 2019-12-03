let news = []
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
    $('#totaldemes').bind('keypress', validarInteiro);
    $('#valor').bind('keypress', validarDecimal);
    $("#valor").mask("#####9,99", {reverse: true})
    mate = getJSON("../api/mate/listSimples.php?1")
    aux = mate
    montarMate(aux)
}
function montarMate(m)
{
    let t = "", c = 0
    for (let i of m)
        t += "<div>" + i.nome + "</div><img src='../recursos/plus.png' alt='' onclick='add(" + c++ + ")'>"
    document.getElementById("lista1").innerHTML = t
}
function montarNew()
{
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