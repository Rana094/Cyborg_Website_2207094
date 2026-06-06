<?php
$fixture = $fixture ?? ["id"=>"", "event_id"=>"", "round_name"=>"", "team_one"=>"", "team_two"=>"", "match_date"=>"", "match_time"=>"", "status"=>"upcoming"];
$event_options = mysqli_query($conn, "SELECT id, event_name FROM events ORDER BY event_date DESC");
?>
<div class="db-panel"><form action="" method="POST">
    <input type="hidden" name="id" value="<?php echo h($fixture["id"]); ?>">
    <div class="form-group"><label class="form-label">Event</label><select class="form-control" name="event_id" required><?php while ($event_option = mysqli_fetch_assoc($event_options)): ?><option value="<?php echo (int)$event_option["id"]; ?>" <?php if ((int)$fixture["event_id"] === (int)$event_option["id"]) echo "selected"; ?>><?php echo h($event_option["event_name"]); ?></option><?php endwhile; ?></select></div>
    <div class="form-group"><label class="form-label">Round</label><input class="form-control" name="round_name" value="<?php echo h($fixture["round_name"]); ?>" required></div>
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px;"><div class="form-group"><label class="form-label">Team One</label><input class="form-control" name="team_one" value="<?php echo h($fixture["team_one"]); ?>" required></div><div class="form-group"><label class="form-label">Team Two</label><input class="form-control" name="team_two" value="<?php echo h($fixture["team_two"]); ?>" required></div></div>
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px;"><div class="form-group"><label class="form-label">Date</label><input type="date" class="form-control" name="match_date" value="<?php echo h($fixture["match_date"]); ?>" required></div><div class="form-group"><label class="form-label">Time</label><input type="time" class="form-control" name="match_time" value="<?php echo h($fixture["match_time"]); ?>" required></div></div>
    <div class="form-group"><label class="form-label">Status</label><select class="form-control" name="status"><option value="upcoming" <?php if($fixture["status"]==="upcoming") echo "selected"; ?>>Upcoming</option><option value="active" <?php if($fixture["status"]==="active") echo "selected"; ?>>Active</option><option value="completed" <?php if($fixture["status"]==="completed") echo "selected"; ?>>Completed</option></select></div>
    <button class="btn btn-primary" type="submit">Save Fixture</button> <a class="btn btn-secondary" href="manage_fixtures.php">Cancel</a>
</form></div>
