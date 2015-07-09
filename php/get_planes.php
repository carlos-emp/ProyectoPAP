<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

class plan {

	public function get_additional($prefijo){

		$i = 0;
		$todo = array();
		$directorio = opendir("../../../../../../intellibanks/data/EmpowerLabsIntellibanks/ProyectoPAP");
		//ruta actual
		while ($archivo = readdir($directorio))//obtenemos un archivo y luego otro sucesivamente
		{
			if (is_dir($archivo))//verificamos si es o no un directorio
			{
				//echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
			} else {
				chmod($archivo, 0755);
				//el servidor le da los permisos para que pueda leer los archivos solo leer
				$pos = strpos($archivo, $prefijo);
				//lee solo los archivos que empiesen con PAP-E y los demas los omite
				$pos2 = strpos($archivo, ",v");
				//omite los archivos txt con terminacion  "v"
				$pos3 = strpos($archivo, ".lease");
				$sub = substr($archivo, 0, -4);
				$tam = strlen($sub);
				if ($pos !== false && $pos2 === false && $pos3 === false && $tam == strlen($prefijo)) {
					$campos = explode('%META:FORM{name="PAPAxisForm"}%', file_get_contents("../../../../../../intellibanks/data/EmpowerLabsIntellibanks/ProyectoPAP/" . $archivo));
					$n = count($campos);
					$campo = explode('%META:FIELD{', $campos[$n - 1]);
					
					$Area = explode('"', $campo[1]);
					$Pilot = explode('"', $campo[4]);
					
					$todo=array("Area"=>utf8_encode($Area[7]),"Pilot"=>utf8_encode($Pilot[7]));
					
				}
			}
		}

		
		return $todo;
	

}

	public function get_data($prefijo, $long, $iteracion,$padre,$pilot) {

		$todo = array();
		$prefijos = array();

		$i = 0;
		$directorio = opendir("../../../../../../intellibanks/data/EmpowerLabsIntellibanks/ProyectoPAP");
		//ruta actual
		while ($archivo = readdir($directorio))//obtenemos un archivo y luego otro sucesivamente
		{
			if (is_dir($archivo))//verificamos si es o no un directorio
			{
				//echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
			} else {
				chmod($archivo, 0755);
				//el servidor le da los permisos para que pueda leer los archivos solo leer
				$pos = strpos($archivo, $prefijo);
				//lee solo los archivos que empiesen con PAP-E y los demas los omite
				$pos2 = strpos($archivo, ",v");
				//omite los archivos txt con terminacion  "v"
				$pos3 = strpos($archivo, ".lease");

				$sub = substr($archivo, 0, -4);
				$tam = strlen($sub);

				if ($pos !== false && $pos2 === false && $pos3 === false && $tam == $long) {
					$campos = explode('%META:FORM{name="PAPAxisForm"}%', file_get_contents("../../../../../../intellibanks/data/EmpowerLabsIntellibanks/ProyectoPAP/" . $archivo));
					$n = count($campos);
					$campo = explode('%META:FIELD{', $campos[$n - 1]);

					$Title = explode('"', $campo[1]);
					$Description = explode('"', $campo[2]);
			
					$Timing = explode('"', $campo[4]);
					$Owner = explode('"', $campo[5]);
					$Owner2 = explode('"', $campo[6]);
					$Owner3 = explode('"', $campo[7]);
					$Team = explode('"', $campo[8]);
					$Player_Now = explode('"', $campo[9]);
					$Status = explode('"', $campo[10]);
					$PercentComplete = explode('"', $campo[11]);
					$Priority = explode('"', $campo[12]);
					$Metric = explode('"', $campo[13]);
					$Business_Impact = explode('"', $campo[14]);
					$StartDate = explode('"', $campo[15]);
					$TargetCloseDate = explode('"', $campo[16]);
					$Area = explode('"', $campo[17]);
					$Jerarquia = explode('"', $campo[18]);

					
			
						$principal = $this -> get_data($sub, $long+3,$iteracion+1,$sub,$pilot);

						$todo[] = array("ID"=>$sub,"Parent"=>$padre,"Title" => utf8_encode($Title[7]), "Description" => utf8_encode($Description[7]), "Pilot" => utf8_encode($pilot), "Timing" => utf8_encode($Timing[7]),"Owner" => utf8_encode($Owner[7]), "Owner2" => utf8_encode($Owner2[7]), "Owner3" => utf8_encode($Owner3[7]), "Pilot" => utf8_encode($pilot), "Team:" => utf8_encode($Team[7]),"Player_Now" => utf8_encode($Player_Now[7]), "Status" => utf8_encode($Status[7]), "PercentComplete" => utf8_encode($PercentComplete[7]), "Priority" => utf8_encode($Priority[7]), "Metric" => utf8_encode($Metric[7]), "Bussiness_Impact" => utf8_encode($Business_Impact[7]), "StartDate" => utf8_encode($StartDate[7]), "TargetCloseDate" => utf8_encode($TargetCloseDate[7]), "Harea" => utf8_encode($Area[7]), "Jerarquia" => utf8_encode($Jerarquia[7]), "Hijos" => $principal);

				

					//$prefijos[] = $sub;

				}
			}
		}

		//echo json_encode($todo);
		return $todo;

	}

