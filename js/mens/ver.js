let elid = 0
function voltar()
{
    location.href = "mensList.php"
}
function init()
{
    document.getElementById("mes").innerHTML = montarMeses()
    ler()
    montarPagmamentos()
}
function ver()
{
    location.href = "pagCad.php?" + location.href.split("?")[1] + "&" + elid
}
function ler()
{
    el = getJSON("../api/mens/ver.php?" + location.href.split("?")[1])[0]
    elid = el["id"]
    delete el.idfun
    delete el.idaluno
    l = Object.keys(el)
    l.splice(0, 1)
    // l.pop()
    for (let i of l)
    {
        console.log(i)
        document.getElementById(i).value = el[i]
        document.getElementById(i).disabled = true
    }
    document.getElementById("valor").value = document.getElementById("valor").value.replace(".",",")
    document.getElementById("alunonome").value = el["aluno"]
    document.getElementById("status").value = (el["status"] == 0) ? "Devendo" : "Pago"
    document.getElementById("faltando").value = document.getElementById("faltando").value.replace(".",",")
    document.getElementById("mes").selectedIndex = parseInt(el["mes"])
}
function montarPagmamentos()
{
    pag = getJSON("../api/pag/listEsp.php?" + elid)
    console.log(pag)
    let t = "<div class='ths'>Data</div><div class='ths'>Valor</div><div class='ths'>Desconto</div>"
    for (let i of pag)
        t += "<div>" + i.data + "</div><div>" + i.valor + "</div><div>" + i.desconto + "</div>"
    document.getElementById("lista").innerHTML = t
}