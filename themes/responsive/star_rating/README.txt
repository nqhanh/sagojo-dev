////////////////////////////////////////////////////

Ajax Dynamic Star Rating 1.5
Developed by Jordan Boesch
www.boedesign.com
Licensed under Creative Commons
http://creativecommons.org/licenses/by-nc-nd/2.5/ca/

////////////////////////////////////////////////////

--------------------------------------------------------------------
 FEATURES
--------------------------------------------------------------------

- Uses AJAX Post (more secure than GET)
- Unobtrusive (works with javascript disabled)
- Does not allow multiple votes - checks against IP
- Tested in IE 6, IE 7, Firefox 2.x, Opera and Safari
- Pre-loads all images
- Easily style text using the stylesheet
- Precise rating to a 2 decimal place
- Display top rated items
- Display rating information you want using true or false: 
	(1) Show rating out of 5 
	(2) Show rating in percentage format
	(3) Show number of votes

--------------------------------------------------------------------
 INSTALLATION
--------------------------------------------------------------------

Open up includes/rating_config.php and change the mysql database connection info:

$server = 'localhost; // Database server (default localhost)
$dbuser = 'user'; // Database user
$dbpass = 'pass'; // Database pass
$dbname = 'test'; // Database Name

Now upload the files/directories to your web server.  I have named all files
with the prefix "rating_" to not clash with your other files.

You will need to create the necessary tables for the rater. You can either 1 or 2:

(1) Run the "create_ratings_table.php" file, then remove it.

OR

(2) Paste SQL query into phpMyAdmin.

	CREATE TABLE `ratings` (
  	`id` int(11) NOT NULL auto_increment,
  	`rating_id` int(11) NOT NULL,
  	`rating_num` int(11) NOT NULL,
  	`IP` varchar(25) NOT NULL,
  	PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--------------------------------------------------------------------
 USAGE
--------------------------------------------------------------------

The example.php file is there to show you how to implement it into your existing page(s).
The tags that MUST appear on your page(s) are as follows:

<? include("includes/rating_functions.php"); ?>
<link href="css/rating_style.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="js/rating_update.js"></script>

Now to call the rating bar we simply insert this PHP snippet.

<? echo pullRating(35,false,false,false,NULL); ?>

1) 35 would be your unique rating id (usually people put $_GET['id'] in there)

2) The first false statement is if you want it to show the rating out of 5.  
Example: 3/5
Change this to true if you want to display the rating.

3) The second false statement is if you want to show the rating in percentage format.  
Example (50%)
Change this to true if you want to display the percentage.

4) The last false statement if if you want to display the total amount of votes
Example (23 Votes)
Change this to true if you want to display the amount of votes.

5) The very last statement is whether or not you want the users to have the ability to vote.
If you don't want them to vote put in 'novote'.  This is handy when you're wanting people to be logged
in before they can vote.

As of version 1.5 I have implemented a feature where you can generate a custom amount of top ratings.

The syntax is simple: <? echo getTopRated(10,'articles','article_id','article_title'); ?>

What this will do is grab the top 10 rated articles from the table called 'articles' with the 
id field of 'article_id' (primary key, auto incremented) and the title field 'article_title'.  Of
course these can be whatever you called your table items you are rating.  They will then be displayed
like so:

Baby Born (5.0)
NY loses to BC (3.4)
Man loves food (3.2)
Nike to sponsor vegetables (1.5)

The article titles are automatically pulled from when you specify the 'article_title' in the function.


ENJOY!