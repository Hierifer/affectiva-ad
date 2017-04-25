<?php
  session_start();

  if(isset($_POST["user"])){
      if($_POST["user"] != ""){
        $_SESSION["user"] = $_POST["user"];
      } else {
        header('Location: /dashboard/new/signin.html?err=invalid_username');
      }
  } else{
    if(!isset($_SESSION["user"])){
      header('Location: /dashboard/new/signin.html?err=not_login');
    }      
  }

  $graded = array();

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

  $sql = "SELECT video FROM video WHERE email = '".$_SESSION["user"]."';";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        array_push($graded,$row["video"]);
      }
  }


  $conn->close();
?>



<html>
<head>
	<title>Dashboard</title>
	<meta charset="UTF-8">
  <meta name="description" content = "Youtube Analysis powered by Affectiva">
  <meta name="keywords" content ="Youtube，Affect Computing, Affectiva">
  <meta name="author" content ="BF8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="src/icon.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
  <script src="https://download.affectiva.com/js/3.2/affdex.js"></script>
</head>

<script>
  function change_eye(x){
    x.src="src/eye_hover.png";
  }

  function back_eye(x){
    x.src="src/eye.png";
  }

  function change_note(x){
    x.src="src/note_hover.png";
  }

  function back_note(x){
    x.src="src/note.png";
  }

  function change_analysis(x){
    x.src="src/analysis_hover.png";
  }

  function back_analysis(x){
    x.src="src/analysis.png";
  }
</script>

<body>
  <div class="container">
    <div id="header" >
      <h2>Hello <?php echo $_SESSION["user"]?></h2>
      <a style="position:absolute; top:10px; right:10px;display:none;" href="default.asp"><img onmouseover="change_analysis(this)" onmouseout="back_analysis(this)" src="src/analysis.png" alt="analysis" title="See the general analysis" style="width:42px;height:42px;border:0"></a>
    </div>
    <p>There are several video are avalible to watch. Click eye icon to watch and notebook icon to see the result.</p>
    <div class="well">            
      <h3>commercial Advertisement</h3>
      <br>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Video</th>
            <th>Status</th>
            <th>Operations</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Thai Peppermint Inhaler</td>
            <td><?php if(in_array("DVdZ9KjQvIA", $graded)){echo "finished";}else{echo "unfinish";} ?></td>
            <td>       
              <a href="watch.php?vid=DVdZ9KjQvIA"><img onmouseover="change_eye(this)" onmouseout="back_eye(this)" src="src/eye.png" alt="eye" title="Watch this video" style="width:42px;height:42px;border:0"></a>
              <a href="data.php?vid=DVdZ9KjQvIA" style="padding-left: 50px;<?php if(!in_array("DVdZ9KjQvIA", $graded)){echo "display:none;";} ?>" ><img onmouseover="change_note(this)" onmouseout="back_note(this)" src="src/note.png" alt="note" title="Check the record" style="width:42px;height:42px;border:0"></a>
            </td>
          </tr>
          <tr>
            <td>Doritos</td>
            <td><?php if(in_array("aHdrFLai5c4", $graded)){echo "finished";}else{echo "unfinish";} ?></td>
            <td>       
              <a href="watch.php?vid=aHdrFLai5c4"><img onmouseover="change_eye(this)" onmouseout="back_eye(this)" src="src/eye.png" alt="eye" title="Watch this video" style="width:42px;height:42px;border:0"></a>
              <a href="data.php?vid=aHdrFLai5c4" style="padding-left: 50px;<?php if(!in_array("aHdrFLai5c4", $graded)){echo "display:none;";} ?>" ><img onmouseover="change_note(this)" onmouseout="back_note(this)" src="src/note.png" alt="note" title="Check the record" style="width:42px;height:42px;border:0"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="well">  
      <h3>Public Benefit Advertisement</h3>
      <br>     
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Video</th>
            <th>Status</th>
            <th>Operations</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Removing a plastic straw from a sea turtle's nostril</td>
            <td><?php if(in_array("d2J2qdOrW44", $graded)){echo "finished";}else{echo "unfinish";} ?></td>
            <td>       
              <a href="watch.php?vid=d2J2qdOrW44"><img onmouseover="change_eye(this)" onmouseout="back_eye(this)" src="src/eye.png" alt="eye" title="Watch this video" style="width:42px;height:42px;border:0"></a>
              <a href="data.php?vid=d2J2qdOrW44" style="padding-left: 50px;<?php if(!in_array("d2J2qdOrW44", $graded)){echo "display:none;";} ?>" ><img onmouseover="change_note(this)" onmouseout="back_note(this)" src="src/note.png" alt="note" title="Check the record" style="width:42px;height:42px;border:0"></a>
            </td>
          </tr>
          <tr>
            <td>Marine Pollution</td>
            <td><?php if(in_array("Sp572udnPVg", $graded)){echo "finished";}else{echo "unfinish";} ?></td>
            <td>       
              <a href="watch.php?vid=Sp572udnPVg"><img onmouseover="change_eye(this)" onmouseout="back_eye(this)" src="src/eye.png" alt="eye" title="Watch this video" style="width:42px;height:42px;border:0"></a>
              <a href="data.php?vid=Sp572udnPVg" style="padding-left: 50px;<?php if(!in_array("Sp572udnPVg", $graded)){echo "display:none;";} ?>" ><img onmouseover="change_note(this)" onmouseout="back_note(this)" src="src/note.png" alt="note" title="Check the record" style="width:42px;height:42px;border:0"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="well">
      <h3>Life Insurance Advertisement</h3>
      <br>       
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Video</th>
            <th>Status</th>
            <th>Operations</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Thai Life Insurance</td>
            <td><?php if(in_array("K9vFWA1rnWc", $graded)){echo "finished";}else{echo "unfinish";} ?></td>
            <td>       
              <a href="watch.php?vid=K9vFWA1rnWc"><img onmouseover="change_eye(this)" onmouseout="back_eye(this)" src="src/eye.png" alt="eye" title="Watch this video" style="width:42px;height:42px;border:0"></a>
              <a href="data.php?vid=K9vFWA1rnWc" style="padding-left: 50px;<?php if(!in_array("K9vFWA1rnWc", $graded)){echo "display:none;";} ?>" ><img onmouseover="change_note(this)" onmouseout="back_note(this)" src="src/note.png" alt="note" title="Check the record" style="width:42px;height:42px;border:0"></a>
            </td>
          </tr>
          <tr>
            <td>Metlife Insurance</td>
            <td><?php if(in_array("3bdm4NBYxII", $graded)){echo "finished";}else{echo "unfinish";} ?></td>
            <td>       
              <a href="watch.php?vid=3bdm4NBYxII"><img onmouseover="change_eye(this)" onmouseout="back_eye(this)" src="src/eye.png" alt="eye" title="Watch this video" style="width:42px;height:42px;border:0"></a>
              <a href="data.php?vid=3bdm4NBYxII" style="padding-left: 50px;<?php if(!in_array("3bdm4NBYxII", $graded)){echo "display:none;";} ?>" ><img onmouseover="change_note(this)" onmouseout="back_note(this)" src="src/note.png" alt="note" title="Check the record" style="width:42px;height:42px;border:0"></a>
            </td>
          </tr>
        </tbody>
      </table>
  </div>
</div>
</body>
</html>