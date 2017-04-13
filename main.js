/*-------------------------light animation---------------------------------------------*/
function openlight(){
	if(document.getElementById("light").alt == "light"){
		document.getElementById("light").src = "lightoff.png";
		document.body.style.backgroundColor = "#FFFFFF";
		document.getElementById("light").alt = "lightoff";
		document.getElementById("light").title="Close Light";
	} else {
		document.getElementById("light").src = "light.png";
		document.body.style.backgroundColor = "#111111";
		document.getElementById("light").alt = "light";	
		document.getElementById("light").title="Open Light";
	}
}

/*-------------------Survey Slide------------------------------------------------------*/
function displaylike(){
	var input = document.getElementById("rangelike").value;
	if (input == 0){
		document.getElementById("like").innerHTML = "Strongly Dislike";
	}
	else if(input == 1){
		document.getElementById("like").innerHTML = "Dislike";
	}
	else if(input == 2){
		document.getElementById("like").innerHTML = "A Little Dislike";
	}
	else if(input == 3){
		document.getElementById("like").innerHTML = "Moderate";
	}
	else if(input == 4){
		document.getElementById("like").innerHTML = "A Little like";
	}
	else if(input == 5){
		document.getElementById("like").innerHTML = "like";
	}
	else if(input == 6){
		document.getElementById("like").innerHTML = "Strongly like";
	}

}

function displaybuy(){
	var input = document.getElementById("rangebuy").value;
	if (input == 0){
		document.getElementById("buy").innerHTML = "No, and thumb down";
	}
	else if(input == 1){
		document.getElementById("buy").innerHTML = "No";
	}
	else if(input == 2){
		document.getElementById("buy").innerHTML = "No Sure";
	}
	else if(input == 3){
		document.getElementById("buy").innerHTML = "Yes";
	}
	else if(input == 4){
		document.getElementById("buy").innerHTML = "Yes, and recommend";
	}
}

function displayemo(){
	var input = document.getElementById("rangeemo").value;
	if (input == 0){
		document.getElementById("emotion").innerHTML = "Strongly Disagree";
	}
	else if(input == 1){
		document.getElementById("emotion").innerHTML = "Disagree";
	}
	else if(input == 2){
		document.getElementById("emotion").innerHTML = "No Sure";
	}
	else if(input == 3){
		document.getElementById("emotion").innerHTML = "Agree";
	}
	else if(input == 4){
		document.getElementById("emotion").innerHTML = "Strongly Agree";
	}
}


/*---------------------------slide animation -------------------------------------------------------*/
$(document).ready(function(){
    $("#flip").click(function(){
        if ($('#panel').is(':visible')){
        	$("#panel").slideUp("slow");
        	document.getElementById("grade").innerHTML="Survey It";
		} else {
			$("#panel").slideDown("slow");
			document.getElementById("grade").innerHTML="Roll Up";
		}
    });
});

$(document).ready(function(){
    $("#camera").click(function(){
        if ($('#panel2').is(':visible')){
        	$("#panel2").slideUp("slow");
        	document.getElementById("camera").src="camera.png";
		} else {
			$("#panel2").slideDown("slow");
			document.getElementById("camera").src="camera_o.png";
		}
    });
});

$(document).ready(function(){
    $("#youtube").click(function(){
        if ($('#panel3').is(':visible')){
        	$("#panel3").slideUp("slow");
        	document.getElementById("youtube").src="youtube.png";
		} else {
			$("#panel3").slideDown("slow");
			document.getElementById("youtube").src="youtube.png";
		}
    });
});

