function enviar()
{
    if (checarVazio("nome,cpf,telcel,datanasc,cep,endereco,cidade,bairro,cargo,salario".split(",")))
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
}