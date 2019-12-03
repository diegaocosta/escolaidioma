let iduser, lista
function init()
{
    nomes="Nome,Responsável".split(",")
    t = ""
    for (let i = 0; i < nomes.length; i++) 
        t += "<option value="+ i + ">" + nomes[i] + "</option>"
    $('#pesq').bind("keyup", pesquisar)
    document.getElementById("status").selectedIndex = 1
    document.getElementById("status").addEventListener("change", function(){ler()})
    ler()
}
function montar()
{
    let t = ""
    ths = "Nome,Cargo,Ações".split(",")
    for (let i of ths)
    t += "<label class='th'>" + i.toUpperCase() +  "</label>"
    for (let i of lista)
    {
        t += "<label class=' first'>" + i.nome + "</label>"
        t += "<label>" + i.cargo + "</label>"
        t += "<div class='direita last'>"
        // t += "<a href='alunoVer.php?" + i.id + "'>Ver</a>"
        // t += "<a href='alunoEdit.php?" + i.id + "'>Editar</a>"
        t += "<button type='button' class='dir' onclick='des(0," + i.id + "," + i.status + ")'>" + ((i.status == 1) ? "Desativar" : "Ativar") + "</button>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t
}
function ler()
{
    lista = getJSON("../api/usuario/listSimples.php?" + document.getElementById("status").selectedIndex)
    montar()
}
function pesquisar()
{
    let p = document.getElementById("pesq").value
    lista = getJSON("../api/usuario/pesq.php?" + p + "&" + document.getElementById("status").selectedIndex)
    montar()
}
function mudarPesqPlaceholder(e)
{
    document.getElementById("pesq").placeholder = "Pesquisar por " + e.target[e.target.selectedIndex].innerText
}
function des(tipo, id, status)
{
    console.log(id)
    iduser = {id: id, s: status}
    mostrarMsg(0)
}
function trocar(tipo, id)
{
    iduser = id
    mostrarMsg(1)
}
function confirmar()
{
    document.form.action = "../api/aluno/del.php?" + idaluno
    // console.log(document.form.action)
    document.form.submit()
}
function mostrarMsg(tipo)
{
    let modalnome = "modal" + tipo
    let fundonome = "fundo" + tipo
    console.log(fundonome)
	document.getElementById(modalnome).style.display = "block"
		// document.getElementById("modal").style.setProperty("top", "calc(50vh - " + document.getElementById("modal").offsetHeight + "px - 50px)", "important") 
		console.log(document.body)

	div = document.createElement('div')
	div.className="fundo"		
	div.setAttribute("id", fundonome);
	document.getElementById(modalnome).insertAdjacentElement("beforebegin", div); 
}
function cancelar(tipo)
{
    let modalnome = "modal" + tipo
    let fundonome = "#fundo" + tipo
	document.getElementById(modalnome).style.display = "none"
	$(fundonome).remove()
}
function troca()
{
    location.href = "../api/usuario/des.php?" + iduser.id + "&" + iduser.s
}