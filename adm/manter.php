<?php 
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include "assets_adm/inc/verifica.php";
include "../assets/inc/class.upload.php";
include "assets_adm/inc/functions.php";

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

		  		// curl_setopt($ch, CURLOPT_URL, $url.'/empresa/listAll');
				// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				// 	'Content-Type: application/json',
				// 	'Authorization: ' . $token
				// 	)
				// );

				$data = array(
					'enabled' => $_POST['enabled'], 
				);

				$data = json_encode($data);

				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url.'/web/empresa/listAll');
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_POST, true);
      			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Authorization: ' . $token
					)
				);

				$response = curl_exec($ch);
      			curl_close($ch);

			    $var = json_decode($response);

			    if ($var->status == 500 && $var->qtd == 0) {
			    	//echo $var->result;
			    	echo "[]";
			    }else{
			    	$_SESSION['Token'] = $var->token;
			    	$obj = $var->empresas;
					$json=json_encode($obj);
					echo "$json";
			    }


			} catch (Exception $e) {
				echo $e->getMessage();
			}

		}elseif ($tipoAcao == 'insert') {
			try {

				if (is_uploaded_file($_FILES['company-logo']['tmp_name'])) {

					if (!isset($_SESSION)){session_cache_expire(30);session_start();}

					$token = $_SESSION['Token'];
					$url = $_SESSION['API'];

					$fotoNome = upload_file( 'company-logo', false, '', '', 'empresa', 'company.php');

					$data = array(
						'nome' => $_POST['company-nome'], 
						'telefone' => $_POST['company-telefone'], 
						'cnpj' => $_POST['company-cnpj'], 
						'cep' => $_POST['company-cep'], 
						'lat' => null,
						'long' => null,
						'numero_end' => $_POST['company-numero'], 
						'complemento_end' => $_POST['company-complemento'], 
						'dataFund' => $_POST['company-fundacao'], 
						'facebook' => $_POST['company-facebook'], 
						'instagram' => $_POST['company-instagram'], 
						'twitter' => $_POST['company-twitter'], 
						'foto' => $fotoNome, 
					);

					$data = json_encode($data);

					$ch = curl_init();
			     	curl_setopt($ch, CURLOPT_URL, $url.'/web/empresa/insert');
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_POST, true);
      				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'Content-Type: application/json',
						'Authorization: ' . $token
						)
					);

			      	$response = curl_exec($ch);
	      			curl_close($ch);

				    $var = json_decode($response);
					$json=json_encode($var);
					echo "$json";

				}


			} catch (Exception $e) {
				echo $e->getMessage();
			}

		}elseif($tipoAcao == 'update'){
			try {

				$fotoNome = "";
				
				if (is_uploaded_file($_FILES['company-logo-at']['tmp_name']) ) {

					$fotoNome = upload_file( 'company-logo-at', false, '', '', 'empresa', 'company.php');

				}

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}

				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

				$data = array(
						'idAt' => $_POST['idAt'], 
						'nome' => $_POST['company-nome-at'], 
						'telefone' => $_POST['company-telefone-at'], 
						'cnpj' => $_POST['company-cnpj-at'], 
						'cep' => $_POST['company-cep-at'], 
						'lat' => null,
						'long' => null,
						'numero_end' => $_POST['company-numero-at'], 
						'complemento_end' => $_POST['company-complemento-at'], 
						'dataFund' => $_POST['company-fundacao-at'], 
						'facebook' => $_POST['company-facebook-at'], 
						'instagram' => $_POST['company-instagram-at'], 
						'twitter' => $_POST['company-twitter-at'], 
						'foto' => $fotoNome, 
					);

				$data = json_encode($data);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url.'/web/empresa/update');
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Authorization: ' . $token
					)
				);

				$response = curl_exec($ch);
				curl_close($ch);

				$var = json_decode($response);
				$json=json_encode($var);
				echo "$json";

			} catch (Exception $e) {
				echo $e->getCode();
			}
		}
	break;
	//FimManterEnpresa

	case 'manterFilial':

		if ($tipoAcao == 'listarAll') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

		      	$ch = curl_init();

		     	curl_setopt($ch, CURLOPT_URL, $url.'/filial/listAll');
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Authorization: ' . $token
					)
				);

				$response = curl_exec($ch);

      			curl_close($ch);

			    $var = json_decode($response);

			    if ($var->status == 500) {
			    	echo $var->result;
			    }else{
			    	$_SESSION['Token'] = $var->token;
			    	$obj = $var->filiais;
					$json=json_encode($obj);
					echo "$json";
			    }


			} catch (Exception $e) {
				//echo "\nPDO::errorCode(): ", $e->errorCode();
				//echo $e->getCode();
				echo $e->getMessage();
			}

		}elseif ($tipoAcao == 'insert') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

				$data = array(
					'nome' => $_POST['company-nome'], 
					'telefone' => $_POST['company-telefone'], 
					'cnpj' => $_POST['company-cnpj'], 
					'cep' => $_POST['company-cep'], 
					'lat' => null,
					'long' => null,
					'numero_end' => $_POST['company-numero'], 
					'complemento_end' => $_POST['company-complemento'], 
					'empresa_id' => $_POST['empresa_id'] 
				);

				$data = json_encode($data);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url.'/filial/insert');
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Authorization: ' . $token
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
	//FimManterFilial

	case 'buscaCep':
		if ($tipoAcao == 'listar') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}

				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

				$data = array(
					'cep' => $_POST['cep'], 
				);

				$data = json_encode($data);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url.'/cep');
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Authorization: ' . $token
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

	default:
		echo "Ocorreu um erro na chamada da função, os parâmetros de ação não foram localizados.";
	break;
}

?>