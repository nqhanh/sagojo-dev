<?php
/**
 * Filter of Job
 *
 * @author Tran Danh Hung
 * @package
 */
class job {
	private $J_ID;			// ID of job.
	private $Category;		// Category of job.
	private $Type;			// Type of job.
	private $Location;		// Location which job available.
	private $Salary;		// Salary of job.
	/** 
	 * @todo Add other attribute to caculate recomment here.
	 */
	
	public function __construct($ID){
		$this->J_ID = $ID;
	}
	
	public function getID(){
		return $this->J_ID;
	}
	
	public function setCategory($category){
		$this->Category = $category;
	}
	
	public function getCategory(){
		return $this->Category;
	}
	
	public function setType($type){
		$this->Type = $type;
	}
	
	public function getType(){
		return $this->Type;
	}
	
	public function setLocation($location){
		$this->Location = $location;
	}
	
	public function getLocation(){
		return $this->Location;
	}
	
	public function setSalary($salary){
		$this->Salary = $salary;
	}
	
	public function getSalary(){
		return $this->Salary;
	}
}
?>