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
	
	case 'login':
		
		try{

			$url = 'http://api.rafafreitas.com';
				      # Our new data
			$data = array(
				'email' => $_POST["login"],
				'senha' => $_POST["senha"],
			);
			$ch = curl_init($url.'/web/usuario/login');

			$postString = http_build_query($data, '', '&');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);

			curl_close($ch);
			$var = json_decode($response);

			if ($var->status == 500) {
				echo $var->result;

			}elseif ($var->status == 200) {
				session_cache_expire(30);
				session_start();

				$_SESSION['UsuarioID'] = $var->usuario->user_id;
				$_SESSION['UsuarioNome'] = $var->usuario->user_nome;
				$_SESSION['UsuarioLogin'] = $var->usuario->user_email;
				$_SESSION['UsuarioNivel'] = $var->usuario->tipo_id;
				$_SESSION['API'] = $url;
				$_SESSION['Token'] = $var->token;

				echo 1;

			}else{
				echo "Ocorreu um erro no servidor!";
			}

		}
		catch(Exception $e){
			echo $e->getmessage();
		}
	
	break;

	default:
		echo "Ocorreu um erro na chamada da função, os parâmetros de ação não foram localizados.";
	break;
}

?>