<?php
	include 'connection.php';
	date_default_timezone_set('America/Sao_Paulo');
	function getMesNome($i)
	{
		return explode(",", "Janeiro,Fevereiro,Março,Abril,Maio,Junho,Julho,Agosto,Setembro,Outubro,Novembro,Dezembro")[$i];
	}
	function getIdMax($tabela)
	{
		$query = "select max(id) as total from $tabela";
		// echo $query;
		$result = extrair($query);		
		while($row = $result->fetch_assoc())
			return intval($row["total"])+1;
	}
	function inserir($query)	
	{
		$connect = conexao();
		if ($connect->query($query) === FALSE)
			echo "<br>" . $connect->error . "<br>";
		$connect->close();
	}
	function extrair($query)
	{		
		$connect = conexao();
		$result = $connect->query($query);
		$connect->close();
		return $result;
	}
	function lerColunas($t)
	{
		$connect = conexao();
		$a = array();
		$sql = "SHOW COLUMNS FROM $t";
		$result = mysqli_query($connect,$sql);
		while($row = mysqli_fetch_array($result)){
			array_push($a, $row['Field']);
		}
		return $a;
	}
?>