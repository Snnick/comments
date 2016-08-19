<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление коментами</li>
                </ol>
            </div>

            <a href="/admin/comment/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить комент</a>

            <h4>Список коментoв</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID комента</th>
                    <th>Название комента</th>

                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($commList as $c): ?>
                    <tr>
                        <td><?php echo $c['id']; ?></td>
                        <td><?php echo $c['name']; ?></td>
                        <td> <img style="height: 80px; width: 80px" src="/template/images/<?php echo $c['photo']; ?>"></td>

                        <td><a href="/admin/comment/update/<?php echo $c['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/comment/delete/<?php echo $c['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

