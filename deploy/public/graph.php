<!DOCTYPE html>
<html lang="en">
<head>
	<meta equiv="Content-type" content="text/html; charset=utf8" />
    <title>mindspider</title>
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
        width: 170px;
        text-align: center;
    }

    #add-node{
        position:absolute;
        left: 820px;
        top: 20px;
    }

    #add-node-button, #add-node-name{
        font-size: 16px;
    }

    span.db_id{
        display: none;
    }

	</style>

	<script type="text/javascript">
    var nodes;
    
	function updateCanvas(canvasJq, blkEls) {
		var canvasEl = canvasJq[0];
		canvasEl.width=canvasJq.width();
		canvasEl.height=canvasJq.height();
		var cOffset = canvasJq.offset();
		var ctx = canvasEl.getContext("2d");
		ctx.clearRect(0, 0, canvasEl.width, canvasEl.height);
		ctx.beginPath();

        var targetDiv=$(".nucleus");
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
			},
//            start: function (){
//                $('.node').css('background-color', '#FFF58E');
//                if($(this).hasClass('node')){
//                    $(this).css('background-color', '#FFF719');
//                }
//            },
            stop: function(event, ui) {
                // TODO: could we move the variable stuff to the updateNode function?
                var db_id = ($(this).children('span').text());
                var x_position = $(this).css('left'); // lose px
                var y_position =  $(this).css('top'); // lose px
                x_position = x_position.replace('px', '');
                y_position = y_position.replace('px', '');
                updateNode(db_id, x_position, y_position);
            }

        });
    }

    function addNewNode() {
        $("#add-node-button").click(function() {
            var node_name = $('#add-node-name').val();
            var x_position = randomMinToMax(0, 700);
            var y_position = randomMinToMax(0, 500);
            // TODO: Make graph_id available throughout functions (Make class and var?)
            var graph_id = getUrlVars()["id"];
            
            $.ajax({
                type: "POST",
                url: "add_node.php",
                data: "x_position=" + x_position + "&y_position=" + y_position + "&name=" + node_name + "&graph_id=" + graph_id,
                success: function(msg){
                    //alert("Data Saved: " + msg);
                    var db_id = msg;
                    var node_number = addNewNodeHtml(node_name, x_position, y_position, db_id, 0);
                    addDraggableBehaviour();
                    updateCanvas($("#canvas"), $(".node"));
                    node_number = node_number + 2;
                    $('#add-node-name').val('Node ' + node_number);
                    //return false;
                }
            });
            return false;
        });
    }

    function addNewNodeHtml(node_name, x_position, y_position, db_id, nucleus){
        var node_number = $('.blk').size();
        var node_id = 'blk-' + node_number;
        if(nucleus == 1){
            $('<div id="' + node_id + '" class="nucleus blk ui-draggable"><h1>' + node_name + '</h1><span class="db_id">' + db_id + '</span></div>').appendTo("div#main");
        }else{
            $('<div id="' + node_id + '" class="node blk ui-draggable"><h1>' + node_name + '</h1><span class="db_id">' + db_id + '</span></div>').appendTo("div#main");
        }
        $('#' + node_id).css('top', y_position);
        $('#' + node_id).css('left', x_position);
        return node_number;
    }

    function randomMinToMax(min, max) {
        var range = max - min + 1;
        return Math.floor(Math.random()*range+min);
    }

    function getUrlVars(){
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    function getNodes(){
        var id = getUrlVars()["id"];
        $.getJSON("graph_data.php?id=" + id, function(json) {
            createNodes(json);
            addDraggableBehaviour();
            updateCanvas($("#canvas"), $(".node"));
        });
    }

    function updateNode(db_id, x_position, y_position){
        //TODO: can data be passed as an array?
        $.ajax({
            type: "POST",
            url: "update_node.php",
            data: "id=" + db_id + "&x_position=" + x_position + "&y_position=" + y_position,
            success: function(msg){
                //alert("Data Saved: " + msg);
            }
        });
    }

    function createNodes(json){
        $.each(json, function(i,item){
            addNewNodeHtml(item.name, parseInt(item.x_position), parseInt(item.y_position), item.id, item.nucleus);
        });
    }

    function highlightNode(){
        $('.node').live('click', function() {
            $('.node').css('background-color', '#FFF58E');
            $(this).css('background-color', '#FFF719');
        });
    }

	$(document).ready(function(){
        getNodes();
        addDraggableBehaviour();
        addNewNode();
        highlightNode();
    });

	</script>

</head>
<body>
    <div id="main">
        
        <canvas id="canvas"></canvas>

        <form id="add-node" action="">
            <input type="text" id="add-node-name" value="Node 4" />
            <br/>
            <input type="submit" id="add-node-button" value="Add Node"/>
            <!--<p id="add-node-button">Add Node</p>-->
        </form>

        <br/>
        <a href="/add_node.php">add node</a>
    </div>

</body>
</html>
