<?
include("includes/rating_config.php");
$sql = "CREATE TABLE `ratings` (
  	`id` int(11) NOT NULL auto_increment,
  	`rating_id` VARCHAR(80) NOT NULL,
  	`rating_num` int(11) NOT NULL,
  	`IP` varchar(25) NOT NULL,
  	PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
if(mysql_query($sql)){
	echo '"ratings" table created!  Please remove this file for security reasons.';
} else {
	echo mysql_error();
}
?>