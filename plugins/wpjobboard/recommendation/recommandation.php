<?php
require('http://192.168.0.105/wordpress_op2/wp-blog-header.php');
require_once 'Jobseeker.php';
require_once 'Job.php';
ini_set('memory_limit', '1024M');

define("BONUS", 0.5);
define("SIMILAR", 0.2);
define("COUNT", 10);

// $before = memory_get_usage();
// $test = $wpdb->get_results("SELECT JS_ID, J_ID, job_category as category, isApply
// 							FROM rs_viewed, wpjb_job
// 							WHERE rs_viewed.J_ID = wpjb_job.id");
// echo sizeof($test). "<br />";
// echo memory_get_usage() - $before . "<br />";
// print_r($test);

	class recommandation {
		private $AllJobseeker = array();	// All jobseeker in database
		private $Jobseeker;					// A jobseeker who need recommandation

		
		/**
		 * Constructor
		 * @param	ID The id of jobseeker to recommandation
		 * @return	void
		 * @access	get ID and store to private ID
		 */
		function __construct($ID){
			$this->getDatabase($ID);
 			$this->findSimilarJS();
 			$this->findSuggestJobs();

		}
		
		
		public function getDatabase($ID){
			global $wpdb;
			$datas = $wpdb->get_results("SELECT JS_ID, J_ID, 
											job_category as category, 
											job_type as type, isApply
										FROM rs_viewed, wpjb_job
										WHERE rs_viewed.J_ID = wpjb_job.id
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
			
//			print_r($this->AllJobseeker);
			
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
// 				echo "<br /> <br />";
// 				print_r($this->Jobseeker->getJobsViewed());
// 				echo "<br />";
// 				print_r($eachJS->getJobsViewed());
//  				echo "<br />";
 				print_r($viewSames);
 				
				
				$viewed = count($viewSames) / count($this->Jobseeker->getJobsViewed());
				echo "<br />". $eachJS->getID(). ": ". count($viewSames) . 
					" / ". count($this->Jobseeker->getJobsViewed()). 
					"<br /> <br />";
				$applySames = $this->findSimilar(
						$this->Jobseeker->getJobsApplied(), 
						$eachJS->getJobsApplied());
// 				echo "<br />";
// 				print_r($this->Jobseeker->getJobsApplied());
// 				echo "<br />";
// 				print_r($eachJS->getJobsApplied());
// 				echo "<br />";
// 				print_r($applySames);
				
				$applied = count($applySames) / 
							count($this->Jobseeker->getJobsViewed());
				
				$percent = $viewed + $applied*BONUS;
				if($percent >= SIMILAR){
					array_push($similar, array("JS" => $eachJS, "similar" => $percent));
// 					echo "<br />";
// 					print_r($similar);
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
// 			foreach ($this->Jobseeker->getJSSimilar() as $sm){
// 				echo "<br />";
// 				print_r($sm);
// 				echo "<br />";
// 			}
			
		}
		
		
		public function findSuggestJobs(){
			if($this->Jobseeker == NULL)
				return ;
			
			foreach ($this->Jobseeker->getJSSimilar() as $key => $row){
//				echo ("<br />");
// 				print_r($row["JS"]->getJobsApplied());
//				echo "apply diff <br />";
				
 				$applyDiff = $this->findDiff($row["JS"]->getJobsApplied(), 
 						$this->Jobseeker->getJobsViewed());
//				print_r($applyDiff);
//				echo "<br />";
 				
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
				return 'no result';
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
	
	$rmd = new recommandation('4');
	$rmd->checkCategory();
	$rmd->checkType();
	print_r($rmd->postSuggestJobs());


	
?>