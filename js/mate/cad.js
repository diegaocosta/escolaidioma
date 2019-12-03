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
    $('#autor').bind('keypress', validarTexto);
    $('#isbn').bind('keypress', validarInteiro);
    $('#valor').bind('keypress', validarDecimal);
    $("#valor").mask("#####9,99", {reverse: true})
    $('#comprado').bind('keypress', validarDecimal);
    $('#total').bind('keypress', validarInteiro);
    $("#comprado").mask("#####9,99", {reverse: true})
}