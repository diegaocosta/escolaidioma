let tipos = [], lista, datas, avaliacoes, freqs, infosgerais
function init()
{
    let d = new Date()
    d = d.getFullYear() + "-" + String(d.getMonth()+1).padStart(2,'0') + "-" + String(d.getDate()).padStart(2,'0')

    
    turmas = getJSON("../api/turma/listEsp2.php")
    console.log(turmas)
    let tturma = ""
    for (let i of turmas)
        tturma += "<option value='" + i.id + "'>" + i.nome + "</option>"
    document.getElementById("turmas").innerHTML = tturma

    $("#turmas").bind("change", ler)


    ler()
}
function ler()
{

    id = document.getElementById("turmas").value
    lista = getJSON("../api/aval/listSimples.php?" + id)
    console.log(lista)
    avaliacoes = getJSON("../api/aval/listEsp.php?" + id)
    console.log(avaliacoes)
    datas = getJSON("../api/turma/ver3.php?" + id)
    console.log(datas)
    freqs = getJSON("../api/matricula/listEsp2.php?" + id)
    console.log(freqs)
    processar()
    // montar()
}
function processar()
{
    let nome = "", aux = [], contador = -1
    if (lista.length != 0)
    {        
        for (let i of lista)
            if (nome != i.aluno)
            {
                contador++
                aux.push({nome: i.aluno, avals: [{id: 99999, nota: i.nota}]})
                for (let i of avaliacoes)
                    aux[contador].avals.push({id: parseInt(i.id), nota: 0})

                nome = i.aluno
                for (let j of aux[contador].avals)
                    if (j.id == parseInt(i.idaval))
                        j.nota = i.nota
            }
            else
            {
                for (let j of aux[contador].avals)
                    if (j.id == parseInt(i.idaval))
                        j.nota = i.nota

            }
    }
    else
    {
        lista = freqs
        avaliacoes.push({nome: "Aval. 0"})
        for (let i of lista)
            if (nome != i.nome)
            {
                contador++
                aux.push({nome: i.nome, avals: [{id: 0, nota: 0}]})
                aux[contador].avals.push({id: 1, nota: "Não Há"})
                nome = i.nome
            }
    }
    for (let i of aux)
        for (let j of freqs)
            if (i.nome == j.nome)
            {
                i.freqs = j.freqs
                break
            }
    montar(aux)
}
function montar(aux)
{
    infosgerais = aux
    let tnomes = "<label class='bolth'>ALUNOS</label><label class='bolth'>NOMES</label>"
    let tmedias = "<label class='bolth'>MÉD.</label>"
    let tnotas = "", stylenotas = "", totaldias = 0
    for (let i of avaliacoes)
    {
        tnotas += "<label class='bolth'>" + i.nome + "</label>"
        stylenotas += "60px "
    }
    let ttotal = "<label class='bolth'>TOT.</label>"
    let tperc = "<label class='bolth'>F. %</label>"
    let tfreqs = "", styledatas = ""
    for (let i of datas[0].datas.split(","))
    {
        tfreqs += "<label class='bolth'>" + i + "</label>"
        styledatas += "70px "
        totaldias++
    }
    for (let i of aux)
    {
        let totalpres = 0
        tnomes += "<label>" + i.nome + "</label>"
        tmedias += "<label>" + i.avals[0].nota + "</label>"
        for (let j = 1; j < i.avals.length; j++) 
            tnotas += "<label>" + i.avals[j].nota + "</label>"
        for (let j of i.freqs.split(";"))
        {
            tfreqs += "<label>" + ((j == "0") ? "X" : "O") + "</label>"
            if (j == "1")
            totalpres++            
        }
        ttotal += "<label>" + totalpres + "/" + totaldias  + "</label>"
        let resp = String((totalpres * 100)/totaldias)
        resp = resp.substring(0, resp.indexOf(".") + 3)
        tperc += "<label class='plabel'>" + resp.replace(".",",") + "%"  + "</label>"

        console.log(totalpres)
        console.log(totaldias)
        console.log()
        
    }
    document.getElementById("nomesdiv").innerHTML = tnomes
    document.getElementById("medias").innerHTML = tmedias
    document.getElementById("perc").innerHTML = tperc
    document.getElementById("total").innerHTML = ttotal
    document.getElementById("notas").innerHTML = tnotas
    document.getElementById("notas").style.setProperty("grid-template-columns", stylenotas, "important")
    document.getElementById("freqs").innerHTML = tfreqs
    document.getElementById("freqs").style.setProperty("grid-template-columns", styledatas, "important")

}
function gerarPdf()
{    
    let datatotal = datas[0].datas.split(',').length

    let d = new Date(), mates = []
    d = d.getDate() + " de " + getMesNome(parseInt(d.getMonth())) + " de " + d.getFullYear()

    let aux = [[{text: "ALUNOS", style: "header"}],
        
    ]
    let aux2 = [], contador = 1, wids = [], aux3 = [
        {text: "NOMES", style: "header"},
        {text: "MÉDIAS", style: "header"}
    ]
    aux[0].push({text: "NOTAS", style: "header"})
    for (let i of avaliacoes)
    {
        contador++   
        aux[0].push({})
        wids.push(40)
        aux3.push({text: i.nome, style: "header"})
    }
    aux[0].push({text: "FREQUÊNCIA", style: "header", colSpan: 4})
    aux[0].push({})
    aux[0].push({})
    aux[0].push({})
    aux[0].push({text: "RESULTADO", style: "header"})
    aux[0][1].colSpan = contador
    aux[1] = aux3
    aux[1].push({text: "T. FALTA", style: "header"})
    aux[1].push({text: "% DE FALTA", style: "header"})
    aux[1].push({text: "T. PRES.", style: "header"})
    aux[1].push({text: "% DE PRES", style: "header"})
    aux[1].push({text: "", style: "header"})
    for (let i of infosgerais)
    {
        let a = [i.nome,i.avals[0].nota], totalpres = 0
        let media = i.avals[0].nota
        i.avals.shift()
        for (let j of i.avals)
            a.push({text: j.nota})
        for (let j of i.freqs.split(";"))
            if (j == "1")
                totalpres++
        a.push(datatotal - totalpres)
        a.push(convertToPerc((datatotal - totalpres)*100/datatotal)+ "%")
        a.push(totalpres)
        console.log(totalpres*100/datatotal > 1)
        a.push(convertToPerc(totalpres*100/datatotal)+ "%")
        a.push(((parseFloat(media.replace(",",".")) > 2 && totalpres*100/datatotal > 1) ? "Aprovado" : "Reprovado"))
        aux.push(a)
    }
    wids = [80, 60].concat(wids).concat([50,50,50,50, 80])

    console.log(aux)
    console.log(infosgerais)

    let array = 
    [
        //linha da tabela
        [
            {
                table: 
                {
                    widths: wids,
                    body: aux
                }    
            }
        ]
    ]
    let comeco = [
        {
            text: ["Relatório de Boletim"], color: "#000000", fontSize: 14, alignment: "center",
        },
        {
            text: ["Data: ", d], color: "#000000", fontSize: 12, alignment: "center",
        },
        {
            text: "", margin: [0,5,0,5]
        }
    ]
    let estilos = {
        h1:
        {
            bold: true, margin: [0,0,0,0], fontSize: 10
        },
        header: {
            fillColor: "#6060FF",
            color: "#FFFFFF",
            fontSize: 14,
            alignment: "center",
            margin: [0,0,0,0]
        }
    }
    tabela = {
        table:
        {
            widths: ["*"],
            body: array
        },
        layout: "noBorders"
    }
    
    montarPdf(comeco, tabela, estilos)
}
function montarPdf(comeco, tabela, estilos)
{    
	let conteudo = [
		comeco,
		tabela
    ]
    var pdf1 = {
        content: conteudo,
        styles: estilos,
        pageOrientation: 'landscape',
    }
    let a = pdfMake.createPdf(pdf1)
    a.open()
}
function convertToPerc(valor)
{
    valor = String(valor)
    if (valor.indexOf(".") == -1)
        return valor
    valor = valor.replace(".",",")
    return valor.substring(0, valor.indexOf(",") + 3) 
}