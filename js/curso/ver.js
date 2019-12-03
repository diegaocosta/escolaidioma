let mate
function voltar()
{
    location.href = "cursoList.php"
}
function init()
{
    ler()
    
}
function ler()
{
    el = getJSON("../api/curso/ver.php?" + location.href.split("?")[1])[0]
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
    document.getElementById("multa").value = document.getElementById("multa").value.replace(".",",")
        
    mate = getJSON("../api/matecurso/listSimples.php?" + location.href.split("?")[1])
    t = ""
    for (let i of mate)
        t += "<div>" + i.nome + "</div>"
    document.getElementById("lista").innerHTML = t
}
function gerarPdf()
{
    let d = new Date(), mates = [], a = []
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
                        criarCelula(eldados[1].innerText, ((el.status) ? "Ativo" : "Desativado"))
                    ]]
                },layout: "noBorders"      
            }
        ],
        [
            {
                table: 
                {
                    widths: ["*", "*", "*"],
                    body: [[
                        criarCelula(eldados[2].innerText, el["totaldemes"]),
                        criarCelula(eldados[3].innerText, "R$ " + el.valor.replace(".",",")),
                        criarCelula(eldados[5].innerText, ((el.tipomulta == 1) ? (el.multa.replace(".",",") + "%") : el.multa.replace(".",",")))
                    ]]
                },layout: "noBorders"      
            }
        ],
        [{table: criarLinha([[6,"obs"]]),layout: "noBorders"}],
        [
            {
                table: 
                {
                    widths: ["*"],
                    body: [[{text: "Materiais", fillColor: "#6060FF", style: "header", color: "white"}]]
                }
            }
        ]
        //fim da linha da tabela
    ]
    for (let i of mate)
        array.push(
            [
                {
                    table: 
                    {
                        widths: ["*"],
                        body: [[i.nome]]
                    },margin: [0, -5, 0, 0]
                }
            ]
        )


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