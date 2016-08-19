<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/post">Управление коментами</a></li>
                    <li class="active">Редактировать комент</li>
                </ol>
            </div>


            <h4>Редактировать комент #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название поста</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $comm['name']; ?>">




                        <br/><br/>

                        <p>Изображение поста</p>
                        <img src="<?php echo Post::getImage($comm['id']); ?>" width="200" alt="" />
                        <input type="file" name="photo" placeholder="" value="<?php echo $comm['photo']; ?>">


                        <textarea name="description"><?php echo $comm['description']; ?></textarea>
                        
                        <br/><br/>

                        <select name="user_id">

                            <?php foreach ($user  as  $u):?>
                                <option value="<?php echo $u['id']; ?>"><?php echo $u['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        
                        <br/><br/>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

