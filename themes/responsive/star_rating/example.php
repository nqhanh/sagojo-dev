<?php
$server = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'sagojo';

$x = mysql_connect($server,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($dbname,$x);/*
Dynamic Star Rating Redux
Developed by Jordan Boesch
www.boedesign.com
Licensed under Creative Commons - http://creativecommons.org/licenses/by-nc-nd/2.5/ca/

Used CSS from komodomedia.com.
*/

function getRating($id){

	$total = 0;
	$rows = 0;
	
	$sel = mysql_query("SELECT rating_num FROM wp_ratings WHERE rating_id = '$id'");
	if(mysql_num_rows($sel) > 0){
	
		while($data = mysql_fetch_assoc($sel)){
		
			$total = $total + $data['rating_num'];
			$rows++;
		}
		
		$perc = ($total/$rows) * 20;
		
		//$newPerc = round($perc/5)*5;
		//return $newPerc.'%';
		
		$newPerc = round($perc,2);
		return $newPerc.'%';
	
	} else {
	
		return '0%';
	
	}
}

function outOfFive($id){

	$total = 0;
	$rows = 0;
	
	$sel = mysql_query("SELECT rating_num FROM wp_ratings WHERE rating_id = '$id'");
	if(mysql_num_rows($sel) > 0){
	
		while($data = mysql_fetch_assoc($sel)){
		
			$total = $total + $data['rating_num'];
			$rows++;
		}
		
		$perc = ($total/$rows);
		
		return round($perc,2);
		//return round(($perc*2), 0)/2; // 3.5
	
	} else {
	
		return '0';
	
	}
	
	
}

function getVotes($id){

	$sel = mysql_query("SELECT rating_num FROM wp_ratings WHERE rating_id = '$id'");
	$rows = mysql_num_rows($sel);
	if($rows == 0){
		$votes = '0 Votes';
	}
	else if($rows == 1){
		$votes = '1 Vote';
	} else {
		$votes = $rows.' Votes';
	}
	return $votes;
	
}

function pullRating($id,$show5 = false, $showPerc = false, $showVotes = false, $static = NULL){
	
	// Check if they have already voted...
	$text = '';
	
	$sel = mysql_query("SELECT id FROM wp_ratings WHERE IP = '".$_SERVER['REMOTE_ADDR']."' AND rating_id = '$id'");
	echo mysql_error();
	if(mysql_num_rows($sel) > 0 || $static == 'novote' || isset($_COOKIE['has_voted_'.$id])){
	
		
		
		if($show5 || $showPerc || $showVotes){

			$text .= '<div class="rated_text">';
			
		}
			
			if($show5){
				$text .= 'Rated <span id="outOfFive_'.$id.'" class="out5Class">'.outOfFive($id).'</span>/5';
			} 
			if($showPerc){
				$text .= ' (<span id="percentage_'.$id.'" class="percentClass">'.getRating($id).'</span>)';
			}
			if($showVotes){
				$text .= ' (<span id="showvotes_'.$id.'" class="votesClass">'.getVotes($id).'</span>)';
			}
			
		if($show5 || $showPerc || $showVotes){	
			
			$text .= '</div>';
		
		}
		
		
		return $text.'
			<ul class="star-rating2" id="rater_'.$id.'">
				<li class="current-rating" style="width:'.getRating($id).';" id="ul_'.$id.'"></li>
				<li><a onclick="return false;" href="#" title="1 star out of 5" class="one-star" >1</a></li>
				<li><a onclick="return false;" href="#" title="2 stars out of 5" class="two-stars">2</a></li>
				<li><a onclick="return false;" href="#" title="3 stars out of 5" class="three-stars">3</a></li>
				<li><a onclick="return false;" href="#" title="4 stars out of 5" class="four-stars">4</a></li>
				<li><a onclick="return false;" href="#" title="5 stars out of 5" class="five-stars">5</a></li>
			</ul>
			<div id="loading_'.$id.'"></div>';

		
	} else {
		
		if($show5 || $showPerc || $showVotes){
			
			$text .= '<div class="rated_text">';
			
		}
			if($show5){
				$show5bool = 'true';
				$text .= 'Rated <span id="outOfFive_'.$id.'" class="out5Class">'.outOfFive($id).'</span>/5';
			} else {
				$show5bool = 'false';
			}
			if($showPerc){
				$showPercbool = 'true';
				$text .= ' (<span id="percentage_'.$id.'" class="percentClass">'.getRating($id).'</span>)';
			} else {
				$showPercbool = 'false';
			}
			if($showVotes){
				$showVotesbool = 'true';
				$text .= ' (<span id="showvotes_'.$id.'" class="votesClass">'.getVotes($id).'</span>)';
			} else {
				$showVotesbool = 'false';	
			}
			
		if($show5 || $showPerc || $showVotes){	
		
			$text .= '</div>';
			
		}
		
		return $text.'
			<ul class="star-rating" id="rater_'.$id.'">
				<li class="current-rating" style="width:'.getRating($id).';" id="ul_'.$id.'"></li>
				<li><a onclick="rate(\'1\',\''.$id.'\','.$show5bool.','.$showPercbool.','.$showVotesbool.'); return false;" href="includes/rating_process.php?id='.$id.'&rating=1" title="1 star out of 5" class="one-star" >1</a></li>
				<li><a onclick="rate(\'2\',\''.$id.'\','.$show5bool.','.$showPercbool.','.$showVotesbool.'); return false;" href="includes/rating_process.php?id='.$id.'&rating=2" title="2 stars out of 5" class="two-stars">2</a></li>
				<li><a onclick="rate(\'3\',\''.$id.'\','.$show5bool.','.$showPercbool.','.$showVotesbool.'); return false;" href="includes/rating_process.php?id='.$id.'&rating=3" title="3 stars out of 5" class="three-stars">3</a></li>
				<li><a onclick="rate(\'4\',\''.$id.'\','.$show5bool.','.$showPercbool.','.$showVotesbool.'); return false;" href="includes/rating_process.php?id='.$id.'&rating=4" title="4 stars out of 5" class="four-stars">4</a></li>
				<li><a onclick="rate(\'5\',\''.$id.'\','.$show5bool.','.$showPercbool.','.$showVotesbool.'); return false;" href="includes/rating_process.php?id='.$id.'&rating=5" title="5 stars out of 5" class="five-stars">5</a></li>
			</ul>
			<div id="loading_'.$id.'"></div>';
	
	}
}

// Added in version 1.5
// Fixed sort in version 1.7
function getTopRated($limit, $table, $idfield, $namefield){
	
	$result = '';
	
	$sql = "SELECT COUNT(wp_ratings.id) as rates,wp_ratings.rating_id,".$table.".".$namefield." as thenamefield,ROUND(AVG(wp_ratings.rating_num),2) as rating 
			FROM wp_ratings,".$table." WHERE ".$table.".".$idfield." = wp_ratings.rating_id GROUP BY rating_id 
			ORDER BY rates DESC,rating DESC LIMIT ".$limit."";
			
	$sel = mysql_query($sql);
	
	$result .= '<ul class="topRatedList">'."\n";
	
	while($data = @mysql_fetch_assoc($sel)){
		$result .= '<li>'.$data['thenamefield'].' ('.$data['rating'].')</li>'."\n";
	}
	
	$result .= '</ul>'."\n";
	
	return $result;
	
}
?>

	<link href="http://192.168.0.105/wordpress_op2/wp-content/themes/responsive/star_rating/css/rating_style.css" rel="stylesheet" type="text/css" media="all">
				<script type="text/javascript" src="http://192.168.0.105/wordpress_op2/wp-content/themes/responsive/star_rating/js/rating_update.js"></script>	

	
	<?php
	/*
	
	USAGE:
	id = integer (number)
	show 3/5 = boolean (true/false)
	show percentage = boolean (true/false)
	show votes = boolean (true/false); 
	allow vote = 'novote' (string) OPTIONAL, if not using, leave empty or NULL
	
	pullRating(id, show 3/5, show percentage, show votes, allow vote);
	
	USAGE FOR TOP VOTES:
	id = integer (number)
	table_name = name of the table that are holding your items you are rating (string)
	table_id = the id of the field in the table you are rating. This is usually 'id' or 'article_id'
	table_title = the title of the field in the table you are rating.  This is something like 'article_title'
	*/
	?>
	
	<h3>Variation 1 (The most prefered method)</h3>

	<?php echo pullRating(11,true,false,true); ?>
	
	<h3>Variation 2</h3>
	
	<?php echo pullRating(44,true,false,false); ?>
		
	<h3>Variation 3</h3>
	
	<?php echo pullRating(35,false,false,false); ?>
	
	<h3>Variation 4</h3>
	
	<?php echo pullRating(21,true,true,true); ?>
	
	<h3>Variation 5</h3>
	
	<?php echo pullRating(25,false,true,true); ?>
	
	<h3>Variation 6 (With the 'novote' attribute)</h3>
	
	<?php echo pullRating(45,false,true,true,'novote'); ?>

	<h3>Top 10 Votes</h3>
	
	<?php echo getTopRated(10,'articles','id','name'); ?>
