<?php
if(isset($data['finishedInSeconds']) && $data['finishedInSeconds'] > 0) {
    ?>
    <div class="alert alert-warning" role="alert">
        Šį klientą aptarnauti tau prireikė <?= $data['finishedInSeconds'] ?>
    </div>
    <?php
}
?>

<?php
if($data['formattedAverageWaitingTime'] > 0) {
    ?>
    <div class="alert alert-primary" role="alert">
        Vidutiniškai reikės laukti <?= $data['formattedAverageWaitingTime'] ?>
    </div>
    <?php
}
?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Que Nr</th>
        <th scope="col">Name</th>

        <th scope="col">Waiting From</th>
    </tr>
    </thead>
    <tbody>


    <?php

    $i = 0;
    foreach ($data['visitors'] as $visitor) {
        ?>
        <tr>
            <td scope="row"><?= ++$i ?></td>
            <td><?= $visitor->name ?></td>

            <td><?= $visitor->created_at ?></td>
        </tr>
        <?
    }

    ?>
    </tbody>
</table>
