
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
        t += "<a href='turmaMontar.php?" + i.id + "'>Montar</a>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t
}
function ler()
{
    lista = getJSON("../api/turma/listSimples.php?" + document.getElementById("status").selectedIndex)
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
function gerarPdf()
{
    let s = "Desativados,Ativo,Todos,Finalizados,Cancelados".split(",")
    let d = new Date()
    d = d.getDate() + " de " + getMesNome(parseInt(d.getMonth())) + " de " + d.getFullYear()

    let array = []
    array.push([{style: "th", text: "Turma"},
    {style: ["th"], text: "Curso"},
    {style: ["th"], text: "Professor"},
    {style: ["th"], text: "Dias da Semana"},
    {style: ["th"], text: "Situação"}])

    for (let i of lista)
        array.push(
            [i.turma, i.curso, i.professor, i.semana, s[parseInt(i.status)]]
        )

    let comeco = [
        {
            text: "Relatório de Alunos Matriculados", style: "header"
        },
        {
            text: ["Data: ", d], style: "header", fontSize: 14
        },
        {
            text: ["Mostrando: ", s[parseInt(document.getElementById("status").value)]], style: "header", fontSize: 14
        }
    ]
    let estilos = {
        th: {
            alignment: 'center',
            color: "white",
            fillColor: "#4e73df",
            fontSize: 12
        },
        header: {
            bold: true,
            fontSize: 18,
            alignment: "center",
            margin: [0, 10, 0, 5]
        }
    }
    tabela = {
        table:
        {
            widths: ["*", "*","*","*", 60],
            body: array
        }
    }
    montarPdf(comeco, tabela, estilos)
}