<?php
include('header.php');
include('navbar.php');
?>
<br>
<div class="container">
<h1 class="text-center">Tambola Game Generator</h1>
<a href="new_game.php" class="btn btn-block btn-info">New Game</a>
<a href="list_game.php" class="btn btn-block btn-info">Existing Game</a><br>
<?php
if(date('l') == 'Saturday'){
   $time = strtotime(date('H:i:s'))-strtotime('02:00:00');
?>
<div class="alert alert-danger text-center">Warning: Data will be deleted in <span id="value"><span> IST</div>
<?php
}
?>
</div>
<?php
include('footer.php');
?>
<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo date('m/d/Y 02:00:00', strtotime('+1 days')); ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("value").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("value").innerHTML = "EXPIRED";
  }
}, 1000);
</script>