<table class="table">
    <thead>
    <tr>
        <th scope="col">Eilėje</th>
        <th scope="col">Name</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $i = 0;
    foreach ($data['waitingVisitors'] as $visitor) {
        ?>
        <tr>
            <td scope="row"><?= ++$i ?></td>
            <td><?= $visitor->name ?></td>
            <td><a href="<?= URL ?>/admin/storeNewVisitor/<?= $visitor->id ?>" class="btn btn-success">Client finished</a></td>
        </tr>
        <?
    }
    ?>
    </tbody>
</table>
</body>
</html>