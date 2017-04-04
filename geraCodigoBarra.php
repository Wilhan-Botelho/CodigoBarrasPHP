<?php
	function geraCodigoBarra($texto) {
		$texto = ((strlen($texto) % 2) <> 0) ? $texto = '0' . $texto : $texto;
		$fino = 4;
		$largo = 8;
		$altura = 80;
		$padding = 5;
		$barcodes = array('00110', '10001', '01001', '11000', '00101', '10100', '01100', '00011', '10010','01010');

		for ($f1=9;$f1>=0;$f1--){
		    for ($f2=9;$f2>=0;$f2--) {
				$f = ($f1 * 10) + $f2;
				$tmp = '';
				for ($i = 1; $i < 6; $i++) {
					$tmp .= substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
				}
				$barcodes[$f] = $tmp;
		    }
		}
		
		$largura = (6*$fino)+(1*$largo) + (2*$padding);
		$txtTmp = $texto;
		while (strlen($txtTmp) > 0) {
			$i = round(substr($txtTmp, 0, 2));
			$txtTmp = substr($txtTmp, strlen($txtTmp) - (strlen($txtTmp) - 2), (strlen($txtTmp) - 2));
			$f = $barcodes[$i];
			for ($i = 1; $i < 11; $i += 2) {
				$largura += (substr($f, ($i - 1), 1) == '0') ? $fino : $largo;
				$largura += (substr($f, $i, 1) == '0') ? $fino : $largo;
			}
		}
		
		$img = imagecreatetruecolor($largura,$altura);
		$l_preta = imagecolorallocate($img, 0, 0, 0); 
		$l_branca = imagecolorallocate($img, 255, 255, 255);		
		$pos = $padding;
		
		imagefilledrectangle($img, 0,0,$largura,$altura,$l_branca);
		imagefilledrectangle($img, $pos,$padding,$pos-1+$fino,$altura-$padding,$l_preta);
		$pos += $fino;
		imagefilledrectangle($img, $pos,$padding,$pos-1+$fino,$altura-$padding,$l_branca);
		$pos += $fino;
		imagefilledrectangle($img, $pos,$padding,$pos-1+$fino,$altura-$padding,$l_preta);
		$pos += $fino;
		imagefilledrectangle($img, $pos,$padding,$pos-1+$fino,$altura-$padding,$l_branca);
		$pos += $fino;
		
		while (strlen($texto) > 0) {
		    $i = round(substr($texto, 0, 2));
		    $texto = substr($texto, strlen($texto) - (strlen($texto) - 2), (strlen($texto) - 2));
		    $f = $barcodes[$i];

		    for ($i = 1;$i<11;$i+=2) {
				$f1 = (substr($f, ($i - 1), 1) == '0') ? $fino : $largo;
				$f2 = (substr($f, $i, 1) == '0') ? $fino : $largo;

                imagefilledrectangle($img, $pos,$padding,$pos-1+$f1,$altura-$padding,$l_preta);
				$pos += $f1;
                imagefilledrectangle($img, $pos,$padding,$pos-1+$f2,$altura-$padding,$l_branca);
				$pos += $f2;
            }
        }
        imagefilledrectangle($img, $pos,$padding,$pos-1+$largo,$altura-$padding,$l_preta); 
		$pos += $largo;
		imagefilledrectangle($img, $pos,$padding,$pos-1+$fino,$altura-$padding,$l_branca); 
		$pos += $fino;
		imagefilledrectangle($img, $pos,$padding,$pos-1+$fino,$altura-$padding,$l_preta); 
		$pos += $fino;
		
		ob_start();
		imagegif( $img );
		imagedestroy($img);
		$imgData = ob_get_contents();
		ob_end_clean();
		return base64_encode( $imgData );
    }
?>
