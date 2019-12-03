let r, listapdf, receita, despesa, saldo, datanomes
function init()
{
    pesquisar()
}
function pesquisar()
{
    let d1 = document.getElementById("d1").value
    let d2 = document.getElementById("d2").value
    let filtro = document.getElementById("filtro").selectedIndex
    console.log(d1)
    r = getJSON("../api/rel/listSimples.php?" + filtro + "&" + d1 +"&" + d2)
    montar()
}
function dataFormat(d, tipo)
{
    if (d == "TOTAL")
        return "TOTAL"
    d = d.split("-")
    switch (tipo)
    {
        case 0: return d[2] + " de " + getMesNome(parseInt(d[1])-1) + " de " + d[0]
        case 1: return getMesNome(parseInt(d[1])-1) + " de " + d[0]
        case 2: return d[0]
    }
}
function montar()
{
    let t = "";
    listapdf = []
    receita = []
    despesa = []
    saldo = []
    datanomes = []
    // r.pop()
    console.log(r)
    for (let i of r)
    {
        if (i.tipo != 0)
        {
            let t3 = "", tipo = document.getElementById("filtro").selectedIndex, t2 = ""
            switch(tipo)
            {
                case 0: t2 = i.nome; break;
                case 1: t2 = formatarData(i.data); break;
                case 2: t2 = getMesNome(i.nome); break;
            }
            switch(i.tipo)
            {
                case "1": t3 = t2; break
                case "2": t3 = "Total"; break
                case "3": t3 = "TOTAL"; break
            }

            
                let classnome = ((i.tipo == 2 || i.tipo == 3) ? " total " : "" )

                t += "<tr ><td class='td1 " + classnome +  "'>" + t3 + "</td><td class='td2 " + classnome +  "'>" + i.entrada + "</td><td class='td2 " + classnome +  "'>" + i.saida + "</td><td class='td2 " + classnome +  "'>" + i.total + "</td></tr>"
                listapdf.push([((document.getElementById("filtro").selectedIndex == 2 && i.tipo == 1) ? getMesNome(parseInt(i.nome)) : i.nome), i.entrada, i.saida, i.total])
                if (i.tipo == 2)
                {
                    console.log(t2 + " * " + i.entrada + " * " + i.saida + " * " +i.total )
                    receita.push(parseFloat(i.entrada.replace(',','.').substring(3)))
                    despesa.push(parseFloat(i.saida.replace(',','.').substring(3)))
                    saldo.push(parseFloat(i.total.replace(',','.').substring(3)))
                    switch (document.getElementById("filtro").selectedIndex)
                    {
                        case 0: datanomes.push(formatarData(i.data)); break;
                        case 1: datanomes.push(getMesNome(i.data.split("-")[1]-1).toUpperCase().substring(0,3)+ "/" + i.data.split("-")[0].substring(2)); break;
                        case 2: datanomes.push(i.data.split("-")[0]); break;
                    }
                }    
        }
        else
        {
            let t3 = "", tipo = document.getElementById("filtro").selectedIndex
            switch (tipo)
            {
                case 0: t3 = dataFormat(i.nome, 0); break;
                case 1: t3 = dataFormat(i.nome, 1); break;
                case 2: t3 = dataFormat(i.nome, 2); break;
            }
            t += "<tr><th class='td1' colspan='5'>" + t3 + "</th><td class='thn'></td><td class='thn'></td><td class='thn'></td></tr>"
            t += "<tr><th class='td1'>Descrição</th><th class='td2'>Entrada</th><th class='td2'>Saída</th><th class='td2'>Total</th></tr>"
            listapdf.push([{text: dataFormat(i.nome, document.getElementById("filtro").selectedIndex), colSpan: 4, alignment: 'center'},{},{},{}])
        }        
    }
    document.getElementById("lista").innerHTML = t
}
function gerarGrafico()
{
    console.log(datanomes)
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
        series: [{
          name: 'Receita',
          type: 'column',
          data: receita,
          fontSize: '10px',
        }, {
          name: 'Despesa',
          type: 'column',
          data: despesa,
          fontSize: '10px',
        }, {
          name: 'Saldo',
          type: 'line',
          data: saldo,
          fontSize: '10px',
        }],
        stroke: {
          width: [1, 1, 4]
        },
        title: {
          text: 'Relatório Financeiro',
          align: 'left',
          offsetX: 110
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
          horizontalAlign: 'left',
          offsetX: 40
        }
      }
  
      var chart = new ApexCharts(
        document.querySelector("#chart"),
        options
      );
  
  
      chart.render();
    mostrarMsg(0)
}
function gerarPdf()
{
    let d = new Date()
    d = d.getDate() + " de " + getMesNome(parseInt(d.getMonth())) + " de " + d.getFullYear()
    array = listapdf

    let comeco = [
        {
            text: "Relatório de Materiais Cadastrados", style: "header"
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
            widths: ["*", "*", 100, 60],
            body: array
        }
    }
    montarPdf(comeco, tabela, estilos)
}