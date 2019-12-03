let datas, mats, freqs = [], hoje
function init()
{
    turma = getJSON("../api/turma/ver.php?" + location.href.split("?")[1])
    datas = getJSON("../api/turma/ver3.php?" + location.href.split("?")[1])[0].datas.split(",")
    mats = getJSON("../api/matricula/listEsp2.php?" + location.href.split("?")[1])
    montar()
}
function enviar()
{
    let t = ""
    for (let i of freqs)
    {
        console.log(i.f[hoje])
        if (t != "") t += ";"
        if (i.f[hoje] == 1)
            i.t = i.t + 1
        t += i.id + "/" + i.f[hoje]
    }
    document.getElementById("hidden").value = t
    document.getElementById("poshj").value = hoje
    document.form.action = "../api/aula/cad.php?" + location.href.split('?')[1]
    document.form.submit()
}
function pesquisar()
{
    var arr = [new Date(2012, 7, 1), new Date(2012, 7, 4), new Date(2012, 7, 5), new Date(2013, 2, 20)];
    var diffdate = new Date(2012, 7, 11);

    arr.sort(function(a, b) {
        var distancea = Math.abs(diffdate - a);
        var distanceb = Math.abs(diffdate - b);
        return distancea - distanceb; // sort a before b when the distance is smaller
    });


    let d1 = document.getElementById("d1").value
    let d2 = document.getElementById("d2").value
    if (d1 != "")
    {
        d1 = d1.split("-")
        d1 = d1[2] + "/" + d1[1]
    }
    if (d2 != "")
    {
        d2 = d2.split("-")
        d2 = d2[2] + "/" + d2[1]
    }
}
function montar()
{
    let t = "", t3 = "<div class='th'>Nomes</div><div class='th'>P./T.</div><div class='th'>Em %</div>"
    d = (new Date)
    d = String(d.getDate()).padStart(2,'0') + "/" + String(d.getMonth()+1).padStart(2,'0')
    // d = "06/09"
    if (datas.indexOf(d) == -1)
    {
        // console.log(4)
        // document.getElementById("btncad").addEventListener()
        // document.getElementById("btncad").style.setProperty("display", "none", "important")
        // document.getElementById("pesq2").style.setProperty("grid-template-columns", "auto auto", "important")
    }
    for (let i = 0; i < datas.length; i++) 
        t += "<div class='td2 th'>" + datas[i] + "</div>"
    document.getElementById("lista").style.setProperty("grid-template-columns", "repeat(" +( datas.length) + ", 1fr)")
    for (let i = 0; i < mats.length; i++) 
    {        
        total = 0
        freqs.push({id: mats[i].id ,f:mats[i].freqs.split(";"), t: parseInt(mats[i].total), d: datas.length})        
        for (let j = 0; j < freqs[i].f.length; j++) 
            if (freqs[i].f[j] == 1)
                total++
        t += ""
        t3 += "<div class='td1 esquerda'>" + mats[i].nome + "</div><div class='td3'>" + total  + "/" + datas.length + "</div><div class='td2 '>"
        calc = String((total  * 100) / datas.length)
        if (calc.indexOf('.') != -1)
        {
            calc = String(calc).replace(".",",")
            calc = calc.substring(0, calc.indexOf(",") + 3)
        }
        t3 += calc + "%</div>"
        console.log(freqs[i].f.length)
        for (let j = 0; j < freqs[i].f.length; j++) 
        {
            if (d != datas[j])
                t += "<div class='td2'>" + ((parseInt(freqs[i].f[j]) == 0) ? "X" : "O") + "</div>"
            else
            {
                hoje = j
                t += "<div class='td2'><input type='checkbox' id='c" + i + "' onclick='marcar(c" + i + "," + j + ")'><label id='l" + i + "'>" + ((parseInt(freqs[i].f[j]) == 0) ? "X" : "O") + "</label></div>"
            }
        }

    }
    document.getElementById("lista").innerHTML = t
    document.getElementById("nomes").innerHTML = t3
    document.getElementById("lista").scrollLeft = 92 * hoje + 150
}   
function voltar()
{
    location.href = "turmaVer.php?" + location.href.split("?")[1] 
}
function marcar(id, pos)
{
    id = id.id.substring(1)
    console.log(id)
    freqs[id].f[pos] = (freqs[id].f[pos] == 0) ? 1 : 0
    document.getElementById("l" + id).innerText = (freqs[id].f[pos] == 0) ? "X" : "O"
    console.log(freqs)
}