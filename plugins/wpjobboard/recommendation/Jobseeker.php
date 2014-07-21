<?php

class Jobseeker  {
	private $JS_ID;						// ID of jobseeker.
	private $JobsViewed = array();		// Jobs that jobseeker has viewed and/or apply before
	private $JobsApplied = array();		// Jobs that jobseeker has viewed and apply before
	private $JSSimilar = array();		// Other Jobseeker who has viewed similar jobs with this jobseeker
	private $JobsWillSuggest = array();	// Jobs that be to used to recommandation

	private $Category = array();		// Categories which jobseeker view jobs in.
	private $Type = array();			// Type of job that jobseeker view.
	private $Location = array();		// Location available with jobseeker.
	private $Salary;					// Salary suitable with jobseeker.
	

	/**
	* Constructor
	* @param	ID The id of jobseeker
	* @return	void
	* @access	get ID and store to private ID
	*/
	function __construct($ID){
		$this->JS_ID = $ID;	
	}

	public function getID(){
		return $this->JS_ID;
	}
	
	/**
	 * getJobsViewed
	 * @return	The jobs that this jobseeker has viewed and/or applied before.
	 */
	public function getJobsViewed(){
		return $this->JobsViewed;
	}
	
	/**
	 * setJobsViewed
	 * @param	Jobs	Jobs that jobseeker viewed.
	 * @return	void.
	 * @access	Store jobs that jobseeker viewed to JobsViewed variable.
	 */
	public function addJobsViewed($Jobs){
		array_push($this->JobsViewed, $Jobs);
	}

	/**
	 * getJobsApplied
	 * @return	The jobs that this jobseeker has viewed and applied before.
	 */
	public function getJobsApplied(){
		return $this->JobsApplied;
	}
	
	/**
	 * setJobsApplied
	 * @param	Jobs	Jobs that jobseeker applied.
	 * @return	void.
	 * @access	Store jobs that jobseeker viewed to JobsViewed variable.
	 */
	public function addJobsApplied($Jobs){
		array_push($this->JobsApplied, $Jobs);
	}

	/**
	 * getJSSimilar
	 * @return	Other jobseekers who has viewed and applied similar jobs with thi jobseeker.
	 */
	public function getJSSimilar(){
		return $this->JSSimilar;
	}
	
	/**
	 * setJSSimilar
	 * @param	Jobseekers	The jobseekers who has similar viewed and applied with this jobseeker.
	 * @return	void.
	 * @access	Store jobseekers to JSSimilar variable.
	 */
	public function setJSSimilar($Jobseekers){
		$this->JSSimilar = $Jobseekers;
	}

	/**
	 * getJobsWillSuggest
	 * @return	The jobs to use to suggest to this jobseeker.
	 */
	public function getJobsWillSuggest(){
		return $this->JobsWillSuggest;
	}
	
	/**
	 * addJobsWillSuggest
	 * @param	Jobs	The array jobs which be to use to suggest to this jobseeker.
	 * @return	void.
	 * @access	Store jobs to JobsWillSuggest variable.
	 */
	public function addJobsWillSuggest($Jobs){
		if($Jobs == null || !is_array($Jobs))
			return;

		foreach ($Jobs as $job){
			$diff = true;
			foreach ($this->JobsWillSuggest as $jobwillsuggest){
				if ( $jobwillsuggest != null &&
					$jobwillsuggest->getID() == $job->getID()) {
					$diff = false;
				}
			}
			
			if ($diff) {
				array_push($this->JobsWillSuggest, $job);
			}
		}
	}

	/**
	 * Add a category to array category
	 * @param	category	The category which jobseeker view job in.
	 * @return	void.
	 */
	public function addCategory($category){
		if(!in_array($category, $this->Category)){
			array_push($this->Category, $category);
		}
	}
	
	/**
	 * get all category
	 * @return	array of category which jobseeker view jobs in.
	 */
	public function getCategory(){
		return $this->Category;
	}
	
	/**
	 * Add a type to array type
	 * @param	type	The type of job which user view.
	 * @return	void.
	 */
	public function addType($type){
		if(!in_array($type, $this->Type)){
			array_push($this->Type, $type);
		}
	}
	
	/**
	 * get all type
	 * @return	array of type of job which user view.
	 */
	public function getType(){
		return $this->Type;
	}
	
	public function CheckCategory(){
		echo "Check category <br />";
		$jobInCategory = array();
		print_r($this->Category);
		echo "<br />";
		foreach ($this->JobsWillSuggest as $job){
			echo $job->getID(). ": ". $job->getCategory();
			if(in_array($job->getCategory(), $this->Category)){
				echo " pushed";
				array_push($jobInCategory, $job);
			}
			echo "<br />";
		}
		
		$this->JobsWillSuggest = $jobInCategory;
	}
	
	public function CheckType(){
		echo "Check type <br />";
		$jobWithTypeChecked = array();
		print_r($this->Type);
		echo "<br />";
		foreach ($this->JobsWillSuggest as $job){
			echo $job->getID(). ": ". $job->getType();
			if(in_array($job->getType(), $this->Type)){
				echo " pushed";
				array_push($jobWithTypeChecked, $job);
			}
			echo "<br />";
		}
		
		$this->JobsWillSuggest = $jobWithTypeChecked;
	}

}	

?>