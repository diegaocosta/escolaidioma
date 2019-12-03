
function init()
{
    $('#pesq').bind("keyup", pesquisar)
    ler()
}
function montar()
{
    let t = ""
    ths = "Nome,Valor,Data,Ações".split(",")
    for (let i of ths)
    t += "<label class='th'>" + i.toUpperCase() +  "</label>"
    for (let i of lista)
    {
        t += "<label class=' first'>" + i.nome + "</label>"
        t += "<label> R$ " + i.valor.replace(".",",") + "</label>"
        t += "<label>" + formatarData(i.data) + "</label>"
        t += "<div class='direita last'>"
        t += "<a href='desVer.php?" + i.id + "'>Ver</a>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t
}
function ler()
{
    lista = getJSON("../api/des/listSimples.php")
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
    lista = getJSON("../api/des/pesq.php?" + d1 + "&" + d2)
    montar()
}

function gerarPdf()
{
    let d1 = document.getElementById("d1").value
    let d2 = document.getElementById("d2").value
    let d = new Date()
    d = d.getDate() + " de " + getMesNome(parseInt(d.getMonth())) + " de " + d.getFullYear()

    let array = []
    array.push([
    {style: ["th"], text: "Nome"},
    {style: ["th"], text: "Valor"},
    {style: ["th"], text: "Data"}])

    for (let i of lista)
        array.push(
            [i.nome, "R$ " + i.valor.replace(".",","), formatarData(i.data)]
        )

    let comeco = [
        {
            text: "Relatório de Despesas", style: "header"
        },
        {
            text: ["Data: ", d], style: "header", fontSize: 14
        }
    ]

    if (d1 != "" && d2 != "")
    {
        comeco.push(
            {
                text: ["Despesas entre a data " + formatarData(d1) + " e " + formatarData(d2)], style: "header", fontSize: 14
            }
        )
    }
    else
    {
        if (d1 == "" && d2 != "")
            comeco.push(
                {
                    text: ["Despesas antes da data " + formatarData(d2)], style: "header", fontSize: 14
                }
            )
        if (d2 == "" && d2 != "")
            comeco.push(
                {
                    text: ["Despesas depois da data " + formatarData(d1)], style: "header", fontSize: 14
                }
            )
    }
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
            widths: ["*", "*", 130],
            body: array
        }
    }
    montarPdf(comeco, tabela, estilos)
}