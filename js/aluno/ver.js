let el, eldados
function enviar()
{
    if (checarVazio("nome,cpf,telcel,datanasc,cep,endereco,cidade,bairro,nomeresp,telresp".split(",")))
        document.form.submit()
}
function voltar()
{
    location.href = "alunoList.php"
}
function init()
{
    montarEstados()
    ler()
}
function ler()
{
    el = getJSON("../api/aluno/ver.php?" + location.href.split("?")[1])[0]
    document.form.action += "?" + el["id"]
    // document.getElementById("status").selectedIndex = parseInt(el["status"])
    // document.getElementById("status").disabled = true
    l = Object.keys(el)
    l.splice(0, 1)
    // l.pop()
    for (let i of l)
    {
        document.getElementById(i).value = el[i]
        document.getElementById(i).disabled = true
    }
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
        [{table: criarLinha([[2,"rg"],[3,"cpf"]]),layout: "noBorders"}],
        [{table: criarLinha([[4,"telfixo"],[5,"telcel"]]),layout: "noBorders"}],
        [{
            table: 
            {
                widths: ["*", "*"],
                body: [[
                    criarCelula(eldados[6].innerText, formatarData(el["datanasc"])),
                    criarCelula(eldados[7].innerText, el["cep"])
                ]]
            },layout: "noBorders"      
        }],
        [{table: criarLinha([[8,"endereco"],[9,"diapag"]]),layout: "noBorders"}],
        [
            {
                table: 
                {
                    widths: ["*", "*"],
                    body: [[
                        criarCelula(eldados[10].innerText, el.cidade),
                        criarCelula(eldados[11].innerText, getEstadoByNum(el.estado))
                    ]]
                },layout: "noBorders"      
            }
        ],
        [{table: criarLinha([[12,"bairro"],[13,"complemento"]]),layout: "noBorders"}],
        [{table: criarLinha([[14,"nomeresp"],[15,"telresp"]]),layout: "noBorders"}],
        [{table: criarLinha([[16,"obs"]]),layout: "noBorders"}],
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