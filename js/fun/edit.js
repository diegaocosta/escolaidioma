function enviar()
{
    if (checarVazio("nome,cpf,telcel,datanasc,cep,endereco,cidade,bairro,salario,cargo".split(",")))
        document.form.submit()
}
function voltar()
{
    location.href = "funList.php"
}
function init()
{
    montarEstados()
    $('#nome').bind('keypress', validarTexto);
    $('#cidade').bind('keypress', validarTexto);
    $('#email').bind('keypress', validarEmail);
    $('#cep').bind('keypress', validarInteiro);
    $('#telfixo').bind('keypress', validarInteiro);
    $('#telfixo').mask("(99)99999999");
    $('#telcel').bind('keypress', validarInteiro);
    $('#telcel').mask("(99)999999999");
    $('#cpf').bind('keypress', validarInteiro);
    $('#salario').bind('keypress', validarDecimal);
    $("#salario").mask("#####9,99", {reverse: true});
    $('#cpf').mask('999.999.999-99');
    $('#cep').mask('99999-999');
    $('#cep').bind('keypress', validarInteiro);
    ler()
}
function ler()
{
    el = getJSON("../api/fun/ver.php?" + location.href.split("?")[1])[0]
    document.form.action += "?" + el["id"]
    document.getElementById("status").selectedIndex = parseInt(el["status"])
    l = Object.keys(el)
    l.splice(0, 1)
    l.pop()
    for (let i of l)
        document.getElementById(i).value = el[i]
    document.getElementById("salario").value = document.getElementById("salario").value.replace(".",",")
}