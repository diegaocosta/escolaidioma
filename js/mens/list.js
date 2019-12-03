let aux
function init()
{
    ler()
}
function montar()
{
    let t = ""
    ths = "Aluno,Curso,Curso Pago,Mate. Pago,Ações".split(",")
    for (let i of ths)
    t += "<label class='th'>" + i.toUpperCase() +  "</label>"
    for (let i of lista)
    {
        t += "<label class=' first'>" + i.aluno + "</label>"
        t += "<label>" + i.curso + "</label>"
        t += "<label>" + i.cursopag + "</label>"
        t += "<label>" + i.matepag + "</label>"
        t += "<div class='direita last'>"
        t += "<a href='matVer.php?" + i.id + "'>Ver</a>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t
}
function ler()
{
    lista = getJSON("../api/matricula/list.php")
    montar()
}
function pesquisar()
{
    aux = []
    let p = document.getElementById("alunonome").value.toLowerCase()
    for (let i of alunos)
        if (i.aluno.toLowerCase().indexOf(p) != -1)
            aux.push(i)
    montarAlunos(aux)
}
function montarAlunos(a)
{    
    let t = ""
    for (let i of a)
        t += "<div><label><input type='radio' name='radio' value='" + i.id + "'>" + i.aluno +"</label></div>"
    document.getElementById("listaalunos").innerHTML = t
}
function ver()
{
    let total = 0
    for (let i of document.getElementsByName("radio"))
        if (i.checked)
            location.href = "pagList.php?" + i.value
        else
            total++
    if (total == document.getElementsByName("radio").length)
    {
        alert("Pelo menos um aluno\ndeve ser selecionado.")
        return
    }
}