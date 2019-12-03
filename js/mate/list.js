let idmate
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
    $('#comprado').bind('keypress', validarDecimal);
    $("#comprado").mask("#####9,99", {reverse: true})
    $('#valor').bind('keypress', validarDecimal);
    $("#valor").mask("#####9,99", {reverse: true})
    $('#total').bind('keypress', validarInteiro);
}
function montar()
{
    let t = ""
    ths = "Nome,Autor,Valor,Ações".split(",")
    for (let i of ths)
    t += "<label class='th'>" + i.toUpperCase() +  "</label>"
    for (let i of lista)
    {
        t += "<label class=' first'>" + i.nome + "</label>"
        t += "<label>" + i.autor + "</label>"
        t += "<label> R$ " + i.valor.replace(".",",") + "</label>"
        t += "<div class='direita last'>"
        t += "<a href='mateVer.php?" + i.id + "'>Ver</a>"
        t += "<a href='mateEdit.php?" + i.id + "'>Editar</a>"
        t += "<a onclick='comprar(" + i.id + ")'>Comprar</a>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t
}
function ler()
{
    lista = getJSON("../api/mate/listSimples.php?" + document.getElementById("status").selectedIndex)
    montar()
}
function pesquisar()
{
    let p = document.getElementById("pesq").value
    let tipo = document.getElementById("tipo").selectedIndex
    lista = getJSON("../api/mate/pesq.php?" + p + "&" + tipo + "&" + document.getElementById("status").selectedIndex)
    montar()
}
function mudarPesqPlaceholder(e)
{
    document.getElementById("pesq").placeholder = "Pesquisar por " + e.target[e.target.selectedIndex].innerText
}
function comprar(id)
{
    idmate = id
    mostrarMsg(0)
}
function registrar()
{
    if (checarVazio("comprado,total,valor".split(",")))
    {
        console.log(3)
        document.form.action = "../api/mate/comprar.php?" + idmate
        document.form.submit()
    }
}
function gerarPdf()
{
    let s = "Desativados,Ativos,Todos,".split(",")
    let s1 = "Desativado,Ativo,".split(",")
    let pesq = document.getElementById("pesq").value
    let d = new Date()
    d = d.getDate() + " de " + getMesNome(parseInt(d.getMonth())) + " de " + d.getFullYear()

    let array = []
    array.push([{style: "th", text: "Material"},
    {style: ["th"], text: "Autor"},
    {style: ["th"], text: "Preço"},
    {style: ["th"], text: "Situação"}])

    for (let i of lista)
        array.push(
            [i.nome, i.autor, "R$ " + i.valor.replace(".",","), s1[parseInt(i.status)]]
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
            widths: ["*", "*", 100, 60],
            body: array
        }
    }
    montarPdf(comeco, tabela, estilos)
}