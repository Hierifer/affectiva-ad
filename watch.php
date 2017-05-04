<?php
  session_start();

  //check login status
  if($_SESSION["user"]){
    $username = $_SESSION["user"];
  } else{
    header('Location: index.html?err=not_login');      
  }
?>

<html>
<head>
	<title>Youtube Video Analysis</title>
	<meta charset="UTF-8">
  <meta name="description" content = "Youtube Analysis powered by Affectiva">
  <meta name="keywords" content ="Youtube，Affect Computing, Affectiva">
  <meta name="author" content ="BF8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="src/icon.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-darkly.min.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
  <script src="https://download.affectiva.com/js/3.2/affdex.js"></script>
  <script src="js/main.js"></script>
	<script src="https://d3js.org/d3.v4.min.js"></script>
  <script src="https://d3js.org/d3.v3.min.js"></script>
</head>

<body class="container" style="background-color: #111111" onresize="resize()">
  <div id="text-width"></div>
  <div id="lightbox"></div>
	<img id="light" style="position: absolute; top: 3px; right: 3px; border: 0;" src="src/light.png" alt="light" title = "Open Light" width="50" height="50" onclick="openlight()">
	<div class="message"></div>


  <button type="button" id= "flip" class="btn btn-primary filp"><span id="grade">Survey It</span></button>
  <div class="panel" id="panel">
      <h3> Thanks You for Participate this Survey! </h3>
      <p>There are three Questions for you to answer</p>
      <hr>
        <form name="questionaire" action=<?php echo "data.php?vid=".$_GET["vid"];?> method="post">
          <div class="well">
            <div class="grade_entry">
              <label>Would you like this video?</label>
              <span id="like">Moderate</span>
            </div>
            <input type="range" id="rangelike" name="like" min="0" max="6" step="1" onChange="displaylike()"></input>
          </div>
          <div class="well">
            <div class="grade_entry">
              <label>Would you purchase the product or donote for this video? If it is ad</label>
              <span id="buy">No Sure</span>
            </div>
            <input type="range" id="rangebuy" name="buy" min="0"  max="4" step="1" onChange="displaybuy()"></input>
          </div>   
          <div class="well">
            <div class="grade_entry">
              <label>Do you agree that this video influent your emotion?</label>
              <span id="emotion">No Sure</span>
            </div>
            <input type="range" id="rangeemo" name="emotion" min="0"  max="4" step="1" onChange="displayemo()"></input>
          </div>
          <input type="text" name="joy" style="display:none;">
          <input type="text" name="sad" style="display:none;">
          <input type="text" name="disgust" style="display:none;">
          <input type="text" name="contempt" style="display:none;">
          <input type="text" name="anger" style="display:none;">
          <input type="text" name="fear" style="display:none;">
          <input type="text" name="surprise" style="display:none;">
          <input type="text" name="engagement" style="display:none;">
          <input type="text" name="count" style="display:none;">
          <input type="text" name="pvalence" style="display:none;">
          <input type="text" name="nvalence" style="display:none;">
          <input type="text" name="data" style="display:none;">   
          <input type="text" name="vid" style="display:none;">
          <p style="float:left;color:#000000";>Please Click Confirm at First, then submit</p>  
          <input id="submit" title="Submit Survey" class="btn btn-success" type="submit" data-inline="true" disabled="true" style="color:rgb(255,255,255);"></input>
          <button type="button" class="btn btn-primary" onclick="check()" style="float:right;">Confirm</button>     
        </form>
      </div>
  </div>

  <img id="camera" style="position: absolute; top: 10px; right: 65px; border: 0;" src="src/camera_o.png" alt="light" title = "Open Camera View" width="40" height="40">
  <div class="panel2" id="panel2" style="display: none;">
      <h3> Welcome to Youtube Video Analysis System<h3>
      <h6> Before all, Please Check Your Camera. You can also click top light camera icon to see your Camera</h6>
      <div class="container-fluid">
        <div class="row">
          <div class="camera" id="affdex_elements"></div>
          <div class="alert-info">
            <div style="height:25em;">
              <strong>EMOTION TRACKING RESULTS</strong>
              <div id="results" style="word-wrap:break-word;"></div>
            </div>
            <div>
              <strong>DETECTOR LOG MSGS</strong>
            </div>
            <div id="logs"></div>
            <button id="start" onclick="onStart()">Start</button>
            <button id="stop" onclick="onStop()">Stop</button>
            <button id="reset" onclick="onReset()">Reset</button>
          </div>
        </div>
      </div>
  </div>

  <div id="demo-setup">
    <div id="messages" class="row">
          <div class="col-md-6 col-md-offset-3 demo-message" id="msg-starting-webcam">
              <div class="alert alert-info" role="alert">Connecting to webcam...</div>
          </div>
          <div class="col-md-6 col-md-offset-3 demo-message" id="msg-starting-record">
              <div class="alert alert-success" role="alert">Start Recording</div>
          </div>
          <div class="col-md-6 col-md-offset-3 demo-message" id="msg-webcam-failure">
              <div class="alert alert-danger" role="alert"><strong>Error: </strong>Failed to connect to webcam.</div>
          </div>
          <div class="col-md-6 col-md-offset-3 demo-message" id="msg-detector-status">
              <div class="alert alert-info" role="alert">Loading and starting the emotions detector, this may take few minutes ...</div>
          </div>
          <div class="col-md-6 col-md-offset-3 demo-message" id="msg-bad-url">
              <div class="alert alert-warning" role="alert"><strong>Error: </strong>Please enter a valid YouTube URL or search phrase.</div>
          </div>
          <div class="col-md-6 col-md-offset-3 demo-message" id="msg-short-video">
              <div class="alert alert-warning" role="alert"><strong>Error: </strong>That YouTube video is too short.</div>
          </div>
          <div class="col-md-6 col-md-offset-3 demo-message" id="msg-webcam-stop">
              <div class="alert alert-success" role="alert">Webcam stopped.</div>
          </div>
      </div>
  </div>

	<div class="row" id="video-container">
    <div class="col-md-12 text-center">
      <div class="embed-responsive embed-responsive-16by9">
         <iframe id="yplayer" class="embed-responsive-item" type="text/html"
        src="https://www.youtube.com/embed/wJxNhJ8fjFk?enablejsapi=1"
        frameborder="0"
        style="border: solid 4px #37474F"
        ></iframe>       
      </div>
      <div id="svg-container">
          <div id="ul-wrapper" class="col-md-10">
            <div class="graph"></div>
          </div>
          <div class="row">
              <div id="ul-wrapper" class="col-md-2">
                  <ul id="nav" style="list-style-type: none;">
                  <li class="joy buttons smiling-face joy-box box-squared" id="joy" onClick="JSSDKDemo.responses(this.id)"><span>Joy</span></li>
                  <li class="sadness buttons sad-face sad-box box-squared" id="all"><span>Sadness</span></li>
                  <li class="disgust buttons disgusted-face disgust-box box-squared" id="disgust"  onClick="JSSDKDemo.responses(this.id)"><span>Disgust</span></li>
                  <li class="contempt buttons contempt-face contempt-box box-squared" id="contempt"  onClick="JSSDKDemo.responses(this.id)"><span>Contempt</span></li>
                  <li class="anger buttons angry-face anger-box box-squared" id="anger" onClick="JSSDKDemo.responses(this.id)"><span>Anger</span></li>
                  <li class="fear buttons fear-face fear-box box-squared" id="all"><span>Fear</span></li>
                  <li class="surprise buttons surprise-face surprise-box box-squared" id="surprise"  onClick="JSSDKDemo.responses(this.id)"><span>Surprise</span></li>
                  </ul>
              </div>
              <div id="count"></div>
          </div>
      </div>
    </div>
	</div>
</body>
</html>

<script>
