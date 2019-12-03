let aluno, data, ano, aux, soma, idaluno, gets = location.href.split('?')[1].split("&"), curso
function enviar()
{
    if(checarVazio("valor,pago".split(",")))
    {
        if (parseFloat(document.getElementById("valor").value) != parseFloat(document.getElementById("pago").value))
        {
            alert("Valor pago deve ser o mesmo\nque o valor sugerido.")
            return
        }
        document.form.action += "?" + gets[1]        
        document.form.submit()
    }
}
function voltar()
{
    location.href = "matVer.php?" + gets[0]
}
function init()
{
    let d = new Date()
    data = d.getFullYear() + "-" + String(d.getMonth()+1).padStart(2,'0') + "-" + String(d.getDate()).padStart(2,'0')   
    document.getElementById("data").value = data
    ano = d.getFullYear()
    setEvents("valor,pago,desconto".split(","))

    $('#desconto').bind('keypress', validarInteiro);
    document.getElementById("valororiginal").value = 0

    aluno = getJSON("../api/aluno/ver.php?" + gets[0])[0]
    document.getElementById("alunonome").value = aluno.nome
    escolherAluno(aluno.id, aluno.nome)

    curso = getJSON("../api/curso/ver.php?" + gets[2])[0]
    document.getElementById("pagtitulo").innerText = "Materiais do curso " + curso.nome
    document.getElementById("cursonome").value = curso.nome

    console.log(curso)

    mates = getJSON("../api/matecurso/listSimples.php?" + curso.id)
    x = 0

    document.getElementById("valororiginal").value = String(x).replace(".",",")
    document.getElementById("valor").value = String(x).replace(".",",")
    montarValores(mates)
}
function mostrar()
{
    document.getElementById("alunolist").style.setProperty("display", (document.getElementById("alunolist").style.display == "block") ? "none" : "block", "important")
}
function montarAlunos()
{
    let t = ""
    for (let i of aux)
        t += "<div onclick='escolherAluno(" + i.id + ",\"" + i.nome + "\"" + ")'>" + i.nome + "</div>"
    document.getElementById("alunolist").innerHTML = t
}
function escolherAluno(id, nome)
{
    idaluno = id
    document.getElementById("nome").value = "Pagamento de " + nome + " paga no data " + formatarData(data) 
    curso = getJSON("../api/matricula/ver3.php?" + idaluno)[0]
    // montarValores()
}
function pesquisar()
{
    let a2 = []
    if (document.getElementById("alunopesq").value == "")
        aux = alunos
    else
    {
        for (let i of aux)
            if (i.nome.toLowerCase().indexOf(document.getElementById("alunopesq").value.toLowerCase()) != -1)
                a2.push(i)
        aux = a2        
    }
    montarAlunos()
}
function setEvents(l)
{
    for (let i of l)
    {        
        $('#' + i).bind('keypress', validarDecimal);
        $("#" + i).mask("#####9,99", {reverse: true})
    }
}
function montarValores(info)
{
    let t = "<div class='infoth'>Descrição</div><div class='infoth'>Valor</div>", s = 0
    for (let i of info)
    {
        s += parseFloat(i.valor)
        t += "<div>" + i.nome + "</div><div> R$ " + i.valor.replace(".",",") + "</div>"
    }
    t += "<div id='infototal' class='tth'>Total a pagar</div><div class='tth'> R$ " + String(s).replace(".",",") + "</div>"
    document.getElementById("lista").innerHTML = t
    soma = s
    document.getElementById("valororiginal").value = String(soma).replace(".",",")
    document.getElementById("valor").value = String(soma).replace(".",",")
}
function checarDesconto()
{    
    let desconto = parseFloat(document.getElementById("desconto").value.replace(",","."))
    let percent = parseInt(document.getElementById("percent").value)
    let total = parseFloat(document.getElementById("valororiginal").value.replace(",","."))
    if (total == 0)
        return
    if (document.getElementById("desconto").value == "")
    {
        document.getElementById("desconto").value = 0
        return
    }
    if (percent == 0)
    {
        if (desconto > total)
        {
            document.getElementById("desconto").value = 0
            document.getElementById("valor").value = total
            return
        }
        console.log(total)
        console.log(desconto)
        console.log(total - desconto)
        document.getElementById("valor").value = total - desconto
    }
    else
    {
        if (desconto > 100)
        {
            document.getElementById("desconto").value = 0
            document.getElementById("valor").value = total
            return
        }
        document.getElementById("valor").value = total - total * 0.01 * desconto
    }
    let v = document.getElementById("valor").value.replace(".",",")
    if (v.indexOf(",") == -1)
        document.getElementById("valor").value = v
    else
        document.getElementById("valor").value = v.substring(0, v.indexOf(",")+3)
    checarPago()
}
function checarPago()
{
    let pago = parseFloat(document.getElementById("pago").value.replace(",","."))
    let valor = parseFloat(document.getElementById("valor").value.replace(",","."))
    if (pago > valor)
        document.getElementById("pago").value = String(valor).replace(".",",")
}