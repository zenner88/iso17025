<?php 
/* require the user as the parameter */
//http://localhost:8080/sample1/webservice1.php?user=1
if(isset($_GET['user']) && intval($_GET['user'])) {


  /* soak in the passed variable or set our own */
  $number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
  $format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default
  $user_id = intval($_GET['user']); //no default

  /* connect to the db */
  $hostsql = 'localhost';
	$usersql = 'iso17025';
	$passsql = 'rahasia';
	$dbsql = 'iso17025';
	
	$con = mysql_connect($hostsql,$usersql,$passsql);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($dbsql,$con);

  /* grab the posts from the db */
  //$query = "SELECT post_title, guid FROM wp_posts WHERE post_author = $user_id AND post_status = 'publish' ORDER BY ID DESC LIMIT $number_of_posts";
  $query = "SELECT * FROM toko";
  $result = mysql_query($query,$con) or die('Errant query:  '.$query);

  /* create one master array of the records */
  $posts = array();
  if(mysql_num_rows($result)) {
    while($post = mysql_fetch_assoc($result)) {
      $posts[] = array('post'=>$post);
    }
  }

  /* output in necessary format */
  if($format == 'json') {
    header('Content-type: application/json');
    echo json_encode(array('posts'=>$posts));
  }
  else {
    header('Content-type: text/xml');
    echo '<posts>';
    foreach($posts as $index => $post) {
      if(is_array($post)) {
        foreach($post as $key => $value) {
          echo '<',$key,'>';
          if(is_array($value)) {
            foreach($value as $tag => $val) {
              echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
            }
          }
          echo '</',$key,'>';
        }
      }
    }
    echo '</posts>';
  }

  /* disconnect from the db */
  @mysql_close($link);
}
 ?> 