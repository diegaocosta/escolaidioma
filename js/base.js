let lastmenuopen = 0
function getJSON(url)
{
	let respost = $.ajax({
		type: "GET",
		url: url,
		async: false
    }).responseText
	  console.log(url)
    console.log(respost)
    // console.log(JSON.parse(respost))
	return JSON.parse(respost)
}
function checarVazio(a)
{
	for (let i of a)
	{
		console.log(i)
		console.log(document.getElementById(i).value)

		if (document.getElementById(i).value == "")
		{
			alert("Campo obrigatório em branco")
			return false
		}
	}
	return true
}
function showmenu(id)
{
	{
		console.log(id)
		console.log(lastmenuopen)
		if (lastmenuopen == 0)
		{
			console.log(8)
			document.getElementById(id).style.setProperty("display", "block", "important")
			lastmenuopen = id
			return
		}
		if (lastmenuopen != id)
		{
			console.log(5)
			document.getElementById(lastmenuopen).style.setProperty("display", "none", "important")
			document.getElementById(id).style.setProperty("display", "block", "important")
			lastmenuopen = id
		}
		else
		{
			console.log(6)
			document.getElementById(id).style.setProperty("display", "none", "important")
			lastmenuopen = 0
	
		}
	}
}
function getEstadoByNum(num)
{
	return "AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO".split(",")[num]
}
function montarEstados()
{
    let estados = "AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO".split(",")
	let t = ""
	let c = 0
    for (let i of estados)
        t += "<option value='" + c++  + "'>" + i + "</option>"
    document.getElementById("estado").innerHTML = t
}
function getMesNome(i)
{
	return "Janeiro,Fevereiro,Março,Abril,Maio,Junho,Julho,Agosto,Setembro,Outubro,Novembro,Dezembro".split(",")[i]
}
function montarMeses()
{
	let nomes = "Janeiro,Fevereiro,Março,Abril,Maio,Junho,Julho,Agosto,Setembro,Outubro,Novembro,Dezembro".split(",")
	let c = 0, t = ""
    for (let i of nomes)
		t += "<option value='" + c++  + "'>" + i + "</option>"
	return t
}
function formatarData(data)
{
	let d = data.split('-')
	return d[2] + "/" + d[1] + "/" + d[0]
}
function mergeArrays(array1, array2)
{	
    const result_array = [];
    const arr = array1.concat(array2);
    let len = arr.length;
    const assoc = {};

    while(len--) {
        const item = arr[len];

        if(!assoc[item]) 
        { 
            result_array.unshift(item);
            assoc[item] = true;
        }
    }

    return result_array;
}
function montarPdf(comeco, tabela, estilos)
{
	let conteudo = [
		comeco,
		tabela
    ]
    var pdf1 = {
        content: conteudo,
        styles: estilos
    }
    let a = pdfMake.createPdf(pdf1)
    a.open()
}