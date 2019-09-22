<?php
if(isset($data['errors'])) {
    foreach ($data['errors'] as $error) {
    ?>

    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
    <?php
    }
}
?>

<form method="post" action="<?= URL ?>/visitor/store" role="form">
    <div class="form-group">
        <label for="visitor_name">Your name (Vardas turi buti Vardenis)</label>
        <input type="text" class="form-control" id="visitor_name" name="visitor_name" value="<?= isset($data['visitorName']) ? $data['visitorName'] : "" ?>" placeholder="Your name?" required>
    </div>
    <input type="submit" class="btn btn-primary" id="submit_button" name="submit_button" value="Submit">
</form>