<?php $event = $event ?? ["id"=>"", "event_name"=>"", "game_name"=>"", "event_date"=>"", "event_time"=>"", "venue"=>"", "description"=>"", "rules"=>"", "prize"=>"", "status"=>"open"]; ?>
<div class="db-panel">
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo h($event["id"]); ?>">
        <div class="form-group"><label class="form-label">Event Name</label><input class="form-control" name="event_name" value="<?php echo h($event["event_name"]); ?>" required></div>
        <div class="form-group"><label class="form-label">Game Name</label><input class="form-control" name="game_name" value="<?php echo h($event["game_name"]); ?>" required></div>
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px;"><div class="form-group"><label class="form-label">Date</label><input type="date" class="form-control" name="event_date" value="<?php echo h($event["event_date"]); ?>" required></div><div class="form-group"><label class="form-label">Time</label><input type="time" class="form-control" name="event_time" value="<?php echo h($event["event_time"]); ?>" required></div></div>
        <div class="form-group"><label class="form-label">Venue</label><input class="form-control" name="venue" value="<?php echo h($event["venue"]); ?>" required></div>
        <div class="form-group"><label class="form-label">Description</label><textarea class="form-control" name="description"><?php echo h($event["description"]); ?></textarea></div>
        <div class="form-group"><label class="form-label">Rules</label><textarea class="form-control" name="rules"><?php echo h($event["rules"]); ?></textarea></div>
        <div class="form-group"><label class="form-label">Prize</label><input class="form-control" name="prize" value="<?php echo h($event["prize"]); ?>"></div>
        <div class="form-group"><label class="form-label">Status</label><select class="form-control" name="status"><option value="open" <?php if($event["status"]==="open") echo "selected"; ?>>Open</option><option value="upcoming" <?php if($event["status"]==="upcoming") echo "selected"; ?>>Upcoming</option><option value="finished" <?php if($event["status"]==="finished") echo "selected"; ?>>Finished</option></select></div>
        <button class="btn btn-primary" type="submit">Save Event</button>
        <a class="btn btn-secondary" href="manage_events.php">Cancel</a>
    </form>
</div>
