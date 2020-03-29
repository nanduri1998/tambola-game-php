<?php
include('header.php');
include('navbar.php');
?>
<br>
<div class="container">
<h1 class="text-center">Tambola Game Generator</h1>
<form action="generate_game.php" method="post">
    <div class="form-group"><input type="text" class="form-control" name="game_name" required placeholder="Enter Game Name"></div>
    <div class="form-group"><input type="number" class="form-control" name="tickets" required placeholder="Enter Number of Tickets to be Generated"></div>
    <div class="form-group"><input type="submit" class="btn btn-block btn-success" name="submit" value="Submit"></div>
</form>
</div>
<?php
include('footer.php');