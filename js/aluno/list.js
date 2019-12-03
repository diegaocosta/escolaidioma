let idaluno, lista
function init()
{
    nomes="Nome,Responsável".split(",")
    t = ""
    for (let i = 0; i < nomes.length; i++) 
        t += "<option value="+ i + ">" + nomes[i] + "</option>"
    document.getElementById("tipo").innerHTML = t
    $('#pesq').bind("keyup", pesquisar)
    document.getElementById("status").selectedIndex = 1
    document.getElementById("status").addEventListener("change", function(){ler()})
    ler()
    document.getElementById("outros").addEventListener("blur", blur())
}
function blur()
{
    if (document.getElementById("outros").value == "")
        document.getElementById("m5").checked = false
}
function montar()
{
    let t = ""
    ths = "Nome,Responsável,Tel. Responsável,Ações".split(",")
    for (let i of ths)
    t += "<label class='th'>" + i.toUpperCase() +  "</label>"
    for (let i of lista)
    {
        t += "<label class=' first'>" + i.nome + "</label>"
        t += "<label>" + i.nomeresp + "</label>"
        t += "<label>" + i.telresp + "</label>"
        t += "<div class='direita last'>"
        t += "<a href='alunoVer.php?" + i.id + "'>Ver</a>"
        t += "<a href='alunoEdit.php?" + i.id + "'>Editar</a>"
        t += "<a onclick='del(" + i.id + ",\"" + i.nome + "\")'>Desistir</a>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t
}
function ler()
{
    lista = getJSON("../api/aluno/listSimples.php?" + document.getElementById("status").selectedIndex)
    montar()
}
function pesquisar()
{
    let p = document.getElementById("pesq").value
    let tipo = document.getElementById("tipo").selectedIndex
    lista = getJSON("../api/aluno/pesq.php?" + p + "&" + tipo + "&" + document.getElementById("status").selectedIndex)
    montar()
}
function mudarPesqPlaceholder(e)
{
    document.getElementById("pesq").placeholder = "Pesquisar por " + e.target[e.target.selectedIndex].innerText
}
function del(id, nome)
{
    idaluno = id
    document.getElementById("nomedoaluno").innerText = nome
    console.log(idaluno)
    mostrarMsg(0)
}
function confirmar()
{
    let total = 0, t = ""
    for (let i = 0; i < 6; i++) 
    {
        if (!document.getElementById("m" + i).checked)
            total++
        t += (document.getElementById("m" + i).checked) ? 1 : 0
    }
    if (total == 6)
    {
        alert("Pelos menos um motivo deve ser selecionado")
        return
    }
    document.form.action = "../api/aluno/del.php?" + idaluno
    document.getElementById("motivos").value = t
    // console.log(document.form.action)
    document.form.submit()
}
function gerarPdf()
{
    let s = "Evadidos,Frequentes,Todos,".split(",")
    let s1 = "Evadido,Frequente,".split(",")
    let pesq = document.getElementById("pesq").value
    let d = new Date()
    d = d.getDate() + " de " + getMesNome(parseInt(d.getMonth())) + " de " + d.getFullYear()

    let array = []
    array.push([{style: "th", text: "Aluno"},
    {style: ["th"], text: "Responsável"},
    {style: ["th"], text: "Tel. do Resp."},
    {style: ["th"], text: "Situação"}])

    for (let i of lista)
        array.push(
            [i.nome, i.nomeresp, i.telresp, s1[parseInt(i.status)]]
        )

    let comeco = [
        {
            text: "Relatório de Alunos Matriculados", style: "header"
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
                text: ["Pesquisado " + ((parseInt(document.getElementById("tipo").value) == 0) ? "Nome" : "Responsável") + " com  " + pesq], style: "header", fontSize: 14
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