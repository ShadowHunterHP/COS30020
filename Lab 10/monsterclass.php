<?php
	class Monster { 			// start the Monster class
		public $num_of_eyes; 	// properties
		public $colour;
	
		public function setNum($num) {
			$this->num_of_eyes = $num;
		}

		public function getNum() {
			return $this->num_of_eyes;
		}

		public function setCol($col) {
			$this->colour = $col;
		}

		public function getCol() {
			return $this->colour;
		}
	
		public function __construct($num, $col) { 		// constructor
			$this->setNum($num);						// initialise number of eyes
			$this->setCol($col);						// initialise colour
		}
		
		public function describe() {
			$ans = "The " . $this->getCol() . " monster has " . $this->getNum() . " eyes.";
			return $ans;
		}
	}
?>