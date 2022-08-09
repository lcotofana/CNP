<?php
		//returneaza cifra de control caracter 13
	    function cifraControl($sir, $numar = '279146358279') {
	    	$sum = 0;
	    	for ($i=0;$i<strlen($sir);$i++) {
				$sum += $sir[$i] * $numar[$i];
	    	}
	    	$ret = $sum % 11;
	    	if ($ret == 10) {
	    		return 1;
	    	}else {
	    		return $ret;
	    	}
	    }

	    //adauga un 0 inaintea numerelor de la 1 la 9
	    function pad(&$value) {
	    	if (strlen($value)==1) {$value = '0'.$value;}
	    }

	    /**
		 * Validare CNP
		 *
		 * @param string $value
		 * @return boolean
		 */
	    function isCnpValid($value) {
	    	
	    	$vv = array_merge(range(1,46),array(51,52));
			array_walk($vv, 'pad');

	    	//decimal lungime 13
	    	if (preg_match("/\d{13}/", $value)){
	    		if (in_array(substr($value,0,1), array(1,2,3,4,5,6,7,8,9))) {
	    			if (in_array((substr($value,7,2)), $vv)) {
	    				if (preg_match("/^(00[1-9]|0[1-9][0-9]|[1-9][0-9][0-9])$/",substr($value,9,3))){
	    					if (cifraControl(substr($value,0,12)) == substr($value,12,1)) {
	    						return true;
	    					}
	    				}
	    			}	    			
	    		}
	    	}
	    	return false;
	    }