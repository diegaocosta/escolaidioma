function enviar()
{
    if (checarVazio("nome,cpf,telcel,datanasc,diapag,cep,endereco,cidade,bairro,nomeresp,telresp".split(",")))
        document.form.submit()
}
function voltar()
{
    location.href = "alunoList.php"
}
function init()
{
    montarEstados()
    document.getElementById("nome").addEventListener("keypress", function(){validarTexto()})
    $('#nome').bind('keypress', validarTexto);
    $('#nomeresp').bind('keypress', validarTexto);
    $('#cidade').bind('keypress', validarTexto);
    $('#email').bind('keypress', validarEmail);
    $('#cep').bind('keypress', validarInteiro);
    $('#diapag').bind('keypress', validarInteiro);
    $('#diapag').bind('keypress', blurPag);
    $('#diapag').bind('blur', blurPag);
    $('#telfixo').bind('keypress', validarInteiro);
    $('#telfixo').mask("(99)99999999");
    $('#telcel').bind('keypress', validarInteiro);
    $('#telcel').mask("(99)999999999");
    $('#telresp').bind('keypress', validarInteiro);
    $('#telresp').mask("(99)999999999");
    $('#cpf').bind('keypress', validarInteiro);
    $('#cpf').mask('999.999.999-99');
    $('#cep').mask('99999-999');
    $('#cep').bind('keypress', validarInteiro);
}
function blurPag()
{
    let d = document.getElementById("diapag").value
    if (d < 0 || d > 31)
    document.getElementById("diapag").value = ""
}