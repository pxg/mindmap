<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
	<meta equiv="Content-type" content="text/html; charset=utf8" />
    <title>mindmap</title>
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
	#blk-0{
		left:15px;
		top:50px;
	}

	#blk-1{
		left:555px;
		top:100px;
	}

    #blk-2{
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
        top: 20px;
    }

    #add-node-button, #add-node-name{
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
            var node_number = $('.node').size();
            var node_id = 'blk-' + node_number;
            var node_name = $('#add-node-name').val();
            
            $('<div id="' + node_id + '" class="node blk ui-draggable"><h1>' + node_name + '</h1></div>').appendTo("div#main");
            
            $('#' + node_id).css('top', randomMinToMax(0, 500));
            $('#' + node_id).css('left', randomMinToMax(0, 700));
            
            addDraggableBehaviour();
            updateCanvas($("#canvas"), $(".node"));

            node_number = node_number + 2;
            $('#add-node-name').val('Node ' + node_number);
            return false;
        });

    }

    function randomMinToMax(min, max) {
        var range = max - min + 1;
        return Math.floor(Math.random()*range+min);
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
        <div id="blk-0" class="node blk ui-draggable">

            <h1>Node 1</h1>
        </div>

        <div id="blk-1" class="node blk ui-draggable">
            <h1>Node 2</h1>
        </div>

        <div id="blk-2" class="node blk ui-draggable">
            <h1>Node 3</h1>
        </div>

        <div id="nucleus" class="blk ui-draggable">
            <h1>Nucleus</h1>
        </div>

        <canvas id="canvas"></canvas>

        <form id="add-node" action="">
            <input type="text" id="add-node-name" value="Node 4" />
            <br/>
            <input type="submit" id="add-node-button" value="Add Node"/>
        </form>
    </div>

</body>
</html>