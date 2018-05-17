<?php

function upload_file($input, $resize, $width, $height, $pasta, $retorno){

	
	$handle = new Upload($_FILES["".$input.""]);

	if ($handle->uploaded) {
		
		//Se resize form true, a imagem será redimensionada
		
			$handle->image_resize            = $resize;
			$handle->image_x                 = $width;
			$handle->image_y                 = $height;	
		
		
		$handle->Process('../../api/uploads/'.$pasta);

		if ($handle->processed) {
			$name = $handle->file_dst_name;
			return $name;
			//Retorna o nome da imagem
		} else {			
			//return $handle->error;
		}//Acabou aqui

		$handle-> Clean();

	} else {
		echo "<script> alert('O upload da foto não pôde ser realizado! Erro: ".$handle->error."'); </script>";
		echo "<script> window.location.href='".$retorno."'; </script>";
	}

}

function upload_mult_file($input, $resize, $width, $height, $pasta, $retorno){

	
	$handle = new Upload($input);

	if ($handle->uploaded) {
		
		//Se resize form true, a imagem será redimensionada
		
			$handle->image_resize            = $resize;
			$handle->image_x                 = $width;
			$handle->image_y                 = $height;	
		
		
		$handle->Process('../../api/uploads/'.$pasta);

		if ($handle->processed) {
			$name = $handle->file_dst_name;
			return $name;
			//Retorna o nome da imagem
		} else {			
			//return $handle->error;
		}//Acabou aqui

		$handle-> Clean();

	} else {
		echo "<script> alert('O upload da foto não pôde ser realizado! Erro: ".$handle->error."'); </script>";
		echo "<script> window.location.href='".$retorno."'; </script>";
	}

}

function mask($val, $mask){
	$maskared = '';
	$k = 0;
	for($i = 0; $i<=strlen($mask)-1; $i++){
		if($mask[$i] == '#'){
			if(isset($val[$k])) $maskared .= $val[$k++];
		}
		else{
		if(isset($mask[$i])) $maskared .= $mask[$i];
		}
	}
	return $maskared;
}