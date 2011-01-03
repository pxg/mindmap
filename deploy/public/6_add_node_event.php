<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
	<meta equiv="Content-type" content="text/html; charset=utf8" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="_includes/js/jquery-ui-1.8.7.custom.min.js"></script>
    <script src="_includes/js/jquery.livequery.js" type="text/javascript" charset="utf-8"></script>

	<style type="text/css">
	canvas {
		position:absolute;
		width: 800px;
		height: 600px;
		background-color: #A100FF;
	}
	.blk
	{
		opacity: 0.9;
		border:1px solid #000;
		background:#fff;
		position:absolute;
		padding: 5px;
		z-index: 10
	}
	.blk h1, .blk ul, .blk li {
		margin:0;
		padding:0;
		list-style:none
	}
	#blk-a{
		left:15px;
		top:50px;
	}

	#blk-b{
		left:555px;
		top:100px;
	}

    #blk-c{
        left: 38px;
        top: 408px;
    }

    .node{
        background-color: #FFF58E;
    }

    #nucleus{
        left: 300px;
        top: 250px;
    }

    #add-node{
        position:absolute;
        left: 820px;
        top: 20;
    }

    #add-node-button{
        font-size: 16px;
    }

	</style>

	<script type="text/javascript">
	function updateCanvas(canvasJq, blkEls) {
		var canvasEl = canvasJq[0];
		canvasEl.width=canvasJq.width();
		canvasEl.height=canvasJq.height();
		var cOffset = canvasJq.offset();
		var ctx = canvasEl.getContext("2d");
		ctx.clearRect(0, 0, canvasEl.width, canvasEl.height);
		ctx.beginPath();

        var targetDiv=$("#nucleus");
        var trgOffset=targetDiv.offset();
        var trgMidHeight=targetDiv.height()/2;
        var trgMidWidth=targetDiv.width()/2;

		$(blkEls).each(function(){
			var div=$(this);
			var srcOffset=div.offset();
			var srcMidHeight=div.height()/2;
            var srcMidWidth=div.width()/2;
			ctx.moveTo(srcOffset.left - cOffset.left + srcMidWidth, srcOffset.top - cOffset.top + srcMidHeight);
			ctx.lineTo(trgOffset.left - cOffset.left + trgMidWidth, trgOffset.top - cOffset.top + trgMidHeight);
		});
		ctx.stroke();
		ctx.closePath();
	}

    function addDraggableBehaviour() {
        $(".ui-draggable").draggable({
			drag: function() {
				updateCanvas($("#canvas"), $(".node"));
			}
        });
    }

    function addNewNode() {
        $("#add-node-button").click(function() {
            $('<div id="blk-d" class="node blk ui-draggable"><h1>Node D</h1></div>').appendTo("div#main");
            addDraggableBehaviour();
            updateCanvas($("#canvas"), $(".node"));

            // give the div an id (first numeric then alphabetic)
            // add random position for div
            // set name for div from text input
            return false;
        });

    }

	$(document).ready(function(){
        // 1. draw lines for nodes
        updateCanvas($("#canvas"), $(".node"));
        // 2. make nodes draggable
        addDraggableBehaviour();
        // 3. add ability to add a new node
        addNewNode();
    });

	</script>

</head>
<body>
    <div id="main">
        <div id="blk-a" class="node blk ui-draggable">

            <h1>Node A</h1>
        </div>

        <div id="blk-b" class="node blk ui-draggable">
            <h1>Node B</h1>
        </div>

        <div id="blk-c" class="node blk ui-draggable">
            <h1>Node C</h1>
        </div>

        <div id="nucleus" class="blk ui-draggable">
            <h1>Nucleus</h1>
        </div>

        <canvas id="canvas"></canvas>

        <form id="add-node">
            <input type="submit" id="add-node-button" value="Add Node"/>
        <form>
    </div>

</body>
</html>