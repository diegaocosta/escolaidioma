function enviar()
{
    if (checarVazio("nome,valor,editora,tipo,autor".split(",")))
        document.form.submit()
}
function voltar()
{
    location.href = "mateList.php"
}
function init()
{
    ler()
    $('#autor').bind('keypress', validarTexto);
    $('#isbn').bind('keypress', validarInteiro);
    $('#valor').bind('keypress', validarDecimal);
    $("#valor").mask("#####9,99", {reverse: true})
    $('#comprado').bind('keypress', validarDecimal);
    $('#total').bind('keypress', validarInteiro);
    $("#comprado").mask("#####9,99", {reverse: true})
}
function ler()
{
    el = getJSON("../api/mate/ver.php?" + location.href.split("?")[1])[0]
    document.form.action += "?" + el["id"]
    document.getElementById("status").selectedIndex = parseInt(el["status"])
    l = Object.keys(el)
    l.splice(0, 1)
    l.pop()
    for (let i of l)
        document.getElementById(i).value = el[i]
    document.getElementById("valor").value = document.getElementById("valor").value.replace(".",",")
}