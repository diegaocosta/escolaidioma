let mate = [], aux = [], news = [], avallist = [], totalativ = 0
function enviar()
{
    let zeros = 0
    if (checarVazio("nome,dtabertura,dtfechamento".split(",")))
        if (document.getElementById("idcurso").selectedIndex != 0 && document.getElementById("idfun").selectedIndex != 0)
        {            
            t = ""
            for (let i = 0; i < 5; i++)
            {
                if (document.getElementById("d" + i).checked)
                    t += 1
                else
                {
                    zeros++
                    t += 0
                }
            } 
                console.log(t)    
            if (zeros == 5)
            {
                alert("Pelo menos algum dia da\nsemana deve ser escolhido")
                return
            }
            document.getElementById("semana").value = t
            console.log(document.getElementById("semana").value)
            // document.getElementById("mesabertura").disabled = ""
            document.form.submit()
        }
        else
        {
            alert("Um curso e um professor\ndevem ser escolhidos.")
            return
        }
}
function voltar()
{
    location.href = "turmaList.php"
}
function montarDias()
{
    let t = "", n = "Segunda,Terça,Quarta,Quinta,Sexta".split(","),c = 0
    for (let i of n)
        t += "<div><label><input id='d" + c++ + "' type='checkbox'>" + i + "</label></div>"
    document.getElementById("dias").innerHTML = t

}
function init()
{
    let d = new Date()
    // document.getElementById("dtabertura").value = d.getFullYear() + "-" + String(d.getMonth()+1).padStart(2,'0') + "-" + String(d.getDate()).padStart(2,'0')
    // console.log(d.getVarDate)
    document.getElementById("ano").value = d.getFullYear()
    montarLista(getJSON("../api/curso/listSimples.php?1"), "idcurso", "Curso")
    montarLista(getJSON("../api/fun/listEsp.php?1"), "idfun", "Professor")
    montarDias()
    document.getElementById("ativs").innerHTML = geradorAval(0, 0)
}
function geradorAval(i, tipo)
{
    console.log(i)
    let t = ""
    t += "<div class='size2a sizes' >"
        t += "<div class='ativ'>"
            t += "<div class='size1 sizes'>"
                t += "<div>"
                    t += "<label>Nome da Atividade:</label><input id='nome" + i +"' type='text' " + ((tipo == 1) ? ("readonly value='" + avallist[i].n + "'>") : ">")
                t += "</div>"
            t += "</div>"
            t += "<div class='size2 sizes'>"
                t += "<div>"
                    t += "<label>Data:</label><input id='data" + i +"' type='date' "  + ((tipo == 1) ? ("readonly value='" + avallist[i].d + "'>") : ">") 
                t += "</div>"
                t += "<div>"
                    t += "<label>Peso:</label><input id='peso" + i +"' type='text' "  + ((tipo == 1) ? ("readonly value='" + avallist[i].p + "'>") : ">")
                t += "</div>"
            t += "</div>"
        t += "</div>"
        t += "<div>"
            t += "<button type='button' onclick='add(" + i + ")'>+</button>"
        t += "</div>"
    t += "</div>"
    return t
}
function add(pos)
{
    if (checarVazio(("nome" + pos + ",data" + pos + ",peso" + pos).split(",")))
        avallist.push({
            n: document.getElementById("nome" + pos).value,
            d: document.getElementById("data" + pos).value,
            p: document.getElementById("peso" + pos).value,
        })
    montarAtivs()
}
function montarAtivs()
{
    let t = ""
    for (let i = 0; i < avallist.length; i++) 
        t += geradorAval(i, 1)      
    t += geradorAval(avallist[avallist.length], 0)
    document.getElementById("ativs").innerHTML = t     
}
function montarLista(a, id, n)
{
    let t = "<option value='0'>" + n + "</option>"
    for (let i of a)
        t += "<option value='" + i.id + "'>" + i.nome + "</option>"
    document.getElementById(id).innerHTML = t
}