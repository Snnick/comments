<?php


class AdminPostController extends AdminBase
{


    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список постов
        $commList = Post::getCommentList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_post/index.php');
        return true;
    }


    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();
        $user = User::getUser();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['date'] = date("d-m-y");
            $options['user_id'] = $_POST['user_id'];
            $options['description'] = $_POST['description'];


            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый пост
                $commentId = Post::createComment($options);

                // Если запись добавлена
                if ($commentId) {
                    print_r($_FILES);
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["photo"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["photo"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/template/images/{$commentId}.jpg");
                    }
                };
                Post::updatePhotoId($commentId);

                // Перенаправляем пользователя на страницу управлениями постами
                header("Location: /admin/comment");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_post/create.php');
        return true;
    }


    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();
        $user = User::getUser();

        // Получаем данные о конкретном заказе

        $comm = Post::getCommentsId($id);
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['name'] = $_POST['name'];
            $options['user_id'] = $_POST['user_id'];
            $options['description'] = $_POST['description'];
            $options['date'] = date("d-m-y");

            // Сохраняем изменения
            if (Post::updateCommById($id, $options)) {

                if (is_uploaded_file($_FILES["photo"]["tmp_name"])) {

                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["photo"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/template/images/{$id}.jpg");
                }

            }

            // Перенаправляем пользователя на страницу управлениями постами
            header("Location: /admin/comment");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_post/update.php');
        return true;
    }


    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем пост
            Post::deleteCommById($id);

            // Перенаправляем пользователя на страницу управлениями постами
            header("Location: /admin/comment");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_post/delete.php');
        return true;
    }

}