/*--------------------------------------data REST ------------------------------------------------*/
function submit(){

}
/*----------------------------------------resize--------------------------------------------------*/
function resize(){
    var w = window.outerWidth;
    var h = window.outerHeight;
}
/*-------------------------------------init-------------------------------------------------------*/
$(document).ready(function(){

/*-------------------------------------------youtube init ----------------------------------------*/
	var tag = document.createElement('script');
	tag.id = 'iframe-demo';
	tag.src = 'https://www.youtube.com/iframe_api';
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	var player;
/*--------------------------------------------d3 init --------------------------------------------*/
	var limit = 60 * 1,
        duration = 750,
        now = new Date(Date.now() - duration)

    var width = 600,
        height = 300

    var groups = {
        joy: {
            value: 0,
            color: 'orange',
            data: d3.range(limit).map(function() {
                return 0
            })
        },
        sadness: {
            value: 0,
            color: 'green',
            data: d3.range(limit).map(function() {
                return 0
            })
        },
        fear: {
            value: 0,
            color: 'red',
            data: d3.range(limit).map(function() {
                return 0
            })
        },
        anger: {
            value: 0,
            color: 'pink',
            data: d3.range(limit).map(function() {
                return 0
            })
        },
        disgust: {
            value: 0,
            color: 'deeppink',
            data: d3.range(limit).map(function() {
                return 0
            })
        },
        contempt: {
            value: 0,
            color: 'yellow',
            data: d3.range(limit).map(function() {
                return 0
            })
        },
        surprise: {
            value: 0,
            color: 'purple',
            data: d3.range(limit).map(function() {
                return 0
            })
        }
    }

    var x = d3.time.scale()
        .domain([now - (limit - 2), now - duration])
        .range([24, width])

    var y = d3.scale.linear()
        .domain([0, 100])
        .range([height, 10])

    var line = d3.svg.line()
        .interpolate('basis')
        .x(function(d, i) {
            return x(now - (limit - 1 - i) * duration)
        })
        .y(function(d) {
            return y(d)
        })

    var svg = d3.select('.graph').append('svg')
        .attr('class', 'chart')
        .attr('width', width)
        .attr('height', height+100)

    var axis = svg.append('g')
        .attr('class', 'x axis')
        .attr('transform', 'translate(0,' + height + ')')
        .call(x.axis = d3.svg.axis().scale(x).orient('bottom'))

    var yaxis = svg.append('g')
        .attr('class', 'y axis')
        .attr('transform', 'translate(30)')
        .call(y.axis = d3.svg.axis().scale(y).orient('left'))

    var paths = svg.append('g')

    for (var name in groups) {
        var group = groups[name]
        group.path = paths.append('path')
            .data([group.data])
            .attr('class', name + ' group')
            .style('stroke', group.color)
    }


  /*----------------------------------------Affectiva init-------------------------------*/
  // SDK Needs to create video and canvas nodes in the DOM in order to function
  // Here we are adding those nodes a predefined div.
  var divRoot = $("#affdex_elements")[0];
  var width = window.innerWidth*0.6;
  var height = window.innerWidth*0.6*0.75;
  var face_visible = true;
  var capture_frames = true;
  var frames_since_last_face = 0;
  var memory = [];
  document.getElementById("camera").style.margin = "auto";

  var faceMode = affdex.FaceDetectorMode.LARGE_FACES;
  //Construct a CameraDetector and specify the image width / height and face detector mode.
  detector = new affdex.CameraDetector(divRoot, width, height, faceMode);

  //Enable detection of all Expressions, Emotions and Emojis classifiers.
  detector.detectAllEmotions();
  detector.detectAllExpressions();
  detector.detectAllEmojis();
  detector.detectAllAppearance();

  //Add a callback to notify when the detector is initialized and ready for runing.
  detector.addEventListener("onInitializeSuccess", function() {
    show_message("msg-starting-webcam");
	//Display canvas instead of video feed because we want to draw the feature points on it
	$("#face_video_canvas").css("display", "block");
	$("#face_video").css("display", "none");
  });

  //Add a callback to notify when camera access is allowed
  detector.addEventListener("onWebcamConnectSuccess", function() {
    show_message("msg-starting-webcam");
  });

  //Add a callback to notify when camera access is denied
  detector.addEventListener("onWebcamConnectFailure", function() {
    show_message("msg-webcam-failure");
  });

  //Add a callback to notify when detector is stopped
  detector.addEventListener("onStopSuccess", function() {
    show_message("msg-webcam-stop");
    $("#results").html("");
  });

  //Add a callback to receive the results from processing an image.
  //The faces object contains the list of the faces detected in an image.
  //Faces object contains probabilities for all the different expressions, emotions and appearance metrics
  detector.addEventListener("onImageResultsSuccess", function(faces, image, timestamp) {
    $('#results').html("");
    log('#results', "Timestamp: " + timestamp.toFixed(2));
    log('#results', "Number of faces found: " + faces.length);

    if(capture_frames){
      if (frames_since_last_face > 100 && face_visible) {
          face_visible = false;
          create_alert("no-face", "No face was detected. Please re-position your face and/or webcam.");
      }
    
      if (faces.length > 0) {
          if (!face_visible) {
              face_visible = true;
              fade_and_remove("#no-face");
              $("#lightbox").fadeOut(1000);
          }
          frames_since_last_face = 0;
      		log('#results', "Appearance: " + JSON.stringify(faces[0].appearance));
      		log('#results', "Emotions: " + JSON.stringify(faces[0].emotions, function(key, val) {
      		return val.toFixed ? Number(val.toFixed(0)) : val;
      		}));
      		log('#results', "Expressions: " + JSON.stringify(faces[0].expressions, function(key, val) {
      		return val.toFixed ? Number(val.toFixed(0)) : val;
      		}));
      		log('#results', "Emoji: " + faces[0].emojis.dominantEmoji);
      		drawFeaturePoints(image, faces[0].featurePoints);
              //d3 add entry
          now = new Date()

          for (var name in groups) {
              var group = groups[name]
              //group.data.push(group.value) // Real values arrive at irregular intervals
              group.data.push(faces[0].emotions[name])
              group.path.attr('d', line)
              memory.push(timestamp.toFixed(2)+Math.round(faces[0].emotions))
          }

          //document.getElementById("memory").innerHTML = memory;

          // Shift domain
          x.domain([now - (limit - 2) * duration, now - duration])

          // Slide x-axis left
          axis.transition()
              .duration(duration)
              .ease('linear')
              .call(x.axis)

          // Slide paths left
          paths.attr('transform', null)
              .transition()
              .duration(duration)
              .ease('linear')
              .attr('transform', 'translate(' + x(now - (limit - 1) * duration) + ')')
              //.each('end', onImageResultsSuccess)

          // Remove oldest data point from each group
          for (var name in groups) {
              var group = groups[name]
              group.data.shift()
          }
      } else {
          frames_since_last_face++;       
      }
    }

    });

  //Draw the detected facial feature points on the image
  function drawFeaturePoints(img, featurePoints) {
  	var contxt = $('#face_video_canvas')[0].getContext('2d');

  	var hRatio = contxt.canvas.width / img.width;
  	var vRatio = contxt.canvas.height / img.height;
  	var ratio = Math.min(hRatio, vRatio);

  	contxt.strokeStyle = "#FFFFFF";
  	for (var id in featurePoints) {
  	  contxt.beginPath();
  	  contxt.arc(featurePoints[id].x,
  	    featurePoints[id].y, 2, 0, 2 * Math.PI);
  	  contxt.stroke();

  	}
  }
	onStart();

});


