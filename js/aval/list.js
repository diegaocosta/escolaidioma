let tipos = [], lista, mats, avaliacoes, idavals
function init()
{
    let d = new Date()
    d = d.getFullYear() + "-" + String(d.getMonth()+1).padStart(2,'0') + "-" + String(d.getDate()).padStart(2,'0')   
    r = getJSON("../api/aval/checar.php?" + d + "&" + location.href.split("?")[1])[0].resp
    document.getElementById("btncad").href += "?"+ location.href.split("?")[1]
    $('#pesq').bind("keyup", pesquisar)
    r = 0
    if (r == 1)
    {
        document.getElementById("btncad").style.display = "none"
        document.getElementById("pesq2").style.setProperty("grid-template-columns", "auto auto ", "important")        
    }
    ler()
}
function voltar()
{
    location.href = "turmaVer.php?" + location.href.split("?")[1] 
}
function ler()
{
    lista = getJSON("../api/aval/listSimples.php?" + location.href.split("?")[1])
    console.log(lista)
    mats = getJSON("../api/matricula/listEsp.php?" + location.href.split("?")[1])
    idavals = getJSON("../api/nota/listEsp.php?" + location.href.split("?")[1])
    avaliacoes = getJSON("../api/aval/listEsp.php?" + location.href.split("?")[1])
    aux = []
    for (let i of idavals)
        aux.push(i.id)
    aux.unshift(0)
    idavals = aux    
    processar()
    montar()
}
function processar()
{
    let aux = []
    for (let i of lista)
    {
        if (aux.length == 0)
            aux.push({nome: i.aluno, notas: []})
        else
        {
            total = 0
            for (let j of aux)
                if (j.nome != i.aluno)
                    total++
            if (total == aux.length)
                aux.push({nome: i.aluno, notas: []})
        }
    }
    for (let i of lista)
        for (let j of aux)
            if (j.nome == i.aluno)
                j.notas[String(i.idaval)] = i.nota
    
    for (let i of aux)
        for (let j of idavals)
        {
            let total = 0
            for (let k of Object.keys(i.notas))
            {
                if (k != j)
                    total++
                else
                    break
                if (total == Object.keys(i.notas).length )
                    i.notas[j] = 0
            }
        }    
    lista = aux  
            
}
function montar()
{
    console.log(lista)
    let t = "", t1 = "", 
    ths = "Aluno,Média".split(",")
    for (let i of ths)
        t1 += "<div class='th'>" + i.toUpperCase() +  "</div>"
    for (let i of avaliacoes)
        t += "<div class='th thnomes'>" + i.nome +  "</div>"
    for (let i = 0; i < lista.length; i++)
    {        
        t1 += "<div>" + lista[i].nome + "</div>"
        console.log(Object.keys(lista[i]))
        for (let j of Object.keys(lista[i].notas))
        {
            console.log(j)
            if (j == 0)
                t1 += "<div>" + lista[i].notas[j] + "</div>"
            else
                t += "<div>" + lista[i].notas[j] + "</div>"
        }
    }
    for (let i = 0; i < avaliacoes.length; i++)
    {
        t += "<input type='text' id='p" + i + "' value='" + avaliacoes[i].peso + "' onblur='lostfocus(" + i + ")'>"
        tipos[i] = {id: avaliacoes[i].id, peso: avaliacoes[i].peso}
    }
    let t2 = ""
    for (let i = 0; i < avaliacoes.length ; i++) 
        t2 += "auto "
    document.getElementById("lista").style.setProperty("grid-template-columns", t2)
    document.getElementById("lista").innerHTML = t
    document.getElementById("nomes").innerHTML = t1
}
function lostfocus(id)
{
    let aux = tipos, soma = 0, t = ""
    aux[id].peso = document.getElementById("p" + id).value
    for (let i of aux)
        soma += parseFloat(i.peso)
        console.log(soma)
    if (soma > 100)
    {
        alert("Valor informado supera 100,\ninforme outro valor")
        return
    }
    else
        tipos[id].peso = document.getElementById("p" + id).value    
    console.log(tipos)
    for (let i of tipos)
    {
        if (t != "") t += ";"
        t += i.id + "," + i.peso
    }
    document.getElementById("pesos").value = t
    document.form.action = "../api/aval/mudar.php?" + location.href.split("?")[1] 
    console.log(t)
    document.form.submit()
}
function pesquisar()
{
    let d1 = document.getElementById("d1").value
    let d2 = document.getElementById("d2").value
    if (d1 == "" && d2 == "")
    {
        ler()
        return
    }
    lista = getJSON("../api/aula/pesq.php?" + d1 + "&" + d2 + "&1&" + location.href.split("?")[1])
    montar()
}
function mudarPesqPlaceholder(e)
{
    document.getElementById("pesq").placeholder = "Pesquisar por " + e.target[e.target.selectedIndex].innerText
}