function mostrarMsg(tipo)
{
	console.log(tipo)
	if (tipo == 0)
	{
		document.getElementById("modal").style.display = "block"
		// document.getElementById("modal").style.setProperty("top", "calc(50vh - " + document.getElementById("modal").offsetHeight + "px - 50px)", "important") 
		console.log(document.body)

		div = document.createElement('div')
		div.className="fundo"		
		div.setAttribute("id", "fundo1");
		document.getElementById("modal").insertAdjacentElement("beforebegin", div); 
	}
}
function cancelar()
{
	document.getElementById("modal").style.display = "none"
	$("#fundo1").remove()
}