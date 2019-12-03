function validarTexto(event)
{
    var value = String.fromCharCode(event.which);
    var pattern = new RegExp(/[a-záàãéêíïóúõç ]/i);
    return pattern.test(value);
}
function verifiarCamposVazios(nomes)
{
    console.log()
    for (let i of nomes)
    {
        console.log(i)
        console.log(document.getElementById(i).value)
        if (document.getElementById(i).value == "")
        {
            alert("Campos obrigátorios não preenchido")
            return false
        }
    }
    return true
}
function validarEntradaEmail(email)
{
    if (email.indexOf("@")== -1)
    {
        alert("Email informado incorretamente.")
        return false
    }
    else
    {
        email = email.split("@")[1]
        if (email.indexOf(".") == -1)
        {            
            alert("Email informado incorretamente.")
            return false
        }
    }
    return true
}
function validarInteiro(event) {
    var value = String.fromCharCode(event.which);
    var pattern = new RegExp(/[0-9]/i);
    return pattern.test(value);
}
function validarDecimal(event) {
    var value = String.fromCharCode(event.which);
    var pattern = new RegExp(/[0-9,]/i);
    return pattern.test(value);
}
function removeCommas(e)
{
    s = e.target.value
    if (s.indexOf(",") == -1)
        return
    else
    {
        s = s.split(",")[1]
        p = s.split(",")[0]
        console.log(s)
        if (s.indexOf(",") != -1)
        {
            console.log()
            document.getElementById("sanvalor").value = p + "," + s.substring(0, s.indexOf(","))
        }
        else
            console.log(s)
    }
}
function validarEmail(event) {
    var value = String.fromCharCode(event.which);
    var pattern = new RegExp(/[a-z.@_-]/i);
    return pattern.test(value);
}