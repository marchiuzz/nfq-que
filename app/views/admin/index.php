<table class="table">
    <thead>
    <tr>
        <th scope="col">Eilėje</th>
        <th scope="col">Name</th>
        <th scope="col">Waiting From</th>
        <th scope="col">Action</th>
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
            <td><a href="<?= URL ?>/admin/storeVisitorToArchive/<?= $visitor->id ?>" class="btn btn-success">Client finished</a></td>
        </tr>
        <?
    }
    ?>
    </tbody>
</table>
</body>
</html>