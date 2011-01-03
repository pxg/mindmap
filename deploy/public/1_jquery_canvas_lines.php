<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
	<meta equiv="Content-type" content="text/html; charset=utf8" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
	<style type="text/css">
	canvas {
		position:absolute;
		width: 800px;
		height: 600px;
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
		left:375px;
		top:250px;
	}
	
	</style>
	<script type="text/javascript">
	
	
	function updateCanvas(canvasJq, blkEls)
	{
		var canvasEl = canvasJq[0];
		canvasEl.width=canvasJq.width();
		canvasEl.height=canvasJq.height();
		var cOffset = canvasJq.offset();
		var ctx = canvasEl.getContext("2d");
		ctx.clearRect(0, 0, canvasEl.width, canvasEl.height);
		ctx.beginPath();
		$(blkEls).each(function(){
			$("li", this).each(function(){
				var li=$(this);
				if(li.attr("rel"))
				{
					var srcOffset=li.offset();
					var srcMidHeight=li.height()/2;
					var targetLi=$("#"+li.attr("rel"));
					if(targetLi.length)
					{
						var trgOffset=targetLi.offset();
						var trgMidHeight=li.height()/2;
						ctx.moveTo(srcOffset.left - cOffset.left, srcOffset.top - cOffset.top + srcMidHeight);
						ctx.lineTo(trgOffset.left - cOffset.left, trgOffset.top - cOffset.top + trgMidHeight);
					}
				}
			});
		});
		ctx.stroke();
		ctx.closePath();
	}
	
	$(document).ready(function(){updateCanvas($("#canvas"), $(".blk"));});
	
	</script>
</head>
<body>
    <div id="blk-a" class="blk">

		<h1>Hello</h1>
		<ul>
			<li id="a" rel="d">Hello</li>
			<li id="b" rel="c">World</li>
		</ul>
	</div>
    <div id="blk-b" class="blk">

		<h1>World</h1>
		<ul>
			<li id="c">Hyvää päivää</li>
			<li id="d">Maailma</li>
		</ul>
	</div>
	<canvas id="canvas"></canvas>

</body>
</html>