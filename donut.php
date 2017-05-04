<?php

/*----------------------------Session-----------------------------------------*/
  session_start();

  if($_SESSION["user"]){
    $username = $_SESSION["user"];
  } else{
    header('Location: index.html?err=not_login');      
  }

  $vid = $_GET["vid"];


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
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $joy = $row["joy"];
          $sad = $row["sad"];
          $disgust = $row["disgust"];
          $contempt = $row["contempt"];
          $anger = $row["anger"];
          $fear = $row["fear"];
          $surprise = $row["surprise"];
          $nonemotion = $row["nonemotion"];
          $engagement = $row["engagement"];
          $distract = $row["distract"];
          $pvalence = $row["pvalence"];
          $nvalence = $row["nvalence"];
          $total = $row["total"];
      }
  } else {
      echo "0 results";
  }

  $conn->close();

  if($total == 0){
    $total = 1;
  } else if($total == $nonemotion){
    $total += 1;
  }
$total2 = $pvalence + $nvalence;
if($total2 == 0){
	$tpta;2 = 1;
}

  $emotion_rate = ($total-$nonemotion)/$total*100;
  $nonemo_rate = $nonemotion/$total*100;

  $engage_rate = $engagement/$total*100;
  $distract_rate = $distract/$total*100;

  $pval_rate = $pvalence/($pvalence + $nvalence)*100; 
  $nval_rate = $nvalence/($pvalence + $nvalence)*100;

  $joy_rate = $joy/($total-$nonemotion)*100;
  $sad_rate = $sad/($total-$nonemotion)*100;
  $fear_rate = $fear/($total-$nonemotion)*100;
  $anger_rate = $anger/($total-$nonemotion)*100;
  $disgust_rate = $disgust/($total-$nonemotion)*100;
  $contempt_rate = $contempt/($total-$nonemotion)*100;
  $surprise_rate = $surprise/($total-$nonemotion)*100;
?>



<!DOCTYPE html>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<style>

body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  width: 500px;
  height: 300px;
  position: relative;
}

svg {
	width: 100%;
	height: 100%;
}

path.slice{
	stroke-width:2px;
}

polyline{
	opacity: .3;
	stroke: black;
	stroke-width: 2px;
	fill: none;
}

.labelValue
{
	font-size: 60%;
	opacity: .5;
	
}

.toolTip {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    position: absolute;
    display: none;
    width: auto;
    height: auto;
    background: none repeat scroll 0 0 white;
    border: 0 none;
    border-radius: 8px 8px 8px 8px;
    box-shadow: -3px 3px 15px #888888;
    color: black;
    font: 12px sans-serif;
    padding: 5px;
    text-align: center;
}
text {
  font: 12px sans-serif;
}
</style>
<body>
<form>
  <label><input type="radio" name="dataset" id="dataset" value="total" checked> Emotions</label>
  <label><input type="radio" name="dataset" id="dataset" value="option1"> Engagement</label>
  <label><input type="radio" name="dataset" id="dataset" value="option2"> Valence</label>
  <label><input type="radio" name="dataset" id="dataset" value="option3"> Emotions 2</label>
</form>

<script src="https://d3js.org/d3.v3.min.js"></script>
<script>
function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

d3.select("input[value=\"total\"]").property("checked", true);

var svg = d3.select("body")
  .append("svg")
  .append("g")

svg.append("g")
  .attr("class", "slices");
svg.append("g")
  .attr("class", "labelName");
svg.append("g")
  .attr("class", "labelValue");
svg.append("g")
  .attr("class", "lines");

var width = 500,
    height = 300,
  radius = Math.min(width, height) / 2;

var pie = d3.layout.pie()
  .sort(null)
  .value(function(d) {
    return d.value;
  });

var arc = d3.svg.arc()
  .outerRadius(radius * 0.8)
  .innerRadius(radius * 0.4);

var outerArc = d3.svg.arc()
  .innerRadius(radius * 0.9)
  .outerRadius(radius * 0.9);

var legendRectSize = (radius * 0.05);
var legendSpacing = radius * 0.02;


var div = d3.select("body").append("div").attr("class", "toolTip");

svg.attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

var colorRange = d3.scale.category20();
var color = d3.scale.ordinal()
  .range(colorRange.range());


datasetTotal = [
    {label:"Emotion", value:Math.round(<?php echo $emotion_rate?>)}, 
    {label:"Non-Eomtion", value:Math.round(<?php echo $nonemo_rate?>)}, 
    ];

datasetOption1 = [
    {label:"Engagement", value:Math.round(<?php echo $engage_rate?>)}, 
    {label:"Distract", value:Math.round(<?php echo $distract_rate?>)}, 
    ];

datasetOption2 = [
    {label:"P. Valence", value:Math.round(<?php echo $pval_rate?>)}, 
    {label:"N. Valence", value:Math.round(<?php echo $nval_rate?>)},
    ];

