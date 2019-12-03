let idmate, el
function init()
{
    nomes="Nome,Autor".split(",")
    t = ""
    for (let i = 0; i < nomes.length; i++) 
        t += "<option value="+ i + ">" + nomes[i] + "</option>"
    document.getElementById("tipo").innerHTML = t
    $('#pesq').bind("keyup", pesquisar)
    document.getElementById("status").selectedIndex = 1
    document.getElementById("status").addEventListener("change", function(){ler()})
    ler()
}
function ler()
{
    lista = getJSON("../api/mate/listSimples2.php?" + document.getElementById("status").selectedIndex)
    montar()
}
function montar()
{
    let t = ""
    ths = "Nome,V. Pago,V. Venda,Total,Ven.,Ações".split(",")
    for (let i of ths)
    t += "<label class='th'>" + i.toUpperCase() +  "</label>"
    for (let i of lista)
    {
        t += "<label class=' first'>" + i.nome + "</label>"
        t += "<label> R$ " + i.comprado.replace(".",",") + "</label>"
        t += "<label> R$ " + i.valor.replace(".",",") + "</label>"
        t += "<label>" + i.total + "</label>"
        t += "<label>" + i.vendido + "</label>"
        t += "<div class='direita last'>"
        t += "<a onclick='ver(" + i.id + ")'>Ver</a>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t
}
function ver(id)
{
    idmate = id    
    el = getJSON("../api/mate/ver.php?" + id)[0]
    delete el.status
    delete el.id
    el.valor = el.valor.replace(".",",")
    el.comprado = el.comprado.replace(".",",")
    el.tipo1 = el.tipo
    delete el.tipo
    console.log(Object.keys(el))
    for (let i of Object.keys(el))
    {
        console.log(i)
        document.getElementById(i).value = el[i]
    }
    document.getElementById("tipo").value = el.tipo
    mostrarMsg(0)
    document.getElementById("materialnomeform").innerText = "Material: " + el.nome
}
function pesquisar()
{
    let p = document.getElementById("pesq").value
    let tipo = document.getElementById("tipo").selectedIndex
    lista = getJSON("../api/mate/pesq2.php?" + p + "&" + tipo + "&" + document.getElementById("status").selectedIndex)
    montar()
}
function mudarPesqPlaceholder(e)
{
    document.getElementById("pesq").placeholder = "Pesquisar por " + e.target[e.target.selectedIndex].innerText
}
function gerarPdf()
{
    let s = "Desativados,Ativos,Todos,".split(",")
    let pesq = document.getElementById("pesq").value
    let d = new Date()
    d = d.getDate() + " de " + getMesNome(parseInt(d.getMonth())) + " de " + d.getFullYear()

    let array = []
    array.push
    (
        [
            {style: "th", text: "Material"},
            {style: ["th"], text: "Autor"},
            {style: ["th"], text: "Valor Pago"},
            {style: ["th"], text: "Valor de Venda"},
            {style: ["th"], text: "Total"},
            {style: ["th"], text: "Vendido"}
        ]   
    )

    for (let i of lista)
        array.push(
            [i.nome, i.autor, "R$ " + i.comprado.replace(".",","), "R$ " + i.valor.replace(".",","), i.total, i.vendido]
        )

    let comeco = [
        {
            text: "Relatório de Materiais Cadastrados", style: "header"
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
                text: ["Pesquisado " + ((parseInt(document.getElementById("tipo").value) == 0) ? "Nomes" : "Autores") + " que tenham  " + pesq], style: "header", fontSize: 14
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
            widths: ["*", "*", 90, 90, 40, 50],
            body: array
        }
    }
    montarPdf(comeco, tabela, estilos)
}