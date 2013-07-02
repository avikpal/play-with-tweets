<?php
// ---------- Main Code -----------------------
include “twitterapi.php”;
// Search for tweets about “something” and output them
$search = queryTwitter(“http://search.twitter.com/
search.json?q=something”); 
foreach($search->results as $tweet) {
echo “<strong>{$tweet->from_user_name}</strong> “ .
“tweeted ‘{$tweet->text}’ “ .
“on {$tweet->created_at}<br />\n”;
}
?>
