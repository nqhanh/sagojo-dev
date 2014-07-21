<?php
/**
 * Description of Recommend
 *
 * @author greg
 * @package
 */
/*require_once 'Jobseeker.php';
require_once 'Job.php';*/
ini_set('memory_limit', '1024M');
define("BONUS", 0.5);
define("SIMILAR", 0.2);
define("COUNT", 2);
class Wpjb_Widget_Recommend extends Daq_Widget_Abstract
{
	private $AllJobseeker = array();	// All jobseeker in database
	private $Jobseeker;	
	
    public function __construct() 
    {
        $this->_context = Wpjb_Project::getInstance();
        $this->_viewAdmin = "recommend.php";
        $this->_viewFront = "recommend.php";
        
        parent::__construct(
            "wpjb-recommend", 
            __("BINGO!!! Your best match job is this.", WPJB_DOMAIN),
            array("description"=>__("Displays list of recommend jobs", WPJB_DOMAIN))
        );
    }
/*[:en]BINGO!!! Your best match job is this.[:vi]BINGO!!! Hãy thử sức với các công việc này xem.[:ja]BINGO!!! Your best match job is this.*/

    /**
     * Constructor
     * @param	ID The id of jobseeker to recommandation
     * @return	void
     * @access	get ID and store to private ID
     */
    function setID($ID){
    	$this->getDatabase($ID);
    	$this->findSimilarJS();
    	$this->findSuggestJobs();
    
    }
    
    
    public function getDatabase($ID){
    	global $wpdb;
    	$datas = $wpdb->get_results("SELECT JS_ID, J_ID,
											job_category as category,
											job_type as type, isApply
										FROM wpjb_viewed JOIN wpjb_job
										ON wpjb_viewed.J_ID = wpjb_job.id
										ORDER BY JS_ID");
    		
    	$jobseeker = null;
    	foreach ($datas as $data){
    
    		if($jobseeker == null ){
    			$jobseeker = new Jobseeker($data->JS_ID);
    		} else if ($jobseeker->getID() != $data->JS_ID) {
    			if ($jobseeker->getID() == $ID) {
    				$this->Jobseeker = $jobseeker;
    			} else {
    				array_push($this->AllJobseeker, $jobseeker);
    			}
    			$jobseeker = new Jobseeker($data->JS_ID);
    		}
    
    		$job = new job($data->J_ID);
    
    		$job->setCategory($data->category);
    		$jobseeker->addCategory($data->category);
    
    		$job->setType($data->type);
    		$jobseeker->addType($data->type);
    
    		// @todo Set other attribute for job here.
    
    		$jobseeker->addJobsViewed($job);
    		if ($data->isApply) {
    			$jobseeker->addJobsApplied($job);
    		}
    	}
    	if ($jobseeker->getID() == $ID) {
    		$this->Jobseeker = $jobseeker;
    	} else {
    		array_push($this->AllJobseeker, $jobseeker);
    	}
    		
    		
    }
    
    public function findSimilarJS(){
    	if($this->Jobseeker == NULL)
    		return ;
    		
    	$similar = array();
    	/* Caculate similar of all other jobseeker with this jobseeker.*/
    	foreach ($this->AllJobseeker as $eachJS){
    		$viewSames = $this->findSimilar(
    				$this->Jobseeker->getJobsViewed(),
    				$eachJS->getJobsViewed());
    
    		//print_r($viewSames);
    			
    
    		$viewed = count($viewSames) / count($this->Jobseeker->getJobsViewed());
    		/*echo "<br />". $eachJS->getID(). ": ". count($viewSames) .
    		" / ". count($this->Jobseeker->getJobsViewed()).
    		"<br /> <br />";*/
    		$applySames = $this->findSimilar(
    				$this->Jobseeker->getJobsApplied(),
    				$eachJS->getJobsApplied());
    
    
    		$applied = count($applySames) /
    		count($this->Jobseeker->getJobsViewed());
    
    		$percent = $viewed + $applied*BONUS;
    		if($percent >= SIMILAR){
    			array_push($similar, array("JS" => $eachJS, "similar" => $percent));
    
    		}
    
    	}
    		
    	/* Sort similar of all other jobseeker with this jobseeker.*/
    	$sm = array();
    	foreach ($similar as $key => $row){
    		$sm[$key] = $row["similar"];
    	}
    	array_multisort($sm, SORT_DESC, $similar);
    		
    	/* Get first tens jobseeker similar */
    	array_splice($similar, COUNT);
    		
    	/* Store similar sorted to this jobseeker. */
    	$this->Jobseeker->setJSSimilar($similar);
    
    		
    }
    
    
    public function findSuggestJobs(){
    	if($this->Jobseeker == NULL)
    		return ;
    		
    	foreach ($this->Jobseeker->getJSSimilar() as $key => $row){
    
    
    		$applyDiff = $this->findDiff($row["JS"]->getJobsApplied(),
    				$this->Jobseeker->getJobsViewed());
    
    			
    		$this->Jobseeker->addJobsWillSuggest($applyDiff);
    
    	}
    		
    }
    
    public function checkCategory(){
    	if($this->Jobseeker == NULL)
    		return ;
    		
    	$this->Jobseeker->CheckCategory();
    }
    
    public function checkType(){
    	if ($this->Jobseeker == null) {
    		return;
    	}
    		
    	$this->Jobseeker->CheckType();
    }
    
    public function postSuggestJobs(){
    	if($this->Jobseeker == NULL)
    		return array();
    	return $this->Jobseeker->getJobsWillSuggest();
    }
    
    
    private function findSimilar($array_1, $array_2){
    	if(!is_array($array_1) || !is_array($array_2)){
    		echo 'Invalid agrument to find similar';
    		return;
    	}
    
    	$similar = array();
    	foreach ($array_1 as $a_1){
    		foreach ($array_2 as $a_2){
    			if ($a_1->getID() == $a_2->getID()) {
    				array_push($similar, $a_1);
    			}
    		}
    	}
    
    	return $similar;
    }
    
    private function findDiff($array_1, $array_2){
    	if(!is_array($array_1) || !is_array($array_2)){
    		echo 'Invalid agrument to find diff';
    		return;
    	}
    		
    		
    	$different = array();
    	foreach ($array_1 as $a_1){
    		$diff = true;
    		foreach ($array_2 as $a_2){
    			if ($a_1->getID() == $a_2->getID()) {
    				$diff = false;
    			}
    		}
    
    		if ($diff) {
    			array_push($different, $a_1);
    		}
    	}
    		
    	return $different;
    }
		
}

?>