	public function get_general($prefijo, $long) {

		$todo = array();
		$prefijos = array();

		$i = 0;
		$directorio = opendir("../../../../../../intellibanks/data/EmpowerLabsIntellibanks/ProyectoPAP");
		//ruta actual
		while ($archivo = readdir($directorio))//obtenemos un archivo y luego otro sucesivamente
		{
			if (is_dir($archivo))//verificamos si es o no un directorio
			{
				//echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
			} else {
				chmod($archivo, 0755);
				//el servidor le da los permisos para que pueda leer los archivos solo leer
				$pos = strpos($archivo, $prefijo);
				//lee solo los archivos que empiesen con PAP-E y los demas los omite
				$pos2 = strpos($archivo, ",v");
				//omite los archivos txt con terminacion  "v"
				$pos3 = strpos($archivo, ".lease");

				$sub = substr($archivo, 0, -4);
				$tam = strlen($sub);

				if ($pos !== false && $pos2 === false && $pos3 === false && $tam == $long) {
					$campos = explode('%META:FORM{name="PAPAxisForm"}%', file_get_contents("../../../../../../intellibanks/data/EmpowerLabsIntellibanks/ProyectoPAP/" . $archivo));
					$n = count($campos);
					$campo = explode('%META:FIELD{', $campos[$n - 1]);

					$Title = explode('"', $campo[1]);
					$Description = explode('"', $campo[2]);
					$Owner = explode('"', $campo[3]);
					$Player_Now = explode('"', $campo[4]);
					$Timing = explode('"', $campo[5]);
					$Status = explode('"', $campo[6]);
					$PercentComplete = explode('"', $campo[7]);
					$Priority = explode('"', $campo[8]);
					$Metric = explode('"', $campo[9]);
					$Business_Impact = explode('"', $campo[10]);
					$StartDate = explode('"', $campo[11]);
					$TargetCloseDate = explode('"', $campo[12]);
					$Area = explode('"', $campo[13]);
					$Jerarquia = explode('"', $campo[14]);

					$additional=$this->get_additional($Owner[7]);
					$area=$additional["Area"];
					$pilot=$additional["Pilot"];
					
					
				
					$principal = $this -> get_data($sub, 10,1,$sub,$pilot);

					$todo[] = array("ID"=>$sub,"Title" => utf8_encode($Title[7]), "Description" => utf8_encode($Description[7]), "Owner" => utf8_encode($Owner[7]), "Pilot" => utf8_encode($pilot),"Player_Now" => utf8_encode($Player_Now[7]), "Timing" => utf8_encode($Timing[7]), "Status" => utf8_encode($Status[7]), "PercentComplete" => utf8_encode($PercentComplete[7]), "Priority" => utf8_encode($Priority[7]), "Metric" => utf8_encode($Metric[7]), "Bussiness_Impact" => utf8_encode($Business_Impact[7]), "StartDate" => utf8_encode($StartDate[7]), "TargetCloseDate" => utf8_encode($TargetCloseDate[7]), "Harea" => utf8_encode($area), "Jerarquia" => utf8_encode($Jerarquia[7]), "Hijos" => $principal);

				}
			}
		}

		echo json_encode($todo);

	}

	public function get_main() {
		$prefijo = "PAP-E";
		$long = 7;
		$proyectos = $this -> get_data($prefijo, $long);
		return $proyectos;
	}

	public function get_father() {
		$proyectos = $this -> get_main();
		$padres = array();
		for ($i = 0; $i < count($proyectos); $i++) {
			$padres[] = array($proyectos[$i] => $this -> get_data($proyectos[$i], 10));
		}

		return $padres;

	}

	public function get_child() {
		$padres = $this -> get_father();
		$hijos = array();
		for ($i = 0; $i < count($padres); $i++) {

			for ($j = 0; $j < count($padres[$i]); $j++) {

				$padres1 = $padres[$i];
				$hijos[] = array($padres1[$j] => $this -> get_data($padres1[$j], 13));

			}

		}

		var_dump($hijos);
	}

}

$plan = new plan();
$plan -> get_general("PAP-E", 7);
?>
