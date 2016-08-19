<?php include ROOT.'/views/layouts/header.phtml';?>

    <section>
        <div class="container">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <h3>Кабинет пользователя</h3>

                <h4>Привет, <?php echo $user['name'];?>!</h4>
                <ul>
                    <li><a href="/cabinet/edit">Редактировать данные</a></li>

                </ul>

            </div>
        </div>
    </section>

<?php include ROOT.'/views/layouts/footer.phtml';?>