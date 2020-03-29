<?php
include('header.php');
include('navbar.php');
?>
<br>
<h3 class="text-center">All Games</h3>
<div class="container">
<div class="table-responsive">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th>Game ID</th>
<th>Game Name</th>
<th>Status</th>
<th>Number of Tickets</th>
<th>Options</th>
</tr>
</thead>
<tbody>
<?php
$sql = mysqli_query($con, "SELECT * FROM game");
while($row = mysqli_fetch_array($sql)){
?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['game_name']; ?></td>
<td><?php echo $row['status']; ?></td>
<td><?php echo $row['number_of_tickets']; ?></td>
<td><a href="game.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Game Center</a><a href="delete/game.php?game_id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete Game</a></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
</div>
<?php
include('footer.php');
?>