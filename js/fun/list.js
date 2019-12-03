let idfun, lista
function init()
{
    nomes="Nome,Cargo".split(",")
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
    ths = "Nome,Telefone,Cargo,Ações".split(",")
    for (let i of ths)
    t += "<label class='th'>" + i.toUpperCase() +  "</label>"
    for (let i of lista)
    {
        t += "<label class=' first'>" + i.nome + "</label>"
        t += "<label>" + i.telcel + "</label>"
        t += "<label>" + i.cargo + "</label>"
        t += "<div class='direita last'>"
        t += "<a href='funVer.php?" + i.id + "'>Ver</a>"
        t += "<a href='funEdit.php?" + i.id + "'>Editar</a>"
        t += "<a onclick='del(" + i.id + ")'>Deletar</a>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t
}
function ler()
{
    lista = getJSON("../api/fun/listSimples.php?" + document.getElementById("status").selectedIndex)
    montar()
}
function pesquisar()
{
    let p = document.getElementById("pesq").value
    let tipo = document.getElementById("tipo").selectedIndex
    lista = getJSON("../api/fun/pesq.php?" + p + "&" + tipo + "&" + document.getElementById("status").selectedIndex)
    montar()
}
function mudarPesqPlaceholder(e)
{
    document.getElementById("pesq").placeholder = "Pesquisar por " + e.target[e.target.selectedIndex].innerText
}
function del(id)
{
    idfun = lista[id - 1].id
    console.log(idfun)
    mostrarMsg(0)
}
function confirmar()
{
    document.form.action = "../api/fun/del.php?" + idfun
    // console.log(document.form.action)
    document.form.submit()
}
function gerarPdf()
{
    let s = "Desativados,Ativos,Todos,".split(",")
    let s1 = "Desativado,Operando,".split(",")
    let pesq = document.getElementById("pesq").value
    let d = new Date()
    d = d.getDate() + " de " + getMesNome(parseInt(d.getMonth())) + " de " + d.getFullYear()

    let array = []
    array.push([{style: "th", text: "Aluno"},
    {style: ["th"], text: "Telefone"},
    {style: ["th"], text: "Cargo"},
    {style: ["th"], text: "Situação"}])

    for (let i of lista)
        array.push(
            [i.nome, i.telcel, i.cargo, s1[parseInt(i.status)]]
        )

    let comeco = [
        {
            text: "Relatório de Funcionários", style: "header"
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