function log(node_name, msg) {
  $(node_name).append("<span>" + msg + "</span><br />")
}

//function executes when Start button is pushed.
function onStart() {
  if (detector && !detector.isRunning) {
              $("#logs").html("");
    detector.start();
  }
  log('#logs', "Clicked the start button");
}

//function executes when the Stop button is pushed.
function onStop() {
  log('#logs', "Clicked the stop button");
  fade_and_remove("#no-face");
  $("#lightbox").fadeOut(1000);
  if (detector && detector.isRunning) {
    detector.removeEventListener();
    detector.stop();
  }
};

//function executes when the Reset button is pushed.
function onReset() {
  log('#logs', "Clicked the reset button");
  if (detector && detector.isRunning) {
    detector.reset();

    $('#results').html("");
  }
};


function onYouTubeIframeAPIReady() {
	player = new YT.Player('existing-iframe-example', {
	    events: {
	      'onReady': onPlayerReady,
	      'onStateChange': onPlayerStateChange
	    }
	});
}

function onPlayerReady(event) {
	document.getElementById('existing-iframe-example').style.borderColor = '#FF6D00';
}

function changeBorderColor(playerStatus) {
	var color;
	if (playerStatus == -1) {
	  color = "#37474F"; // unstarted = gray
	} else if (playerStatus == 0) {
	  color = "#FFFF00"; // ended = yellow
    onStop();
	} else if (playerStatus == 1) {
	  color = "#33691E"; // playing = green
    $(".demo-message").hide();
	} else if (playerStatus == 2) {
	  color = "#DD2C00"; // paused = red
	} else if (playerStatus == 3) {
	  color = "#AA00FF"; // buffering = purple
	} else if (playerStatus == 5) {
	  color = "#FF6DOO"; // video cued = orange
	}
	if (color) {
	  document.getElementById('existing-iframe-example').style.borderColor = color;
	}
}

