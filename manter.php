<?php 
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

$acao = $_POST["acao"];
$tipoAcao = $_POST["tipoAcao"];

switch ($acao) {
	
	case 'manterRegister':

		if ($tipoAcao == 'insert') {
			try {

				$url = "http://api.rafafreitas.com";

        		$data = array(
					'nome' => $_POST['register-nome'],
					'email' => $_POST['register-email'], 
					'senha' => $_POST['register-senha-1'], 
					'fot64' => "wait",
					'tipo_usuario' => "1",
					'enabled' => "1"
				);

				$data = json_encode($data);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url.'/web/adm/insert');
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json'
				)

			);

				$response = curl_exec($ch);
				curl_close($ch);

				$var = json_decode($response);
				$json=json_encode($var);
				echo "$json";

			} catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}
	break;
	//FimManterRegister

	default:
		echo "Ocorreu um erro na chamada da função, os parâmetros de ação não foram localizados.";
	break;
}

?>