datasetOption3 = [
    {label:"Joy", value:Math.round(<?php echo $joy_rate?>)}, 
    {label:"Sadness", value:Math.round(<?php echo $sad_rate?>)}, 
    {label:"Fear", value:Math.round(<?php echo $fear_rate?>)},
    {label:"Anger", value:Math.round(<?php echo $anger_rate?>)},
    {label:"Disgust", value:Math.round(<?php echo $disgust_rate?>)},
    {label:"Contempt", value:Math.round(<?php echo $contempt_rate?>)},
    {label:"Surprise", value:Math.round(<?php echo $surprise?>)},
    ];



change(datasetTotal);


d3.selectAll("input")
  .on("change", selectDataset);
  
function selectDataset()
{
  var value = this.value;
  if (value == "total")
  {
    change(datasetTotal);
  }
  else if (value == "option1")
  {
    change(datasetOption1);
  }
  else if (value == "option2")
  {
    change(datasetOption2);
  }
  else if(value == "option3")
  {
    change(datasetOption3);
  }
}

function change(data) {

  /* ------- PIE SLICES -------*/
  var slice = svg.select(".slices").selectAll("path.slice")
        .data(pie(data), function(d){ return d.data.label });

    slice.enter()
        .insert("path")
        .style("fill", function(d) { return color(d.data.label); })
        .attr("class", "slice");

    slice
        .transition().duration(1000)
        .attrTween("d", function(d) {
            this._current = this._current || d;
            var interpolate = d3.interpolate(this._current, d);
            this._current = interpolate(0);
            return function(t) {
                return arc(interpolate(t));
            };
        })
    slice
        .on("mousemove", function(d){
            div.style("left", d3.event.pageX+10+"px");
            div.style("top", d3.event.pageY-25+"px");
            div.style("display", "inline-block");
            div.html((d.data.label)+"<br>"+(d.data.value)+"%");
        });
    slice
        .on("mouseout", function(d){
            div.style("display", "none");
        });

    slice.exit()
        .remove();

    var legend = svg.selectAll('.legend')
        .data(color.domain())
        .enter()
        .append('g')
        .attr('class', 'legend')
        .attr('transform', function(d, i) {
            var height = legendRectSize + legendSpacing;
            var offset =  height * color.domain().length / 2;
            var horz = -3 * legendRectSize;
            var vert = i * height - offset;
            return 'translate(' + horz + ',' + vert + ')';
        });

    /*legend.append('rect')
        .attr('width', legendRectSize)
        .attr('height', legendRectSize)
        .style('fill', color)
        .style('stroke', color);

    legend.append('text')
        .attr('x', legendRectSize + legendSpacing)
        .attr('y', legendRectSize - legendSpacing)
        .text(function(d) { return d; });

    /* ------- TEXT LABELS -------*/

    var text = svg.select(".labelName").selectAll("text")
        .data(pie(data), function(d){ return d.data.label });

    text.enter()
        .append("text")
        .attr("dy", ".35em")
        .text(function(d) {
            return (d.data.label+": "+d.value+"%");
        });

    function midAngle(d){
        return d.startAngle + (d.endAngle - d.startAngle)/2;
    }

    text
        .transition().duration(1000)
        .attrTween("transform", function(d) {
            this._current = this._current || d;
            var interpolate = d3.interpolate(this._current, d);
            this._current = interpolate(0);
            return function(t) {
                var d2 = interpolate(t);
                var pos = outerArc.centroid(d2);
                pos[0] = radius * (midAngle(d2) < Math.PI ? 1 : -1);
                return "translate("+ pos +")";
            };
        })
        .styleTween("text-anchor", function(d){
            this._current = this._current || d;
            var interpolate = d3.interpolate(this._current, d);
            this._current = interpolate(0);
            return function(t) {
                var d2 = interpolate(t);
                return midAngle(d2) < Math.PI ? "start":"end";
            };
        })
        .text(function(d) {
            return (d.data.label+": "+d.value+"%");
        });


    text.exit()
        .remove();

    /* ------- SLICE TO TEXT POLYLINES -------*/

    var polyline = svg.select(".lines").selectAll("polyline")
        .data(pie(data), function(d){ return d.data.label });

    polyline.enter()
        .append("polyline");

    polyline.transition().duration(1000)
        .attrTween("points", function(d){
            this._current = this._current || d;
            var interpolate = d3.interpolate(this._current, d);
            this._current = interpolate(0);
            return function(t) {
                var d2 = interpolate(t);
                var pos = outerArc.centroid(d2);
                pos[0] = radius * 0.95 * (midAngle(d2) < Math.PI ? 1 : -1);
                return [arc.centroid(d2), outerArc.centroid(d2), pos];
            };
        });

    polyline.exit()
        .remove();
};

</script>
</body>