function onPlayerStateChange(event) {
	changeBorderColor(event.data);
}

/*-----------------------------------d3-----------------------------------------------*/
var add_cursor = function() {
    // drag and drop
    var curve = d3.select("#svg-curve");
    var drag_group = curve.append("svg:g").attr("y1", 0).attr("y2", 250).attr("x1", 0).attr("x2", 10).attr("class", "draggable-group");
    drag_group.append("svg:rect").attr("x", -5).attr("y", 0).attr("width", 10).attr("height", 250).attr("class", "draggable-rect");
    drag_group.append("svg:line").attr("class", "cursor cursor-wide").attr("y1", 0).attr("y2", 250).attr("x1", 0).attr("x2", 0);

    drag_group.call(d3.behavior.drag().on("drag", function() {
        var x_coord = d3.event.x;
        var playback_time = t.invert(x_coord);
        
        if (playback_time < 0) {
            x_coord = 0;
            playback_time = 0;
        } else if (playback_time >= video_cutoff_sec) {
            playback_time = video_cutoff_sec - 0.001;
            x_coord = t(playback_time);
        }
        
        translate_cursor(x_coord);
        player.seekTo(playback_time);
        
    }).on("dragstart", function(event) {
        if (playing) {
            clearInterval(cursor_interval);
        }
        $("html, .draggable-rect, line.cursor-wide").css({"cursor": "-webkit-grabbing"});
        $("html, .draggable-rect, line.cursor-wide").css({"cursor": "-moz-grabbing"});
        $("html, .draggable-rect, line.cursor-wide").css({"cursor": "grabbing"});
    }).on("dragend", function() {
        if (playing) {
            track_video();
        }
        $("html").css({"cursor": "default"});
        $(".draggable-rect, line.cursor-wide").css("cursor", "pointer");
    }));

    curve.append("svg:text").attr("class", "time video_current_time").attr("y", 20).attr("x", 5).text("0:00");
    curve.on("click", svg_click);
};

var svg_click = function() {
    var x_click = d3.mouse(this)[0];
    var playback_time = t.invert(x_click);
    
    if (playback_time >= video_cutoff_sec) {
        playback_time = video_cutoff_sec - 0.001;
        x_click = t(playback_time);
    }
    
    if (playing) {
        clearInterval(cursor_interval);
    }
    
    translate_cursor(x_click);
    player.seekTo(playback_time);
    
    if (playing) {
        track_video();
    }
};

var create_alert = function(id, text) {
    $("#lightbox").fadeIn(500);
    $("<div></div>", {
        id: id,
        class: "alert alert-danger",
        display: "none",
        text: text,
    }).appendTo("#lightbox");
    $("#" + id).css({"text-align": "center", "z-index": 2});
    $("#" + id).fadeIn(1000);
};

var show_message = function(id) {
    $(".demo-message").hide();
    $(document.getElementById(id)).fadeIn("fast");
};

var fade_and_remove = function(id) {
    $(id).fadeOut(500, function() {
        this.remove();
    });
};