<?php

/*----------------------------Session-----------------------------------------*/
  session_start();

  if(isset($_SESSION["user"])){
  	$username = $_SESSION["user"];
  } else{
    header('Location: signin.html?err=not_login');      
  }

/*----------------------------Variable-----------------------------------------*/
	if(isset($_POST["count"])){
		$total = $_POST["count"];
		$joy = $_POST["joy"];
		$sad = $_POST["sad"];
		$disgust = $_POST["disgust"];
		$contempt = $_POST["contempt"];
		$anger = $_POST["anger"];
		$fear = $_POST["fear"];
		$surprise = $_POST["surprise"];
		$engagement = $_POST["engagement"];
		$distract = $total-$engagement;
		$nonemotion = $total-$joy-$sad-$disgust-$contempt-$anger-$fear-$surprise; 
		$pvalence = $_POST["pvalence"];
		$nvalence = $_POST["nvalence"];
		$data = $_POST["data"]; 
		$vid = $_POST["vid"];
		$q1 = $_POST["like"];
		$q2 = $_POST["buy"];
		$q3 = $_POST["emotion"];
/*------------------------------write on file--------------------------------------------------------*/

		$myfile = fopen("userdata/".$username."_".$vid.".tsv", "w") or die("Unable to open file!");
		//echo $username."_".$vid.".tsv";
		$list = explode(",", $data);
		$txt = "date	Joy	Sadness	Disgust	 Contempt	 Anger	 Fear	 Surprise\n";
		fwrite($myfile, $txt);
		foreach($list as $element){
			if(strpos($element, "c") !== false){
				$txt = "\n";
			} else {
				$txt = "$element\t";
			}
			fwrite($myfile, $txt);		
		}

		fclose($myfile);

/*---------------------------------Database-----------------------------------------------*/

		$servername = "127.0.0.1";
		$user = "root";
		$password = "";
		$dbname = "youtube";

		// Create connection
		$conn = new mysqli($servername, $user, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT * FROM video WHERE email = '".$username."' AND video = '".$vid."';";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$sql = "DELETE FROM video WHERE email = '".$username."' AND video = '".$vid."';";
		}

		$sql = "INSERT INTO `video` (`email`, `video`, `joy`, `sad`, `disgust`, `contempt`, `anger`, `fear`, `surprise`, `nonemotion`, `engagement`, `distract`, `pvalence`, `nvalence`, `total`, `q1`, `q2` ,`q3`) VALUES ('".$username."', '".$vid."', '".$joy."', '".$sad."', '".$disgust."', '".$contempt."', '".$anger."', '".$fear."', '".$surprise."', '".$nonemotion."', '".$engagement."', '".$distract."', '".$pvalence."', '".$nvalence."', '".$total."', '".$q1."', '".$q2."', '".$q3."');";

		if ($conn->query($sql) === TRUE) {
		    echo "<script>alert(\"New record created successfully\");</script>";
		}
	} else {
		$vid = $_GET["vid"];
	}
	
    $fileName = "userdata/".$username."_".$vid.".tsv";


	$donut_url = "donut.php?vid=".$vid;
	$line_url = "line.php?vid=".$vid;
?>


<!DOCTYPE html>
<head>
	<title>Data</title>
	<meta charset="UTF-8">
	<meta name="description" content = "Youtube Analysis powered by Affectiva">
	<meta name="keywords" content ="Youtube，Affect Computing, Affectiva">
	<meta name="author" content ="BF8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<link rel="shortcut icon" type="image/x-icon" href="src/icon.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="css/test2.css" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<script> 
$(document).ready(function(){
    $("#flip").click(function(){
        if ($('#panel').is(':visible')){
        	$("#panel").slideUp("slow");
        	document.getElementById("desc").innerHTML=">> See more Description for lövheim cube <<";
		} else {
			$("#panel").slideDown("slow");
      $(".demo-message").hide();
			document.getElementById("desc").innerHTML="<< See less Description >>";
		}
    });
});
</script>
<style> 
#panel, #flip {
    padding: 5px;
    text-align: center;
    border-top: solid 1px #444444;
    border-bottom: solid 1px #444444;
}

