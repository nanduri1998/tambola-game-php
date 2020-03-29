<?php

include('header.php');

include('navbar.php');

$game_id = $_REQUEST['id'];

$game_sql = mysqli_query($con, "SELECT * FROM game WHERE id = $game_id");

$game_dets = mysqli_fetch_array($game_sql);

?>

<br>

<h2 class="text-center">Game - <?php echo $game_dets['game_name']; ?></h2>

<hr>

<section id="add">

    <div class="container">

        <h3 class="text-center">Add New Player</h3>

        <form action="generate_ticket.php" method="post">

            <div class="form-group"><input type="text" name="player_name" id="player_name" class="form-control" required placeholder="Enter Player Name"></div>

            <input type="hidden" name="game_id" value="<?php echo $game_dets['id']; ?>">

            <div class="form-group"><button type="submit" class="btn btn-info btn-block">Submit</button></div>

        </form>

    </div>

</section>

<hr>

<section id="start">

    <div class="container"><a href="number.php?id=<?php echo $game_id; ?>" class="btn btn-info btn-block">Start Game</a></div>

</section>
<section id="delete">

    <div class="container"><a href="delete/game.php?game_id=<?php echo $game_id; ?>" class="btn btn-danger btn-block">Delete Game</a></div>

</section>


<hr>

<section id="list">

    <div class="container">

        <div class="table-responsive">

            <table class="table table-stripped table-bordered">

                <thead>

                    <tr>

                    <th>Name</th>

                    <th>OTP</th>

                    <th>Ticket ID</th>

                    <th>Options</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                $player_sql = mysqli_query($con, "SELECT * FROM player WHERE game_id = $game_id");

                while($row = mysqli_fetch_array($player_sql)){

                ?>

                <tr>

                    <td><?php echo $row['player_name']; ?></td>

                    <td><?php echo $row['otp']; ?></td>

                    <td><?php echo $row['ticket_id']; ?></td>

                    <td><form action="../player/player.php" method="post">

        <input type="hidden" name="otp" id="otp" placeholder="Enter Your OTP" required value="<?php echo $row['otp']; ?>">

        <button type="submit" class="btn btn-success">Login</button>

    </form><a href="delete/player.php?ticket_id=<?php echo $row['ticket_id']; ?>&game_id=<?php echo $row['game_id']; ?>" class="btn btn-danger">Delete Player</a></td>

                    </tr>

                <?php

                }

                ?>

                </tbody>

            </table>

        </div>

    </div>

</section>

<?php

include('footer.php');
?>
