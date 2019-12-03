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
    $('#nome').bind('keypress', validarTexto);
    $('#nomeresp').bind('keypress', validarTexto);
    $('#cidade').bind('keypress', validarTexto);
    $('#email').bind('keypress', validarEmail);
    $('#cep').bind('keypress', validarInteiro);
    $('#telfixo').bind('keypress', validarInteiro);
    $('#diapag').bind('keypress', validarInteiro);
    $('#telfixo').mask("(99)99999999");
    $('#telcel').bind('keypress', validarInteiro);
    $('#telcel').mask("(99)999999999");
    $('#telresp').bind('keypress', validarInteiro);
    $('#telresp').mask("(99)999999999");
    $('#cpf').bind('keypress', validarInteiro);
    $('#cpf').mask('999.999.999-99');
    $('#cep').mask('99999-999');
    $('#cep').bind('keypress', validarInteiro);
    ler()
}
function ler()
{
    el = getJSON("../api/aluno/ver.php?" + location.href.split("?")[1])[0]
    document.form.action += "?" + el["id"]
    document.getElementById("status").selectedIndex = parseInt(el["status"])
    l = Object.keys(el)
    l.splice(0, 1)
    l.pop()
    for (let i of l)
        document.getElementById(i).value = el[i]
}