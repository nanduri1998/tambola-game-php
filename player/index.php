<?php
include('header.php');
?>
<div class="container">
<br>
<h1 class="text-center">Welcome to Player Login of Tambola Game</h1>
    <form action="player.php" method="post">
        <div class="form-group"><input type="number" name="otp" id="otp" placeholder="Enter Your OTP" required class="form-control"></div>
<div class="form-check form-group">
  <input class="form-check-input" type="checkbox" value="yes" name="req" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
    Check this box if you want the called number to be displayed on your screen.
  </label>
</div>        <div class="form-group"><button type="submit" class="btn btn-block btn-success">Login</button></div>
    </form>

<h3 class="text-center">Rules and Regulations</h3>
<ol>
<li>As a rule, each player must buy at least one ticket to enter a game. A typical 90 ball Tambola ticket consists of 3 rows and 9 columns which make 27 spaces. Each row has a total of 5 numbers printed on it. A column can have 1, 2 or the maximum 3 numbers printed on it. The first column in the ticket will have numbers from 1-9, the second column will have 10-19, third column with 20-29 and so on until the 9th column which will be numbered in between 80-90.</li>
<li><b>Winning Criteria:</b>
<ul>
<li>Early Five : The ticket with first five number dabbed</li>
<li>Top Line: The ticket with all the numbers of the top row dabbed fastest.</li>
<li>Middle Line: The ticket with all the numbers of the middle row dabbed fastest.</li>
<li>Bottom Line: The ticket with the numbers of the bottom row dabbed fasted.</li>
<li>Full House: The ticket with all the 15 numbers marked first.</li>
</ul>
</li>
<li>The game begins with a ball draw. As the game progresses, the board is marked with each ball that is drawn. The objective of the game is to mark/ dab all the numbers found in the ticket as called by the dealer. The player who first mark all the numbers in a winning pattern and calls a win is declared as the WINNER of that pattern after the dealer checks his ticket and verify it with numbers drawn.

If your claimed winning pattern is wrong, it will be called BOOGY and you cannot continue the game with the same ticket.

The game ends when all 90 numbers are drawn, or when a winner is declared for all the patterns of the game, whichever comes first.</li>
</ol>
</div>

<?php
include('footer.php');
?>