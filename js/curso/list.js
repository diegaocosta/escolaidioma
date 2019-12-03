
function init()
{
    $('#pesq').bind("keyup", pesquisar)
    document.getElementById("status").selectedIndex = 1
    document.getElementById("status").addEventListener("change", function(){ler()})
    ler()
}
function montar()
{
    let t = ""
    ths = "Nome,Total de Meses,Valor,Ações".split(",")
    for (let i of ths)
    t += "<label class='th'>" + i.toUpperCase() +  "</label>"
    for (let i of lista)
    {
        t += "<label class=' first'>" + i.nome + "</label>"
        t += "<label>" + i.total + " meses</label>"
        t += "<label> R$ " + i.valor.replace(".",",") + "</label>"
        t += "<div class='direita last'>"
        t += "<a href='cursoVer.php?" + i.id + "'>Ver</a>"
        t += "<a href='cursoEdit.php?" + i.id + "'>Editar</a>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t
}
function ler()
{
    lista = getJSON("../api/curso/listSimples.php?" + document.getElementById("status").selectedIndex)
    montar()
}
function pesquisar()
{
    let p = document.getElementById("pesq").value
    lista = getJSON("../api/curso/pesq.php?" + p + "&" + document.getElementById("status").selectedIndex)
    montar()
}
function gerarPdf()
{
    let s = "Desativados,Ativados,Todos,".split(",")
    let s1 = "Desativado,Ativo,".split(",")
    let pesq = document.getElementById("pesq").value
    let d = new Date()
    d = d.getDate() + " de " + getMesNome(parseInt(d.getMonth())) + " de " + d.getFullYear()

    let array = []
    array.push([{style: "th", text: "Curso"},
    {style: ["th"], text: "Total de Meses"},
    {style: ["th"], text: "Preço Mensal"},
    {style: ["th"], text: "Situação"}])

    for (let i of lista)
        array.push(
            [i.nome, i.total + " meses", "R$" + i.valor.replace(".",","), s1[parseInt(i.status)]]
        )

    let comeco = [
        {
            text: "Relatório de Cursos", style: "header"
        },
        {
            text: ["Data: ", d], style: "header", fontSize: 14
        },
        {
            text: ["Mostrando: ", s[parseInt(document.getElementById("status").value)]], style: "header", fontSize: 14
        }
    ]
    if (pesq != "")
        comeco.push(
            {
                text: ["Pesquisado " + ((parseInt(document.getElementById("tipo").value) == 0) ? "Nome" : "Responsável") + " que tenham  " + pesq], style: "header", fontSize: 14
            }
        )
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
            widths: ["*", "*", 100, 60],
            body: array
        }
    }
    montarPdf(comeco, tabela, estilos)
}