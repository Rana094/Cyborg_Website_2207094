<?php $member = $member ?? ["id"=>"", "name"=>"", "position"=>"", "section"=>"additional", "department"=>"", "favorite_game"=>"", "image"=>"logo.png"]; ?>
<div class="db-panel"><form action="" method="POST">
    <input type="hidden" name="id" value="<?php echo h($member["id"]); ?>">
    <div class="form-group"><label class="form-label">Name</label><input class="form-control" name="name" value="<?php echo h($member["name"]); ?>" required></div>
    <div class="form-group"><label class="form-label">Position</label><input class="form-control" name="position" value="<?php echo h($member["position"]); ?>" required></div>
    <div class="form-group">
        <label class="form-label">Committee Section</label>
        <select class="form-control" name="section" required>
            <option value="executive" <?php if (($member["section"] ?? "") === "executive") echo "selected"; ?>>Executive Board</option>
            <option value="secretariat" <?php if (($member["section"] ?? "") === "secretariat") echo "selected"; ?>>Secretariat & Treasury</option>
            <option value="coordinators" <?php if (($member["section"] ?? "") === "coordinators") echo "selected"; ?>>Coordinators & Leads</option>
            <option value="additional" <?php if (($member["section"] ?? "") === "additional") echo "selected"; ?>>Additional Members</option>
        </select>
    </div>
    <div class="form-group"><label class="form-label">Department</label><input class="form-control" name="department" value="<?php echo h($member["department"]); ?>" required></div>
    <div class="form-group"><label class="form-label">Favorite Game</label><input class="form-control" name="favorite_game" value="<?php echo h($member["favorite_game"]); ?>" required></div>
    <div class="form-group"><label class="form-label">Image File Name</label><input class="form-control" name="image" value="<?php echo h($member["image"]); ?>" required></div>
    <button class="btn btn-primary" type="submit">Save Member</button> <a class="btn btn-secondary" href="manage_committee.php">Cancel</a>
</form></div>
