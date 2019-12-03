<?php
	include 'geralDAO.php';

	$table = "a Matricula";
	$tablename = "matricula";

	$pedaco = "case
	when COLUMN_NAME like 'idaluno' then upper(substring(COLUMN_NAME, 3))
    when COLUMN_NAME like 'idaula' then upper(substring(COLUMN_NAME, 3))
    when COLUMN_NAME like 'idaval' then upper('avaliação')
    when COLUMN_NAME like 'idcurso' then upper(substring(COLUMN_NAME, 3))
    when COLUMN_NAME like 'iddes' then upper('descrição')
    when COLUMN_NAME like 'idfreq' then upper('frequência')
    when COLUMN_NAME like 'idfun' then upper('funcionário')
    when COLUMN_NAME like 'idmatecurso' then upper(substring(COLUMN_NAME, 3))
    when COLUMN_NAME like 'idmate' then upper('material')
    when COLUMN_NAME like 'idmens' then upper('mensalidade')
    when COLUMN_NAME like 'idnota' then upper(substring(COLUMN_NAME, 3))
    when COLUMN_NAME like 'idpag' then upper('pagamento')
    when COLUMN_NAME like 'idrec' then upper('receita')
    when COLUMN_NAME like 'idturma' then upper(substring(COLUMN_NAME, 3))
   	ELSe ''
end as tabela";

	$query = "SELECT ordinal_position, COLUMN_NAME AS nome, upper(COLUMN_TYPE) as tipo, if(IS_NULLABLE = 'NO', 'SIM', 'NÃO') as nulo, if(DATA_TYPE = 'DATE', '1900-01-01 - 9999-12-31', if(DATA_TYPE = 'INT', concat(lpad('',4,'0'),' - ', if(NUMERIC_PRECISION > 4, lpad('',4,'9') , lpad('',NUMERIC_PRECISION,'9'))), 'XXXXXXXX')) as faixa, if(DATA_TYPE = 'DATE', 'XXXX-XX-XX', if(DATA_TYPE = 'INT', 9999, 'XXXXXXXX')) as formato, if(COLUMN_KEY = '','', if(COLUMN_KEY = 'PRI', 'PK', 'FK')) as chave, $pedaco  FROM information_schema.columns WHERE table_schema='escola' AND table_name='$tablename'  
	ORDER BY `ordinal_position` ASC";

	$desc = explode(",","Código,Nome,RG,CPF,Telefone Fixo,Telefone Celular,Data de Nascimento,CEP,Endereço,Dia do Pagamento da Mensalidade,Cidade,Estado,Bairro,Complemento,Nome do Responsável,Telefone do Responsável,Observação,Situação");
	$contador = 0;

	$result = extrair($query);
	// $nomes = array();
	// $tipos = array();
	// $nulos = array();
	// $keys = array();
	echo "<table style='border-spacing: 0'>";
	while($row = $result->fetch_assoc())
	{
		$outronome = "";
		if (strlen($row["nome"]) > 2 && strpos($row["nome"], 'id') !== false)
			$outronome .= "Código de " . ucfirst(strtolower($row["tabela"]));
		else
		{
			$outronome = ucfirst($row["nome"]);
			if ($outronome === "Id")
				$outronome = "Código";
		}

		echo "<tr>";
		echo "<td  style='border: thin solid black'>" . $row["nome"] . "</td>";
		echo "<td  style='border: thin solid black'>" . $outronome . " d$table</td>";
		// echo "<td  style='border: thin solid black'>" . $desc[$contador++] . " d$table</td>";
		echo "<td  style='border: thin solid black'>" . $row["tipo"] . "</td>";
		echo "<td  style='border: thin solid black'>" . $row["formato"] . "</td>";
		echo "<td  style='border: thin solid black'>" . $row["faixa"] . "</td>";
		echo "<td  style='border: thin solid black'>" . $row["nulo"] . "</td>";
		echo "<td  style='border: thin solid black'>" . $row["chave"] . "</td>";
		echo "<td  style='border: thin solid black'>" . $row["tabela"] . "</td>";
		echo "</tr>";
		// array_push($nomes, $row["nome"]);
		// array_push($tipos, $row["tipo"]);
		// array_push($nulos, $row["nulo"]);
		// array_push($keys, $row["Key"]);
	}
	echo "</table>";
	// var_dump($nomes);
	// var_dump($tipos);
	// for ($i=0; $i < ; $i++)
	// {
	// 	$nome = $nomes[$i];
	// 	$tipo = $tipos[$i];
	// 	// $nulo = $tipos[$i];
	// 	// $key = $keys[$i];
		
	// }