<section class="main">
<canvas id="chelseaLogo" width="400" height="400">  
<b>This browser does not support HTML5 Canvas!</b>  
</canvas>
<script>
var canvas = document.getElementById("chelseaLogo");
var CanvasContext = canvas.getContext("2d");

var canvas = document.getElementById("chelseaLogo");
            var CanvasContext = canvas.getContext("2d");
            var centerX = canvas.width / 2;
            var centerY = canvas.height / 2;
            var radius = 180;
            var radiusWhite = radius - 55;

            // outside logo
            CanvasContext.beginPath();
            CanvasContext.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
            CanvasContext.fillStyle = '#0B49DB';
            CanvasContext.fill();

            //stroke
            CanvasContext.lineWidth = 4;
            CanvasContext.strokeStyle = '#EDD202';
            CanvasContext.stroke();

            //white innercircle
            CanvasContext.beginPath();
            CanvasContext.arc(centerX, centerY, radiusWhite, 0, 2 * Math.PI, false);
            CanvasContext.fillStyle = '#fff';
            CanvasContext.fill();

            //stroke
            CanvasContext.lineWidth = 4;
            CanvasContext.strokeStyle = '#EDD202';
            CanvasContext.stroke();

            // tekst
function drawTextAlongArc(context, str, centerX, centerY, radius, angle, above) {
    var met, wid;
    context.save();
    context.translate(centerX, centerY);
    if (!above) {
        radius = -radius;
        angle = -angle;
    }
    context.rotate(-1 * angle / 2);
    context.rotate(-1 * (angle / str.length) / 2);

    for (var n = 0; n < str.length; n++) {
        var char = str[n];
        met = context.measureText(char);
        wid = met.width;
        console.log(met);
        
        context.rotate(angle / str.length);
        context.fillText(char, -wid / 2, -radius);
        context.strokeText(char, -wid / 2, -radius);
    }
    context.restore();
}
CanvasContext.font = 'bold 40pt impact';
CanvasContext.fillStyle = '#fff';
CanvasContext.strokeStyle = '#E0C91B';
CanvasContext.lineWidth = 2;
drawTextAlongArc(CanvasContext, "CHELSEA", 200, 193, 125, Math.PI*3/5, true);
    
CanvasContext.font = 'bold 20pt impact';
drawTextAlongArc(CanvasContext, "FOOTBALL CLUB", 200, 215, 150, Math.PI*3/5, false);

CanvasContext.beginPath();
CanvasContext.stroke();



</script>
</section>
