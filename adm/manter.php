<?php 

include "includes/verifica.php";

$acao = $_POST["acao"];
$tipoAcao = $_POST["tipoAcao"];

switch ($acao) {
	
	case 'manterEmpresa':

		if ($tipoAcao == 'listarAll') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

		      	$ch = curl_init();

		     	curl_setopt($ch, CURLOPT_URL, $url.'/empresa/listAll');
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
				    'Content-Type: application/json',                                                                                
				    'Authorization: ' . $token)                                                                       
				);                                                                                                                   
		      	
		      	$response = curl_exec($ch);
      			curl_close($ch);

			    $var = json_decode($response);

			    if ($var->status == 500) {
			    	echo $var->result;
			    }else{
			    	$obj = $var->empresas;
					$json=json_encode($obj);
					echo "$json";
			    }


			} catch (Exception $e) {
				//echo "\nPDO::errorCode(): ", $e->errorCode();
				//echo $e->getCode();
				echo $e->getMessage();
			}

		}

	break;
	//FimManterUsuario

	default:
		echo "Ocorreu um erro na chamada da função, os parâmetros de ação não foram localizados.";
	break;
}

?>