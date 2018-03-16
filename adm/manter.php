<?php 

include "includes/verifica.php";

$acao = $_POST["acao"];
$tipoAcao = $_POST["tipoAcao"];

switch ($acao) {
	
	case 'manterEmpresa':

		if ($tipoAcao == 'listarAll') {
			try {

				$_SESSION['Token'];
				

				$url = $_SESSION['API'];
		      	# Our new data
		      	$headers = array(
			    'Accept: application/json',
			    'Content-Type: application/json',
			    'Authorization: '
			    );
		      	$ch = curl_init($url.'/empresa/listAll');

		      	# Form data string
		      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		      	$response = curl_exec($ch);
		      	
		      	curl_setopt($ch, CURLOPT_URL, $this->service_url.'user/'.$id_user);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_HEADER, 0);

				//$body = '{}';
				//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
				//curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


				$ch = curl_init();
    $headers = array(
    'Accept: application/json',
    'Content-Type: application/json',

    );
    curl_setopt($ch, CURLOPT_URL, $this->service_url.'user/'.$id_user);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $body = '{}';

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $authToken = curl_exec($ch);

		      	curl_close($ch);
		      	$var = json_decode($response);

			    if ($var->status == 500) {
			    	echo $var->result;
			    }

				$json=json_encode($result);
				echo "$json";

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