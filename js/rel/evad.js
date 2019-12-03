let idaluno, lista
function init()
{
    $('#pesq').bind("keyup", pesquisar)
    document.getElementById("status").selectedIndex = 1
    document.getElementById("status").addEventListener("change", function(){ler()})
    ler()
}
function montar()
{
    let t = "", contador = 0
    ths = "Aluno,Motivos,Data,Ações".split(",")
    for (let i of ths)
    t += "<label class='th'>" + i.toUpperCase() +  "</label>"
    for (let i of lista)
    {
        t += "<label class=' first'>" + i.nome + "</label>"
        t += "<label>" + i.total + "</label>"
        t += "<label>" + formatarData(i.data) + "</label>"
        t += "<div class='direita last'>"
        t += "<a onclick='ver(" + contador++ + ")'>Ver</a>"
        t += "</div>"
    }
    document.getElementById("lista").innerHTML = t
}
function ler()
{
    lista = getJSON("../api/rel/evadList.php?")
    montar()
}
function ver(id)
{
    mostrarMsg(0)
    for (let i = 0; i < 6; i++) 
        document.getElementById("m" + i).checked = (lista[id].motivos[i] == 1) ? true : false
    document.getElementById("outros").value = lista[id].outros
}
function pesquisar()
{
    let p = document.getElementById("pesq").value
    lista = getJSON("../api/rel/evadList.php?" + p)
    montar()
}
function gerarGrafico()
{
    let aux = [], contador = 0
    for (let i of lista)
    {
        let d = i.data.split("-")
        if (aux.length == 0)
        {
            let aux2 = [0,0,0,0,0,0]
            for (let k = 0; k < 6; k++) 
                if (i.motivos[k] == 1)
                    aux2[k]++
            aux.push({d: d[1] + "/" + d[0], motivos: aux2})
        }
        else
        {
            let total = 0
            for (let j of aux)
                if (j.d == d[1] + "/" + d[0])
                {
                    for (let k = 0; k < 6; k++) 
                        if (i.motivos[k] == 1)
                            j.motivos[k]++
                }
                else
                    total++
            if (total == aux.length)
            {
                let aux2 = [0,0,0,0,0,0]
                for (let k = 0; k < 6; k++) 
                    if (i.motivos[k] == 1)
                        aux2[k]++
                aux.push({d: d[1] + "/" + d[0], motivos: aux2})
            }
        }
    }
    montarGrafico(aux)
}
function montarGrafico(lista)
{
    datanomes = [], a0 = [], a1 = [], a2 = [], a3 = [], a4 = [], a5 = [] 
    console.log(lista)
    for (let i of lista)
    {
        datanomes.push(i.d)
        a0.push(i.motivos[0])
        a1.push(i.motivos[1])
        a2.push(i.motivos[2])
        a3.push(i.motivos[3])
        a4.push(i.motivos[4])
        a5.push(i.motivos[5])
    }

    var options = {
        chart: {
          height: 360,
          type: 'line',
          stacked: false
        },
        dataLabels: {
          enabled: false,
          name: {
              fontSize: "10px"
          }
        },
        series: 
        [
            {
                name: 'Desconexão com o curso',
                type: 'column',
                data: a0,
                fontSize: '10px',
            }, 
            {
                name: 'Desempenho acadêmico',
                type: 'column',
                data: a1,
                fontSize: '10px',
            }, 
            {
                name: 'Dificuldades financeiras',
                type: 'column',
                data: a2,
                fontSize: '10px',
            }, 
            {
                name: 'Localização',
                type: 'column',
                data: a3,
                fontSize: '10px',
            }, 
            {
                name: 'Oportunidades de emprego',
                type: 'column',
                data: a4,
                fontSize: '10px',
            }, 
            {
                name: 'Outros',
                type: 'column',
                data: a5,
                fontSize: '10px',
            }, 
        ],
        stroke: {
          width: [1, 1, 1,1,1,1]
        },
        xaxis: {
          categories: datanomes
        },
        yaxis: [
          {
            axisTicks: {
              show: true,
            },
            axisBorder: {
              show: true,
              color: '#8080ff'
            },
            labels: {
              style: {
                color: '#8080ff',
              }
            },
            tooltip: {
              enabled: true
            }
          }
        ],
        tooltip: {
          fixed: {
            enabled: true,
            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
            offsetY: 30,
            offsetX: 60
          },
        },
        legend: {
            position: 'right',
        }
      }
  
      var chart = new ApexCharts(
        document.querySelector("#chart"),
        options
      );
  
  
      chart.render();
    mostrarMsg(1)
}
function gerarPdf()
{
    let d = new Date()
    d = d.getDate() + " de " + getMesNome(parseInt(d.getMonth())) + " de " + d.getFullYear()

    let array = []
    array.push([{style: "th", text: "Aluno"},
    {style: ["th"], text: "Motivos"},
    {style: ["th"], text: "Data"}])

    for (let i of lista)
    {
        let total = 0
        for (let j = 0; j < 6; j++) 
            if (i.motivos[j]==1)
                total++
        array.push(
            [i.nome, i.total , formatarData(i.data)]
        )
    }

    let comeco = [
        {
            text: "Relatório de Evasão", style: "header"
        },
        {
            text: ["Data: ", d], style: "header", fontSize: 14
        }
    ]
    let estilos = {
        th: {
            alignment: 'center',
            color: "white",
            fillColor: "#4e73df",
            fontSize: 12
        },
        header: {
            bold: true,
            fontSize: 18,
            alignment: "center",
            margin: [0, 10, 0, 5]
        }
    }
    tabela = {
        table:
        {
            widths: ["*", 60, 100],
            body: array
        }
    }
    montarPdf(comeco, tabela, estilos)
}
function mostrarMsg(tipo)
{
	console.log(tipo)
	
		document.getElementById("modal" + tipo).style.display = "block"
		console.log(document.body)

		div = document.createElement('div')
		div.className="fundo"		
		div.setAttribute("id", "fundo" + tipo);
		document.getElementById("modal" + tipo).insertAdjacentElement("beforebegin", div); 
	
}
function cancelar(tipo)
{
    console.log(tipo)
	document.getElementById("modal" + tipo).style.display = "none"
	$("#fundo" + tipo).remove()
}