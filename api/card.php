<?php 

//FUNÇÃO ENVIA CURL // http://idea.iteblog.com/key.php
function envia_curl($url, $fields){
  foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
  rtrim($fields_string, '&');
  
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, count($fields));
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
  
  $xml = @simplexml_load_string($result);
  $json = @json_encode($xml);
  $array = @json_decode($json,TRUE);
  if($array){
      return $array;
  }else{
      return $result;    
  }
}

//GERA SESSION ID
$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions";
$fields = array(
  'email' => "pagseguro@rafafreitas.com",
  'token' => "E6D827F59A0A46488AB467A4BDB4A43E"
);

$array = envia_curl($url, $fields);
$pagseguro_session_id = $array['id'];
//$pagseguro_session_id = '';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Gerar Token</title>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<!-- PagSeguro SandBox -->
    <script type="text/javascript" src= "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

	<script type="text/javascript">

		$(document).ready(function(){

			$("#getId").click(function() {
				var cartao_var      = '4485810539414993';
				var validade_Mon    = '11';
				var validade_Ye     = '2018';
				var cvv_var         = '188';
				var brand_var       = "";
				var token_var       = "";

				PagSeguroDirectPayment.setSessionId('<?=$pagseguro_session_id?>');
				console.log('Session_ID: <?=$pagseguro_session_id?>');

				var get_sender_hash = PagSeguroDirectPayment.getSenderHash();
				console.log("Sender_Hash:"+get_sender_hash);
				var id_session_var  = get_sender_hash;

				PagSeguroDirectPayment.getBrand({
					cardBin: cartao_var,
					success: function(response) {
						console.log("response: "+response);
						console.log(response);
						obj = response;
						brand_var = obj["brand"].name;
						console.log("Bandeira: "+brand_var);
					},
					error: function(response) {
						console.log("Erro getBrand: "+response);
					}

				});

				var param = {
					cardNumber: cartao_var,
					cvv: cvv_var,
					brand: brand_var,
					expirationMonth: validade_Mon,
					expirationYear: validade_Ye,
					success: function(response) {
						obj = response;
						console.log("Card-Token: "+obj["card"].token);
						var token_var = obj["card"].token;
					},
					error: function(response) {
						console.log("Erro param: "+response);
						console.log(response);
					},
					complete: function(response) {

					}
				}
				PagSeguroDirectPayment.createCardToken(param);

			});

		});

		



	</script>


</head>
<body>

	<button id="getId">Gerar Token</button>
	
</body>
</html>