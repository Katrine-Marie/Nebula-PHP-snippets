<?php

	class DKDateTime extends DateTime
	{
		private $year, $month, $day, $hour, $minute, $second;

		private $month_names = array(
			1 => 'januar',
			2 => 'februar',
			3 => 'marts',
			4 => 'april',
			5 => 'maj',
			6 => 'juni',
			7 => 'juli',
			8 => 'august',
			9 => 'september',
			10 => 'oktober',
			11 => 'november',
			12 => 'december'
		);
		private $week_days = array(
			1 => 'mandag',
			2 => 'tirsdag',
			3 => 'onsdag',
			4 => 'torsdag',
			5 => 'fredag',
			6 => 'lørdag',
			7 => 'søndag'
		);

// 		public function __construct($time='now', $timezone='Europe/Copenhagen')
//     {
//         parent::__construct($time, new DateTimeZone($timezone));
//     }
		public function __construct($timezone = null)
    {
        parent::__construct(NULL, $timezone);
    }

		public function __toString(){
			return $this->format('Y-m-d H:i:s');
		}

		public function modify($param = null){
			return "Modify-metoden er disabled!";
		}

		public function setDate($year, $month, $day){
			$this->year = $year;
			$this->month = $month;
			$this->day = $day;
			if(!is_numeric($year) || !is_numeric($month) || !is_numeric($day)){
				Throw new Exception("Argumenterne skal være heltal!");
			}
			if(!checkdate($month, $day, $year)){
				Throw new Exception("Ikke en valid dato!");
			}else {
				return parent::setDate($year, $month, $day);
			}
		}

		public function setTime($hour, $minute, $second = 00){
			if($hour > 23 || $hour < 0 || $minute > 59 || $minute < 0 || $second > 59 || $second < 0){
				Throw new Exception("Ikke et korrekt tidspunkt!");
			}else {
				return parent::setTime($hour, $minute, $second);
			}
		}

		// formatting functions
		public function getDay($zeros=1){
			if($zeros){
				return $this->format("j");
			}else {
				return $this->format("d");
			}
		}
		public function getDayName(){
			// return $this->format('l');
			return $this->week_days[$this->format('N')];
		}
		public function getDayAbbr(){
			return $this->format('D');
		}

		public function getMonth($zeros=1){
			if($zeros){
				return $this->format("m");
			}else {
				return $this->format("n");
			}
		}
		public function getMonthName(){
			return $this->month_names[$this->format('N')];
		}
		public function getMonthAbbr(){
			return $this->format("M");
		}

		public function getYear(){
			return $this->format("y");
		}
		public function getFullYear(){
			return $this->format("Y");
		}

		public function getMySQLFormat(){
			return $this->format("Y-m-d H:i:s");
		}

		public function getDMY($zeros=1){
			if($zeros){
				return $this->format("j-n-Y");
			}else {
				return $this->format("d-m-Y");
			}
		}
		public function getMDY($zeros=1){
			if($zeros){
				return $this->format("n-j-Y");
			}else {
				return $this->format("m-d-Y");
			}
		}

		public function setMDY($date_string){

			$date_parts = preg_split('{[-/ :.]}', $date_string);

			$day = $date_parts[1];
			$month = $date_parts[0];
			$year = $date_parts[2];

			if(count($date_parts > 3)){
			  $hour = $date_parts[3];
				$minute = $date_parts[4];
				$seconds = $date_parts[5];
				$this->setTime($hour, $minute, $seconds);
			}
			$this->setDate($year, $month, $day);

		}

		public function setDMY($date_string){
			$date_parts = preg_split('{[-/ :.]}', $date_string);

			$day = $date_parts[0];
			$month = $date_parts[1];
			$year = $date_parts[2];

			if(count($date_parts > 3)){
			  $hour = $date_parts[3];
				$minute = $date_parts[4];
				$seconds = $date_parts[5];
				$this->setTime($hour, $minute, $seconds);
			}
			$this->setDate($year, $month, $day);
		}

		public function setFromSQL($date_string){
			$date_parts = preg_split('{[-/ :.]}', $date_string);

			$day = $date_parts[2];
			$month = $date_parts[1];
			$year = $date_parts[0];

			if(count($date_parts > 3)){
			  $hour = $date_parts[3];
				$minute = $date_parts[4];
				$seconds = $date_parts[5];
				$this->setTime($hour, $minute, $seconds);
			}
			$this->setDate($year, $month, $day);
		}

	}

?>
