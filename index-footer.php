
  <footer>

  </footer>


  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

 <script>
  $(function () {

            //variables
            var canvas = document.getElementById("chelseaLogo");
            var CanvasContext = canvas.getContext("2d");
            var centerX = canvas.width / 2;
            var centerY = canvas.height / 2;
            var radius = 170;
            var radiusWhite = radius - 50;

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

            //text top
            CanvasContext.font = '35pt Calibri';
            CanvasContext.fillText('Chelsea', 115, 150);

            //stroke 
            CanvasContext.strokeStyle = '#EDD202';
            CanvasContext.lineWidth = 1;
            CanvasContext.strokeText('Chelsea', 115, 150);

            //text bottom
            CanvasContext.font = '30pt Calibri';
            CanvasContext.fillText('Football Club', 85, 200);

            //stroke
            CanvasContext.strokeStyle = '#EDD202';
            CanvasContext.lineWidth = 1;
            CanvasContext.strokeText('Football Club', 85, 200);
       
});

 </script>

  <script src="js/plugins.js"></script>
  <script src="js/script.js"></script>

  <!-- <script src="//ajax.googleapis.com/ajax/libs/mootools/1.4/mootools-yui-compressed.js" type="text/javascript"></script> -->
  <script type="text/plain" class="cc-onconsent-analytics">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30524183-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  </script>

</body>
</html>