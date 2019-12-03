let aluno, data, ano, aux, soma, idaluno, gets = location.href.split('?')[1].split("&")
function enviar()
{
    if(checarVazio("valor,pago".split(",")))
    {
        let sugerido = parseFloat(document.getElementById("valor").value.replace(",","."))
        let pagado = parseFloat(document.getElementById("pago").value.replace(",","."))
        if (pagado != sugerido)
        {
            alert("Valor pago deve ser o mesmo\nque o valor sugerido.")
            return
        }
        document.getElementById("mes").disabled = ""
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

    document.getElementById("mes").innerHTML = montarMeses()
    document.getElementById("mes").selectedIndex = gets[2]
    document.getElementById("ano").value = gets[3]

    aluno = getJSON("../api/aluno/ver.php?" + gets[0])[0]
    document.getElementById("alunonome").value = aluno.nome
    escolherAluno(aluno.id, aluno.nome)

    curso = getJSON("../api/curso/ver.php?" + curso.idcurso)[0]
    document.getElementById("cursonome").value = curso.nome
    document.getElementById("cursovalor").value = curso.valor.replace(".",",")

    let mes = parseInt(d.getMonth()), anoatual = parseInt(d.getFullYear())

    if (anoatual > gets[3])
        dif = 12 * (anoatual - gets[3]) - gets[2] + mes
    else
        dif = mes - gets[2]
    let x = 0
    

    if (curso.tipomulta == 1)
    {
        contador = 0
        x = parseFloat(curso.valor)
        while (contador < dif)
            x += parseFloat((parseFloat(curso.multa) * ++contador) + parseFloat(curso.valor))
    }
    else
        x = (parseFloat(curso.valor) + dif * curso.multa)


    document.getElementById("valororiginal").value = String(x).replace(".",",")
    document.getElementById("valor").value = String(x).replace(".",",")
    // montarValores([])
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
    document.getElementById("nome").value = "Mensalidade de " + formatarData(data) + " paga por " + nome    
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
function montarValores()
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