#panel {
    padding: 50px;
    display: none;
}
</style>
<body>
	<div class="row">
	<div class="col-sm-7" style="padding-right: 10px">
		<iframe src=<?php echo $donut_url; ?> height="350" width="510" style="border:none;display:block; margin:auto;"></iframe>
		<p style="text-align: center;">(* emotions are beyond 40% on the standard of Affectiva)</p>
	</div>
	<div class="col-sm-5">
		<h3 id="title"></h3>
		<br>
		<h6 id="publish"></h6>
		<p id="description"></p>
		<a href="/dashboard/new/dashboard.php">Go to Dashboard</a>
	</div>
	</div>
	<iframe src=<?php echo $line_url; ?> height="510" width="1000" style="border:none;display:block; margin:auto;"></iframe>
	<br>
	<div class="col-md-12 text-center" id="Lövheim"><h3>Lövheim Collage</h3>
	<br>
	<p>~ Emotion color each tile by lövheim cube of emotion ~</p>
	<div id="flip"><p id="desc">>> See more Description for lövheim cube <<</p></div>
	<div id="panel">
		<div style="width:100%;">
		<h3><strong>Lövheim cube of emotion</strong></h3> is a proposed theoretical model aiming at explaining the relationship between the monoamine neurotransmitters and the emotions. The model was proposed in a paper of 2012 by Hugo Lövheim. In the model, the three monoamine neurotransmitters serotonin, dopamine and noradrenaline form the axes of a coordinate system, and the eight basic emotions, labeled according to the affect theory of Silvan Tomkins, are placed in the eight corners.<br><br><img src="src/cube.png" class="img-rounded" alt="Cinque Terre" width="304" height="236"> <br><br><i>See detail on https://en.wikipedia.org/wiki/L%C3%B6vheim_cube_of_emotion</i>
		</div>
	</div>
	<br>
	<div id ="collage" style="display:block;">
	<?php
	function pick_color($data){
		$red = 40+2*(ceil($data[1])+ceil($data[5])+ceil($data[7]));
		$green = 40+2*(ceil($data[2])+ceil($data[3])+ceil($data[4])+ceil($data[7]));
		$blue = 40+2*(ceil($data[2])+ceil($data[5])+ceil($data[6]));
		if($red > 255){
			$red = 255;
		}
		if($green > 255){
			$green = 255;
		}
		if($blue > 255){
			$blue = 255;
		}
		$res = "rgb(".$red.",".$green.",".$blue.")";
		return $res;
	}

	$prev = "rgb(200,200,200)";
	$handle = fopen($fileName, "r");
	if ($handle) {
	    while (($line = fgets($handle)) !== false) {
	        $data = explode("\t", $line);
	        $current = pick_color($data);
	        if($data[0] != "date"){
	        	echo "<div style=\"background: linear-gradient(to right,".$prev." , ".$current.");width:20px;height:20px;border-radius: 3px;display:inline-block;\"></div>";
	        }
	        $prev = $current;
	    }

	    fclose($handle);
	} 
	?>
	</div>
</body>
</html>

<script>
function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}
var vid = getParameterByName("vid");
var vidpool = ["DVdZ9KjQvIA","aHdrFLai5c4","d2J2qdOrW44","Sp572udnPVg","K9vFWA1rnWc","3bdm4NBYxII"];
var index = vidpool.indexOf(vid);
if(index > -1){
	var titlepool = ["Funny Thai Commercial (Eng Sub)","Doritos \"Finger Cleaner\" Super Bowl commercial 2014 ","Removing a plastic straw from a sea turtle's nostril - Short Version","Marine Pollution","\"Unsung Hero\" (Official HD) : TVC Thai Life Insurance 2014 : ","\"My dad's story\": Dream for My Child | MetLife"];
	var publishpool = ["Published on Jun 16, 2016","Published on Feb 1, 2014","Published on Aug 12, 2015","Published on Jun 16, 2014","Published on Apr 3, 2014","Published on Jan 27, 2015"];
	var descpool=["Funniest Thai Commercial with English subs.","Doritos Crash the Super Bowl competition screens at the 2014 Super Bowl!<br>PLEASE LIKE, SUBSCRIBE AND SHARE! CHECK OUT MY OTHER SUPER BOWL 2014 COMMERCIALS!","While on a research project in Costa Rica, Nathan J. Robinson removed a 10 cm (4 in) plastic straw that was entirely embedded into the nostril of an olive ridley sea turtle. Lamentably, this is a consequence of the world of single-use, non-biodegradable plastic that we currently live in.<br>There is a solution and it lies in our own decisions. Please say no to all single-use plastic. Every plastic straw, plastic bag, or plastic bottle that ends up in the oceans could mean the difference between life or death for any number of marine animals.","The ocean covers almost three quarters of our planet. Populations in coastal regions are growing and placing increasing pressure on coastal and marine ecosystems. Marine pollution of many kinds threatens the health of the ocean and its living resources. While the past decades have seen efforts at the local, national, and international levels to address the problems of marine pollution, more needs to be done. Learn more about marine pollution at www.state.gov/ourocean.","The ocean covers almost three quarters of our planet. Populations in coastal regions are growing and placing increasing pressure on coastal and marine ecosystems. Marine pollution of many kinds threatens the health of the ocean and its living resources. While the past decades have seen efforts at the local, national, and international levels to address the problems of marine pollution, more needs to be done. Learn more about marine pollution at www.state.gov/ourocean.","No Description Provided by the official","MetLife values the dream of every parent to give their children a good education to pursue a better life. We understand every sacrifice you make for your children’s future."];

	document.getElementById("title").innerHTML = titlepool[index];
	document.getElementById("publish").innerHTML = publishpool[index];
	document.getElementById("description").innerHTML = descpool[index];
} else {
	alert("Error on vid");
}
</script>