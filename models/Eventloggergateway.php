<?php
Class Eventloggergatway{
	
	public function __construct($db) {	
		$this->db = $db;	
	}
	
	/**
	 * get the event log from the last index limit 
	 * @param number $lastIdx
	 * @return multitype:unknown
	 */
	public function getAll($lastIdx = 0){		
		
		$where  = array();
		$where[] = "1";
		if($lastIdx > 0){
			$where[] = " id > {$lastIdx}";
		}
		
		$where_str = implode(" and ", $where);
		
		$sql=("select * from ".EVENT_LOGGER." WHERE {$where_str} ORDER BY id ASC LIMIT 10");
		$result= mysqli_query($this->db, $sql) or die (mysqli_error($this->db));
		mysqli_fetch_all($result,MYSQLI_ASSOC);
		$numCount = mysqli_num_rows($result);
		
		$allEvents = array();
	
		foreach($result as $service){
			$allEvents[] = $service; //work properly, cause it implements Iterator
		}
		return $allEvents;		
	}
}