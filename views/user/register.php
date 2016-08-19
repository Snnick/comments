<?php include ROOT.'/views/layouts/header.phtml';?>
<section>
    <div class="container">

                <div class="col-sm-4 col-sm-offset-4 padding-right">

                    <?php if ($result): ?>
                        <p>Вы зарегистрированы!</p>
                    <?php else: ?>
                        <?php if (isset($errors) && is_array($errors)): ?>
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li> - <?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <div class="signup-form"><!--sign up form-->
                            <br/><h4>Регистрация на сайте</h4><br/>
                            <form action="#" method="post">
                                <input class="form-control" type="email" type="text" name="name" id="author" placeholder="Имя" value="<?php echo $name; ?>"/>
                                <br/>
                                <input class="form-control" type="email" type="email" name="email" id="email" placeholder="E-mail" value="<?php echo $email; ?>"/>
                                <br/>
                                <input class="form-control" type="email" type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/>
                                <br/>
                                <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" class="btn btn-default" value="Регистрация" />
                            </form>
                        </div><!--/sign up form-->

                    <?php endif; ?>
                    <br/>
                    <br/>
                </div>

        </div>
    </section>
<?php include ROOT.'/views/layouts/footer.phtml';?>