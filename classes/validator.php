<?php
	class Validator
	{

		public function checkRequired($required_fields){

			$errors = array();

			foreach($required_fields as $field){
				if($_POST){
					if(empty($_POST[$field]) || (!isset($_POST[$field]))){
						$fieldEmpty = "Feltet " . $field . " er ikke udfyldt!";
						$errors[] = $fieldEmpty;
					}
				}elseif($_GET){
					if(empty($_GET[$field]) || (!isset($_GET[$field]))){
						$fieldEmpty = "Feltet " . $field . " er ikke udfyldt!";
						$errors[] = $fieldEmpty;
					}
				}else {
					if(empty($field) || (!isset($field))){
						$fieldEmpty = "Udfyld venligst alle felter!";
						$errors[] = $fieldEmpty;
					}
				}
			}
			return $missingFields = implode("<br>", $errors);
			// return $errors;
		}

		public function checkEmail($email){
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				return "Indholdet af feltet skal være en korrekt e-mail adresse!";
			}
		}

		public function checkInt($number){
			if(!filter_var($number, FILTER_VALIDATE_INT)){
				return "Indholdet af feltet skal være et heltal!";
			}
		}

		public function checkRange($number, $minVal, $maxVal){
			if(!filter_var($number, FILTER_VALIDATE_INT)){
				return "Indholdet af feltet skal være et heltal!";
			}else{
				if($maxVal < $number || $minVal > $number){
					return "Indholdet af feltet 'Integer' skal være et heltal mellem {$minVal} og {$maxVal}!";
				}
			}
		}

		public function checkLength($input, $minLength, $maxLength){
			if(strlen($input) < $minLength || strlen($input) > $maxLength){
					return "Indholdet af feltet skal være en tekst-streng på mellem {$minLength} og {$maxLength} karakterer.";
				}
		}

		public function checkFloat($number){
			if(!preg_match("/^\d*\.\d*$/", $number)){
				return "Indholdet af feltet skal være et decimal-tal.";
			}
		}

	}
?>
