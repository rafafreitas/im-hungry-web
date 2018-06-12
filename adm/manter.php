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

					$fotoNome = upload_file( 'company-logo', false, '', '', 'empresa', 'empresas');

					$telefone = str_replace('(', '' , $_POST['company-telefone']);
	        		$telefone = str_replace(')', '' , $telefone);
	        		$telefone = str_replace('-', '' , $telefone);

	        		$cnpj = str_replace('/', '' , $_POST['company-cnpj']);
	        		$cnpj = str_replace('.', '' , $cnpj);
	        		$cnpj = str_replace('-', '' , $cnpj);

					$data = array(
						'nome' => $_POST['company-nome'], 
						'telefone' => $telefone, 
						'cnpj' => $cnpj, 
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

					$fotoNome = upload_file( 'company-logo-at', false, '', '', 'empresa', 'empresas');

				}

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}

				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

				$telefone = str_replace('(', '' , $_POST['company-telefone-at']);
				$telefone = str_replace(')', '' , $telefone);
				$telefone = str_replace('-', '' , $telefone);

				$cnpj = str_replace('/', '' , $_POST['company-cnpj-at']);
				$cnpj = str_replace('.', '' , $cnpj);
				$cnpj = str_replace('-', '' , $cnpj);

				$data = array(
						'idAt' => $_POST['idAt'], 
						'nome' => $_POST['company-nome-at'], 
						'telefone' => $telefone, 
						'cnpj' => $cnpj, 
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

		}elseif ($tipoAcao == 'enabledDisabled') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

		      	$ch = curl_init();

				$data = array(
					'idChange' => $_POST['idChange'], 
					'status' => $_POST['status'] 
				);

				$data = json_encode($data);

				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url.'/web/empresa/enabled');
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
	//FimManterEnpresa

	case 'manterFilial':

		if ($tipoAcao == 'listarAll') {

			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

		      	$ch = curl_init();

				$data = array(
					'enabled' => $_POST['enabled'], 
				);

				$data = json_encode($data);

				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url.'/web/filial/listAll');
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
			    	echo "[]";
			    }else{
			    	$_SESSION['Token'] = $var->token;
			    	$obj = $var->filiais;
					$json=json_encode($obj);
					echo "$json";
			    }

			} catch (Exception $e) {
				echo $e->getMessage();
			}

		}elseif ($tipoAcao == 'insert') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

				$telefone = str_replace('(', '' , $_POST['company-telefone']);
        		$telefone = str_replace(')', '' , $telefone);
        		$telefone = str_replace('-', '' , $telefone);

        		$cnpj = str_replace('/', '' , $_POST['company-cnpj']);
        		$cnpj = str_replace('.', '' , $cnpj);
        		$cnpj = str_replace('-', '' , $cnpj);

				$data = array(
					'nome' => $_POST['company-nome'], 
					'telefone' => $telefone, 
					'cnpj' => $cnpj, 
					'cep' => $_POST['company-cep'], 
					'lat' => null,
					'long' => null,
					'numero_end' => $_POST['company-numero'], 
					'complemento_end' => $_POST['company-complemento'], 
					'empresa_id' => $_POST['empresa_id'] 
				);

				$data = json_encode($data);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url.'/web/filial/insert');
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
			
		}elseif($tipoAcao == 'update'){
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}

				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

				$telefone = str_replace('(', '' , $_POST['company-telefone-at']);
        		$telefone = str_replace(')', '' , $telefone);
        		$telefone = str_replace('-', '' , $telefone);

        		$cnpj = str_replace('/', '' , $_POST['company-cnpj-at']);
        		$cnpj = str_replace('.', '' , $cnpj);
        		$cnpj = str_replace('-', '' , $cnpj);

				$data = array(
						'idAt' => $_POST['idAt'], 
						'empresa_id' => $_POST['empresa_idAt'], 
						'nome' => $_POST['company-nome-at'], 
						'telefone' => $telefone, 
						'cnpj' => $cnpj, 
						'cep' => $_POST['company-cep-at'], 
						'lat' => null,
						'long' => null,
						'numero_end' => $_POST['company-numero-at'], 
						'complemento_end' => $_POST['company-complemento-at']
					);

				$data = json_encode($data);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url.'/web/filial/update');
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

		}elseif ($tipoAcao == 'enabledDisabled') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

		      	$ch = curl_init();

				$data = array(
					'idChange' => $_POST['idChange'], 
					'status' => $_POST['status'] 
				);

				$data = json_encode($data);

				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url.'/web/filial/enabled');
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

		}elseif ($tipoAcao == 'abrirFechar') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

		      	$ch = curl_init();

				$data = array(
					'idChange' => $_POST['idChange'], 
					'status' => $_POST['status'] 
				);

				$data = json_encode($data);

				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url.'/web/filial/status');
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

	case 'manterFidelidade':

		if ($tipoAcao == 'listarAll') {

			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

		      	$ch = curl_init();

				$data = array(
					'status' => $_POST['enabled'], 
					'filial_id' => $_SESSION['filial_id'], 
				);

				$data = json_encode($data);

				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url.'/web/fidelidade/listAll');
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

			    if ($var->status == 500) {
			    	echo "[]";
			    }else{
			    	$obj = $var->fidelidades;
					$json=json_encode($obj);
					echo "$json";
			    }

			} catch (Exception $e) {
				echo $e->getMessage();
			}

		}elseif ($tipoAcao == 'insert') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

				$telefone = str_replace('(', '' , $_POST['company-telefone']);
        		$telefone = str_replace(')', '' , $telefone);
        		$telefone = str_replace('-', '' , $telefone);

        		$cnpj = str_replace('/', '' , $_POST['company-cnpj']);
        		$cnpj = str_replace('.', '' , $cnpj);
        		$cnpj = str_replace('-', '' , $cnpj);

				$data = array(
					'nome' => $_POST['company-nome'], 
					'telefone' => $telefone, 
					'cnpj' => $cnpj, 
					'cep' => $_POST['company-cep'], 
					'lat' => null,
					'long' => null,
					'numero_end' => $_POST['company-numero'], 
					'complemento_end' => $_POST['company-complemento'], 
					'empresa_id' => $_POST['empresa_id'] 
				);

				$data = json_encode($data);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url.'/web/filial/insert');
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
			
		}elseif($tipoAcao == 'update'){
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}

				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

				$telefone = str_replace('(', '' , $_POST['company-telefone-at']);
        		$telefone = str_replace(')', '' , $telefone);
        		$telefone = str_replace('-', '' , $telefone);

        		$cnpj = str_replace('/', '' , $_POST['company-cnpj-at']);
        		$cnpj = str_replace('.', '' , $cnpj);
        		$cnpj = str_replace('-', '' , $cnpj);

				$data = array(
						'idAt' => $_POST['idAt'], 
						'empresa_id' => $_POST['empresa_idAt'], 
						'nome' => $_POST['company-nome-at'], 
						'telefone' => $telefone, 
						'cnpj' => $cnpj, 
						'cep' => $_POST['company-cep-at'], 
						'lat' => null,
						'long' => null,
						'numero_end' => $_POST['company-numero-at'], 
						'complemento_end' => $_POST['company-complemento-at']
					);

				$data = json_encode($data);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url.'/web/filial/update');
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

		}elseif ($tipoAcao == 'enabledDisabled') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

		      	$ch = curl_init();

				$data = array(
					'idChange' => $_POST['idChange'], 
					'status' => $_POST['status'] 
				);

				$data = json_encode($data);

				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url.'/web/filial/enabled');
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

	case 'manterMenu':

		if ($tipoAcao == 'listarAll') {

			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];
				$filial_id = $_SESSION['filial_id'];

		      	$ch = curl_init();

				$data = array(
					'filial_id' => $_SESSION['filial_id'], 
					'enabled' => $_POST['enabled'], 
				);

				$data = json_encode($data);

				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url.'/web/menu/listAll');
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

			    if ($var->status == 500) {
			    	echo "[]";
			    }else{
			    	$obj = $var->menu;
					$json=json_encode($obj);
					echo "$json";
			    }


			} catch (Exception $e) {
				echo $e->getMessage();
			}

		}elseif ($tipoAcao == 'insert') {
			try {

				if (!empty($_FILES['upFilesFotos'])) {

					if (!isset($_SESSION)){session_cache_expire(30);session_start();}

					$token = $_SESSION['Token'];
					$url = $_SESSION['API'];
					$filial_id = $_SESSION['filial_id'];

					$file_ary = array();
		            $file_count = count($_FILES['upFilesFotos']['name']);
		            $file_keys = array_keys($_FILES['upFilesFotos']);

		            for ($i=0; $i<$file_count; $i++) {
		                foreach ($file_keys as $key) {
		                    $file_ary[$i][$key] = $_FILES['upFilesFotos'][$key][$i];
		                }
		            }

		            foreach ($file_ary as $key => $value) {
		                $fotoNome[$key] = upload_mult_file( $value, false, '', '', 'itens', 'menu/'.$filial_id);
		            }

					$data = array(
						'nome' => $_POST['item-nome'], 
						'valor' => $_POST['item-valor'], 
						'tempo' => $_POST['item-tempo'], 
						'promo' => $_POST['item-promo'], 
						'filial_id' => $filial_id, 
						'fotos' => $fotoNome, 
					);

					$data = json_encode($data);

					$ch = curl_init();
			     	curl_setopt($ch, CURLOPT_URL, $url.'/web/menu/insert');
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

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}

				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

				$data = array(
						'nome' => $_POST['item-nome-at'], 
						'valor' => $_POST['item-valor-at'], 
						'tempo' => $_POST['item-tempo-at'], 
						'promo' => $_POST['item-promo-at'], 
						'item_id' => $_POST['idAt'] 
					);

				$data = json_encode($data);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url.'/web/menu/update');
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

		}elseif ($tipoAcao == 'enabledDisabled') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

		      	$ch = curl_init();

				$data = array(
					'idChange' => $_POST['idChange'], 
					'status' => $_POST['status'] 
				);

				$data = json_encode($data);

				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url.'/web/menu/enabled');
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

		}elseif ($tipoAcao == 'addImage') {

			try {

				if (!empty($_FILES['upFilesFotos-at'])) {

					if (!isset($_SESSION)){session_cache_expire(30);session_start();}

					$token = $_SESSION['Token'];
					$url = $_SESSION['API'];
					$item_id = $_POST['id'];
					$filial_id = $_SESSION['filial_id'];

	                $files = array(); 
					foreach ($_FILES['upFilesFotos-at'] as $k => $l) {
						foreach ($l as $i => $v) {
							if (!array_key_exists($i, $files)) $files[$i] = array();
							$files[$i][$k] = $v;
						}
					}

					foreach ($files as $file) {
						$imgNome = upload_mult_file( $file, false, '', '', 'itens', 'menu/'.$filial_id);
					}

					$data = array(
						'item_id' => $item_id, 
						'foto' => $imgNome, 
					);

					$data = json_encode($data);

					$ch = curl_init();
			     	curl_setopt($ch, CURLOPT_URL, $url.'/web/item/foto');
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

		}elseif ($tipoAcao == 'delImage') {

			$enabled = ($_POST['flag'] == 'true') ? true : false;

			if ($enabled) {

				try {

					if (!isset($_SESSION)){session_cache_expire(30);session_start();}

					$token = $_SESSION['Token'];
					$url = $_SESSION['API'];
					$item_id = $_POST['item_id'];
					$fot_id = $_POST['fot_id'];

					$data = array(
						'item_id' => $item_id, 
						'fot_id' => $fot_id
					);

					$data = json_encode($data);

					$ch = curl_init();
			     	curl_setopt($ch, CURLOPT_URL, $url.'/web/item/foto/del');
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
				
			}else{
				echo "{}";
				die;
			}

		}
	break;
	//FimManterMenu

	case 'manterFuncionario':

		if ($tipoAcao == 'listarAll') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

		      	$ch = curl_init();

				$data = array(
					'enabled' => $_POST['enabled'], 
					'tipo_usuario' => "2",
					'filial_id' => $_SESSION['filial_id'],
				);

				$data = json_encode($data);

				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url.'/web/usuario/listAll');
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
			    	echo "[]";
			    }else{
			    	$obj = $var->funcionarios;
					$json=json_encode($obj);
					echo "$json";
			    }


			} catch (Exception $e) {
				echo $e->getMessage();
			}

		}elseif ($tipoAcao == 'insert') {
			try {

				if (is_uploaded_file($_FILES['funcionario-foto']['tmp_name'])) {

					if (!isset($_SESSION)){session_cache_expire(30);session_start();}

					$token = $_SESSION['Token'];
					$url = $_SESSION['API'];

					$fotoNome = upload_file( 'funcionario-foto', false, '', '', 'funcionarios', 'meus-funcionarios');

					$telefone = str_replace('(', '' , $_POST['funcionario-telefone']);
	        		$telefone = str_replace(')', '' , $telefone);
	        		$telefone = str_replace('-', '' , $telefone);

	        		$cpf = str_replace('.', '' , $_POST['funcionario-cpf']);
	        		$cpf = str_replace('-', '' , $cpf);

					$data = array(
						'nome' => $_POST['funcionario-nome'], 
						'cpf' => $cpf, 
						'email' => $_POST['funcionario-email'], 
						'data' => $_POST['funcionario-data'], 
						'cep' => $_POST['funcionario-cep'], 
						'telefone' => $telefone, 
						'numero_end' => $_POST['funcionario-numero'], 
						'complemento' => $_POST['funcionario-complemento'], 
						'enabled' => "true", 
						'tipo_usuario' => "2",
						'filial_id' => $_SESSION['filial_id'],
						'foto_perfil' => $fotoNome
					);

					$data = json_encode($data);

					$ch = curl_init();
			     	curl_setopt($ch, CURLOPT_URL, $url.'/web/funcionario/insert');
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
				
				if (is_uploaded_file($_FILES['funcionario-foto-at']['tmp_name']) ) {
					$fotoNome = upload_file( 'funcionario-foto-at', false, '', '', 'funcionarios', 'meus-funcionarios');
				}

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}

				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

				$telefone = str_replace('(', '' , $_POST['funcionario-telefone-at']);
				$telefone = str_replace(')', '' , $telefone);
				$telefone = str_replace('-', '' , $telefone);

				$cpf = str_replace('.', '' , $_POST['funcionario-cpf-at']);
				$cpf = str_replace('-', '' , $cpf);

				$data = array(
					'idAt' => $_POST['idAt'], 
					'nome' => $_POST['funcionario-nome-at'], 
					'cpf' => $cpf, 
					'telefone' => $telefone, 
					'data' => $_POST['funcionario-data-at'], 
					'email' => $_POST['funcionario-email-at'], 
					'cep' => $_POST['funcionario-cep-at'], 
					'numero_end' => $_POST['funcionario-numero-at'], 
					'complemento' => $_POST['funcionario-complemento-at'], 
					'foto_perfil' => $fotoNome
				);

				$data = json_encode($data);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url.'/web/usuario/update');
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

		}elseif ($tipoAcao == 'enabledDisabled') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

		      	$ch = curl_init();

				$data = array(
					'idChange' => $_POST['idChange'], 
					'status' => $_POST['status'] 
				);

				$data = json_encode($data);

				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url.'/web/usuario/enabled');
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
	//FimManterFuncionario

	case 'manterPedidos':
		if ($tipoAcao == 'listarAll') {
			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

		      	$ch = curl_init();

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

		}
	break;
	//FimManterPedidos

	case 'manterGraficos':

		// curl_setopt($ch, CURLOPT_URL, $url.'/empresa/listAll');
		// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		// 	'Content-Type: application/json',
		// 	'Authorization: ' . $token
		// 	)
		// );
	break;
	//FimManterGraficos

	case 'manterPerfil':
		if ($tipoAcao == 'update') {
			try {

				$fotoNome = "";
				
				if (is_uploaded_file($_FILES['perfil-foto']['tmp_name']) ) {

					$fotoNome = upload_file( 'perfil-foto', false, '', '', 'usuarios', 'meu-perfil');

				}

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}

				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];

				$telefone = str_replace('(', '' , $_POST['perfil-telefone']);
				$telefone = str_replace(')', '' , $telefone);
				$telefone = str_replace('-', '' , $telefone);

				$cpf = str_replace('/', '' , $_POST['perfil-cpf']);
				$cpf = str_replace('.', '' , $cpf);
				$cpf = str_replace('-', '' , $cpf);

				$data = array(
						'idAt' => $_SESSION['UsuarioID'], 
						'nome' => $_POST['perfil-nome'], 
						'telefone' => $telefone, 
						'cpf' => $cpf, 
						'data' => $_POST['perfil-data'], 
						'email' => $_POST['perfil-email'], 
						'cep' => $_POST['perfil-cep'], 
						'numero_end' => $_POST['perfil-numero'], 
						'complemento' => $_POST['perfil-complemento'], 
						'foto_perfil' => $fotoNome 
					);

				$data = json_encode($data);

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url.'/web/usuario/update');
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
		
		}elseif ($tipoAcao == 'getInfo') {

			try {

				if (!isset($_SESSION)){session_cache_expire(30);session_start();}
				
				$token = $_SESSION['Token'];
				$url = $_SESSION['API'];
				$user_id = $_SESSION['UsuarioID'];

		      	$ch = curl_init();

				$data = array(
					'user_id' => $_SESSION['UsuarioID'], 
				);

				$data = json_encode($data);

				$ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, $url.'/web/usuario/perfil');
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
	//FimBuscaCep

	default:
		echo "Ocorreu um erro na chamada da função, os parâmetros de ação não foram localizados.";
	break;
}

?>