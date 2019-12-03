function enviar()
{
    if (checarVazio("nome,valor,editora,tipo,autor".split(",")))
        document.form.submit()
}
function voltar()
{
    location.href = "mateList.php"
}
function init()
{
    ler()
    $('#autor').bind('keypress', validarTexto);
    $('#isbn').bind('keypress', validarInteiro);
    $('#valor').bind('keypress', validarDecimal);
    $("#valor").mask("#####9,99", {reverse: true})
}
function ler()
{
    el = getJSON("../api/mate/ver.php?" + location.href.split("?")[1])[0]
    document.form.action += "?" + el["id"]
    document.getElementById("status").selectedIndex = parseInt(el["status"])
    l = Object.keys(el)
    l.splice(0, 1)
    // l.pop()
    for (let i of l)
    {
        document.getElementById(i).value = el[i]
        document.getElementById(i).disabled = true
    }
    document.getElementById("valor").value = document.getElementById("valor").value.replace(".",",")
    document.getElementById("comprado").value = document.getElementById("comprado").value.replace(".",",")
}

function gerarPdf()
{
    let d = new Date()
    d = d.getDate() + " de " + getMesNome(parseInt(d.getMonth())) + " de " + d.getFullYear()

    eldados = document.getElementsByClassName("eldados")
    

    let array = 
    [
        //linha da tabela
        [
            {
                table: 
                {
                    widths: ["*", "*"],
                    body: [[
                        criarCelula(eldados[0].innerText, el["nome"]),
                        criarCelula(eldados[1].innerText, ((el.status) ? "Ativo" : "Evadido"))
                    ]]
                },layout: "noBorders"      
            }
        ],
        [
            {
                table: 
                {
                    widths: ["*", "*"],
                    body: [[
                        criarCelula(eldados[2].innerText, el.tipo),
                        criarCelula(eldados[3].innerText, el.valor.replace(".",","))
                    ]]
                },layout: "noBorders"      
            }
        ],
        [
            {
                table: 
                {
                    widths: ["*", "*"],
                    body: [[
                        criarCelula(eldados[4].innerText, el.comprado.replace(".",",")),
                        criarCelula(eldados[5].innerText, el.total)
                    ]]
                },layout: "noBorders"      
            }
        ],
        [{table: criarLinha([[6,"editora"],[7,"autor"],[8,"isbn"]]),layout: "noBorders"}],
        [{table: criarLinha([[9,"obs"]]),layout: "noBorders"}],
        //fim da linha da tabela
    ]

    let comeco = [
        {
            text: ["Informações sobre ", el.nome], style: "header"
        },
        {
            text: ["Data: ", d], style: "header", fontSize: 14
        }
    ]
    let estilos = {
        h1:
        {
            bold: true, margin: [0,0,0,0], fontSize: 10
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
            widths: ["*"],
            body: array
        },
        layout: "noBorders"
    }
    
    montarPdf(comeco, tabela, estilos)
}
function criarLinha(str)
{
    let tamanho = str.length, contador = 0, aux = [], aux2 = []
    while (contador < tamanho)
    {
        i = str[contador]
        console.log(i)
        aux.push("*")
        aux2.push(criarCelula(eldados[i[0]].innerText, el[i[1]]))
        contador++
    }
    let t = {
        widths: aux,
        body: [aux2]
    }  
    return t
}
function criarCelula(titulo, info)
{
    return {
        table:
        {
            widths: ["*"],
            body:[[{text: titulo, style: "th"}], [{table: {widths:["*"], body: [[{text: ((info == "") ? "   " : info), fontSize: 14, margin: [3,5,3,5]}]]}}
                
                ]]
        },
        layout: "noBorders"
    } 
}