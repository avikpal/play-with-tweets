<?php
// ---------- Main Code -----------------------
include “twitterapi.php”;
// Search Twitter for tweets with #PHP in them
$search = queryTwitter(“http://search.twitter.com/search.json?” .
“q=%23PHP&” .
“rpp=100”);
// Count how many tweets were posted over time
$tweetsPerMin = Array();
foreach($search->results as $tweet) {
$currentMin = strtotime($tweet->created_at) / 60;
$tweetsPerMin [ $currentMin ]++;
}
// Sort results by key in ascending order
ksort($tweetsPerMin);
// ---------- Plot the graph ------------------
// Import Google API for Visualization
?>
<script type=”text/javascript” src=”http://www.google.com/jsapi”></script>
<script type=”text/javascript”>
google.load('visualization', '1', {packages: ['corechart']});
</script>
<?php
// Define [x, y] coordinates for every point in the graph
$graph = "[";
foreach($tweetsPerMin as $minute => $nbTweets) {
$minuteTxt = date(“g:i A”, $minute * 60);
$graph .= "[ '$minuteTxt', $nbTweets ],";
}
$graph .= "]";
// Output graph
?>
<script type=”text/javascript”>
function drawVisualization() {
// Create and populate the data table.
var data = google.visualization.arrayToDataTable(<?php echo $graph; ?>);
// Create and draw the visualization.
new google.visualization.LineChart(document.getElementById(‘visualization’)).
draw(data, { pointSize: 5, legend: {‘position’: ‘none’} }
);
}
google.setOnLoadCallback(drawVisualization);
</script>
<h1>Tweets over time</h1>
<div id=”visualization” style=”width: 900px; height: 500px;”>
</div>
