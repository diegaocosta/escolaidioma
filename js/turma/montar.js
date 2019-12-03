let matriculas = [], alunos = [], matfromdb = []
function enviar()
{
    if (matriculas.length != 0)
    {
        let t = ""
        for (let i of matriculas)
        {
            if (t != "") t += ","
            t += i.id
        }
        document.getElementById("hidden").value = t
        document.getElementById("id").value = location.href.split("?")[1]
        document.form.submit()
    }
}
function voltar()
{
    location.href = "turmaList.php"
}
function init()
{
    ler()
}
function add(id)
{
    matriculas.push(alunos[id])
    alunos.splice(id,1)
    montarAlunos()
    montarMatriculados()
}
function remove(id)
{
    alunos.push(matriculas[id])
    matriculas.splice(id,1)
    montarAlunos()
    montarMatriculados()    
}
function ler()
{
    el = getJSON("../api/turma/ver2.php?" + location.href.split("?")[1])[0]
    alunos = getJSON("../api/aluno/listSimples.php?1")
    // matfromdb = getJSON("../api/matricula/listEsp.php?" + location.href.split("?")[1])
    matfromdb = getJSON("../api/matricula/listEsp3.php?" + location.href.split("?")[1] + "&" + el.iddocurso)
    for (let i = 0; i < matfromdb.length; i++) 
        for (let j = 0; j < alunos.length; j++) 
            if (matfromdb[i].nome == alunos[j].nome)
            {
                alunos.splice(j,1)
                continue
            }
    montarAlunos()
    montarMatriculados()
    l = "nome,idcurso,idfun".split(",")
    for (let i of l)
    {
        document.getElementById(i).value = el[i]
        document.getElementById(i).disabled = true
    }
}
function montarLista(a, id, n)
{
    let t = "<option value='0'>" + n + "</option>"
    for (let i of a)
        t += "<option value='" + i.id + "'>" + i.nome + "</option>"
    document.getElementById(id).innerHTML = t
}
function montarAlunos()
{
    let t = "", c = 0
    for (let i of alunos)
        t += "<div>" + i.nome + "</div><img src='../recursos/plus.png' alt='' onclick='add(" + c++ + ")'>"
    document.getElementById("lista1").innerHTML = t
}
function montarMatriculados()
{
    let t = "", c = 0
    if (matriculas.length != 0)
        for (let i of matriculas)
            t += "<div>" + i.nome + "</div><img src='../recursos/minus.png' alt='' onclick='remove(" + c++ + ")'>"
    document.getElementById("lista2").innerHTML = t
}