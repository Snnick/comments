<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/comment">Управление коментами</a></li>
                    <li class="active">Редактировать комент</li>
                </ol>
            </div>


            <h4>Добавить новый комент</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="" method="post" enctype="multipart/form-data">

                        <p>Название комента</p>
                        <input type="text" name="name" placeholder="" value="">

                        <p>Изображение комента</p>
                        <input type="file" name="photo" placeholder="" value="">


                        <p>Детальное описание</p>
                        <textarea name="description"></textarea>

                        <br/><br/>

                        <select name="user_id">
                            <option value="0" selected="selected">Пользователь</option>
                            <?php foreach ($user  as  $u):?>
                            <option value="<?php echo $u['id']; ?>"><?php echo $u['name']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>

                        <br/><br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

