function init()
{
    id = location.href.split('?')[1]
    pags = getJSON("../api/mens/listEspPorAluno.php?" + id)
    aluno = getJSON("../api/aluno/ver.php?" + id)[0]
    document.getElementById("alunonome").value = aluno.nome
    montarLista()
}
function montarLista()
{
    let t = ""
    ths = "Descrição,Total,Faltando,Situação,Ações".split(",")
    for (let i of ths)
    t += "<label class='th'>" + i.toUpperCase() +  "</label>"
    for (let i of pags)
    {
        t += "<label class=' first'>" + i.ref + "</label>"
        t += "<label> R$ " + i.total.replace(".",",") + "</label>"
        t += "<label> R$ " + i.faltando.replace(".",",") + "</label>"
        t += "<label>" + i.tipo + "</label>"
        t += "<div class='direita last'>"
        t += "<button type='button'" + ((i.tipo != "Devendo") ? " disabled='disabled' ": "onclick='location.href = \"pagCad.php?" + id + "&" + i.id + "\"'")  + ">Pagar</button>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t

}