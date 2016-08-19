<?php




class CommentsController{



    public function actionIndex($page = 1){

        $name = false;
        $description = false;
        $userId = User::checkLogged();
        // Обработка формы
        if (isset($_POST['submit'])) {
            //print_r($_POST);
            // Если форма отправлена
            // Получаем данные из формы
            $name = $_POST['name'];
            $description = $_POST['description'];
            $date = date("d-m-y");


            // Флаг ошибок
            $errors = false;

            if (!isset($name) || empty($name)) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                $commentId = Post::createComments($name, $description, $date , $userId);

                if ($commentId) {
                    print_r($_FILES);
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["photo"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["photo"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/template/images/{$commentId}.jpg");
                    }
                };
                Post::updatePhotoId($commentId);


                if ($commentId == false) {
                    // Если данные неправильные - показываем ошибку
                    $errors[] = 'no';
                } else {
                    // Если данные правильные, запоминаем  (сессия)

                    Post::authPost($commentId);
                    header("Location: /");
                }
            }
        }

        //$commentId = Post::checkComments($name);

        $getCountComments = Post::getCountComments();
        $getCountCommentsPage = Post::getCommentsListPost($page);

        $pagination = new Pagination($getCountComments, $page, Post::PAGE_COMMENT, 'page-');

        require_once (ROOT.'/views/comments/index.phtml');

        return true;

    }

    public function actionDate($date){



        $commentDate = array();
        $commentDate = Post::getCommentsListDate($date);




        require_once (ROOT.'/views/comments/date.php');
        return true;
    }

    public function actionName($name){



        $сommentName = array();
        $сommentName = Post::getCommentsListName($name);




        require_once (ROOT.'/views/comments/name.php');
        return true;
    }

    public function actionEmail($email){


        $сommentEmail = array();
        $сommentEmail = Post::getCommentsListName($email);


        require_once (ROOT.'/views/comments/email.php');
        return true;
    }



}