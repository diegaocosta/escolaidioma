let gets = location.href.split('?'), idaluno, ano, curso
function init()
{
    idmatr = gets[1]
    curso = getJSON("../api/matricula/ver3.php?" + idmatr)[0]
    document.getElementById("alunotitle").innerHTML = "Ficha de Mensalidade de " + getJSON("../api/aluno/ver.php?" + curso.idaluno)[0].nome + ", Curso: " + curso.curso
    montar()
}
function voltar()
{
    location.href = "mensList.php"
}
function montar()
{
    let t = "", mesa = parseInt((new Date()).getMonth())
    let j = curso
        t += "<div class='size1 sizes'>"
        t += "<div class='size1 sizes'><div><label>Curso:</label><input readonly type='text' value='" + j.curso + "'></div></div>"

        t += "<div class='size3 sizes'>"
        t += "<div><label>Turma:</label><input readonly type='text' value='" + j.turma + "'></div>"
        t += "<div><label>Professor:</label><input readonly type='text' value='" + j.prof + "'></div>"
        ano = j.ingresso.split("-")[0]
        idmat = j.id
        t += "<div><label>Ano:</label><input readonly type='text' value='" + ano + "'></div>"
        t += "</div>"

        t += "<div class='size3 sizes'>"
        t += "<div><label>Data de Abertura:</label><input readonly type='text' value='" + formatarData(j.abertura) + "'></div>"
        t += "<div><label>Data de Ingressão:</label><input readonly type='text' value='" + formatarData(j.ingresso) + "'></div>"
        t += "<div><label>Material Pagado?</label>"
        if ((j.matepag == 0))
            t += "<button type='button' onclick='location.href=\"pagCad.php?" + j.idaluno + "&" + idmat + "&" + j.idcurso + "\"'>Pagar</button></div>"
        else
            t += "<button type='button' >Pagado</button></div>"

        t += "</div>"

        t += "<div class='meslist size3 sizes'>"
        for (let i of j.meses.split(";"))
        {
            mes = parseInt(i.split(",")[0])
            pago = i.split(",")[1]
            t += "<div class='meses'>"
            t += "<div class='size1 sizes tds'><label class='mestitle'>" + getMesNome(mes) + "</label><div class='size2 sizes mesbox'>"
            if (mes>= parseInt(j.mesi) )
            {
                t += "<label>" + ((pago == 0) ? "Devendo" : "Pago") + "</label><button type='button' "
                if (pago == 0 && mes <= parseInt(mesa) )
                    t += " onclick='pagar(" + mes + ")' "
                if (parseInt(mes)> parseInt(mesa) )
                    t += " class='mesmaior' "
                t += ((pago == 0) ? ">Pagar" : "class='mesmenor'>Pagado") + " </button></div></div>"

            }
            else
                t += "<label>---</label><button class='mesmenor' type='button'>-</button></div></div>"

            t += "</div>"
        }
        t += "</div>"

        t += "</div>"
    document.getElementById("lista").innerHTML = t
}
function pagar(mes)
{
    location.href = "mensCad.php?" + curso.idaluno + "&" + idmat + "&" + mes + "&" + ano
}