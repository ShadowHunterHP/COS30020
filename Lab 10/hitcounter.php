<?php

class Counter {
    private $host;
    private $user;
    private $pswd;
    private $dbnm;
	private $tbnm;
    private $conn;
    
    public function __construct($host, $user, $pswd, $dbnm, $tbnm) {
        $this->host = $host;
        $this->user = $user;
        $this->pswd = $pswd;
        $this->dbnm = $dbnm;
		$this->tbnm = $tbnm;
        $this->conn = new mysqli($this->host, $this->user, $this->pswd, $this->dbnm);
		
		if ($this->conn->connect_error) {
			die("<p>The database is acting up :( </p>"
			. "<p>Error code " . $this->conn->errno
			. ": " . $this->conn->error . "</p>");
		}
		
		$this->conn->select_db($this->tbnm);
    }
    
	public function getHits() {
        $sql = "SELECT hits FROM hitcounter";
        $result = $this->conn->query($sql);
        $num = $result->fetch_assoc();
		$des = "<p>This page has received: " . $num["hits"] . " hits.</p>";
        return $des;
    }
	
    public function setHits() {
        $sql = "UPDATE hitcounter SET hits = hits + 1";
        $this->conn->query($sql);
    }
	
	public function startOver() {
        $sql = "UPDATE hitcounter SET hits = 0";
        $this->conn->query($sql);
	}
	
	public function closeConnection() {
        $this->conn->close();
	}	
}

?>