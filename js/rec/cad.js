function enviar()
{
    if (checarVazio("nome,valor".split(",")))
        document.form.submit()
}
function voltar()
{
    location.href = "recList.php"
}
function init()
{
    $('#valor').bind('keypress', validarDecimal);
    $("#valor").mask("#####9,99", {reverse: true})
    let d = new Date()
    document.getElementById("data").value = d.getFullYear() + "-" + String(d.getMonth()+1).padStart(2,'0') + "-" + String(d.getDate()).padStart(2,'0')   
}