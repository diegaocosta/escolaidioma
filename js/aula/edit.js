let frequencia = []
function enviar()
{
    frequencia = []
    for (let i = 0; i < alunos.length; i++)
        frequencia.push(document.getElementById("c" + i).value + "," + ((document.getElementById("c" + i).checked) ? "1" : "0"))
    if (frequencia.length != 0)
    {
        let t = ""
        for (let i of frequencia)
        {
            if (t != "") t += ";"
            t += i
        }
        document.getElementById("freq").value = t
        document.form.submit()
    }
}
function voltar()
{
    location.href = "aulaList.php?" + location.href.split("?")[1].split("&")[1]
}
function init()
{
    el =   getJSON("../api/turma/ver.php?" + location.href.split("?")[1].split("&")[1])[0]
    alunos =   getJSON("../api/freq/listSimples.php?" + location.href.split("?")[1].split("&")[0])
    montarLista()
    document.getElementById("idaula").value = location.href.split("?")[1].split("&")[0]
    document.getElementById("idturma").value = location.href.split("?")[1].split("&")[1]
    document.getElementById("turmanome").value = el.nome
    let d = new Date()
    document.getElementById("data").value = d.getFullYear() + "-" + String(d.getMonth()+1).padStart(2,'0') + "-" + String(d.getDate()).padStart(2,'0')   
}
function montarLista()
{
    let t = "", c = 0
    for (let i of alunos)
        t += "<label><input type='checkbox' id='c" + c++ + "' value='" + i.id + "'>" + i.nome + "</label>"
    document.getElementById("lista").innerHTML = t
    for (let i = 0; i < alunos.length; i++)
        if (alunos[i].falta == 1)
        document.getElementById("c" + i).checked = true

}