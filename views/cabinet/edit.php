<?php include ROOT.'/views/layouts/header.phtml';?>

    <section>
        <div class="container">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <div">

                    <?php if ($result): ?>
                        <p>Данные отредактированы!</p>
                    <?php else: ?>
                        <?php if (isset($errors) && is_array($errors)): ?>
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li> - <?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <div><!--sign up form-->
                            <br/><h4>Редактирование данных</h4><br/>
                            <form action="#" method="post" id="commentform">

                                <input class="form-control"  type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"/>
                                <br/>
                                <input class="form-control"  type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/>
                                <br/>
                                <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" class="btn btn-default" value="Сохранить" />
                            </form>
                        </div><!--/sign up form-->

                    <?php endif; ?>
                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </section>

    <?php include ROOT.'/views/layouts/footer.phtml';?>