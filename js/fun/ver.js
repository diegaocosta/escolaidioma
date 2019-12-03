function voltar()
{
    location.href = "funoList.php"
}
function init()
{
    montarEstados()
    $('#nome').bind('keypress', validarTexto);
    $('#cidade').bind('keypress', validarTexto);
    $('#email').bind('keypress', validarEmail);
    $('#cep').bind('keypress', validarInteiro);
    $('#telfixo').bind('keypress', validarInteiro);
    $('#telfixo').mask("(99)99999999");
    $('#telcel').bind('keypress', validarInteiro);
    $('#telcel').mask("(99)999999999");
    $('#cpf').bind('keypress', validarInteiro);
    $('#salario').bind('keypress', validarDecimal);
    $("#salario").mask("#####9,99", {reverse: true});
    $('#cpf').mask('999.999.999-99');
    $('#cep').mask('99999-999');
    $('#cep').bind('keypress', validarInteiro);
    ler()
}
function ler()
{
    el = getJSON("../api/fun/ver.php?" + location.href.split("?")[1])[0]
    document.form.action += "?" + el["id"]
    document.getElementById("status").selectedIndex = parseInt(el["status"])
    l = Object.keys(el)
    l.splice(0, 1)
    l.pop()
    for (let i of l)
    {
        console.log(i)
        document.getElementById(i).value = el[i]
        document.getElementById(i).disabled = true
    }
    document.getElementById("salario").value = document.getElementById("salario").value.replace(".",",")
}
function gerarPdf()
{
    let d = new Date()
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
                    widths: ["*", "*"],
                    body: [[
                        criarCelula(eldados[0].innerText, el["nome"]),
                        criarCelula(eldados[1].innerText, ((el.status) ? "Operando" : "Desativado"))
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
        [{table: criarLinha([[8,"endereco"]]),layout: "noBorders"}],[
            {
                table: 
                {
                    widths: ["*", "*"],
                    body: [[
                        criarCelula(eldados[9].innerText, el.cidade),
                        criarCelula(eldados[10].innerText, getEstadoByNum(el.estado))
                    ]]
                },layout: "noBorders"      
            }
        ],
        [{table: criarLinha([[11,"bairro"],[12,"complemento"]]),layout: "noBorders"}],
        [
            {
                table: 
                {
                    widths: ["*", "*"],
                    body: [[
                        criarCelula(eldados[13].innerText, ((el.cargo == 2) ? "Professor" : "Secretaria")),
                        criarCelula(eldados[14].innerText, (el.salario).replace(".",","))
                    ]]
                },layout: "noBorders"      
            }
        ],
        [{table: criarLinha([[15,"obs"]]),layout: "noBorders"}],
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
        console.log(eldados[i[0]].innerText)
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