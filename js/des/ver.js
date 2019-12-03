function enviar()
{
    if (checarVazio("nome,valor,cargahoraria".split(",")))
        document.form.submit()
}
function voltar()
{
    location.href = "desList.php"
}
function init()
{
    ler()
    $('#nome').bind('keypress', validarTexto);
    $('#cargahoraria').bind('keypress', validarInteiro);
    $('#valor').bind('keypress', validarDecimal);
}
function ler()
{
    el = getJSON("../api/des/ver.php?" + location.href.split("?")[1])[0]
    l = Object.keys(el)
    l.splice(0, 1)
    // l.pop()
    for (let i of l)
    {
        document.getElementById(i).value = el[i]
        document.getElementById(i).disabled = true
    }
    document.getElementById("valor").value = document.getElementById("valor").value.replace(".",",")
}

function gerarPdf()
{
    let d = new Date(), mates = []
    d = d.getDate() + " de " + getMesNome(parseInt(d.getMonth())) + " de " + d.getFullYear()

    eldados = document.getElementsByClassName("eldados")
    console.log(eldados)

    let array = 
    [
        //linha da tabela
        [
            {
                table: 
                {
                    widths: ["*"],
                    body: [[
                        criarCelula(eldados[0].innerText, el["nome"])
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
                        criarCelula(eldados[1].innerText, "R$ " + el["valor"].replace(".",",")),
                        criarCelula(eldados[2].innerText, formatarData(el.data)),
                    ]]
                },layout: "noBorders"      
            }
        ],
        [{table: criarLinha([[3,"obs"]]),layout: "noBorders"}]        //fim da linha da tabela
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
            fontSize: 14,
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
        console.log(eldados[i[0]].innerText)
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