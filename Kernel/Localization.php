<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 09.07.2018
 * Time: 19:06
 */

namespace Kernel;


class Localization
{
    /** @var  array */
    public $List;


    function __construct($lang)
    {
        $local = new localLists($lang);
        $this->List = $local->getList();
    }

}



class LocalLists {

    private $lang;


    function __construct($lang)
    {
        $this->lang = $lang;
    }

    public function getList() {
        return $this->list[$this->lang];
    }

    protected $list = [
        "ru" => [
            "name" => "Testblog",
            "about" => "Для читателей",
            "aboutText" => "Этот блог был создан для публикации различных информативных постов. Для создания публикаций необходимо зарегистрироваться либо войти, если уже имеется учётная запись. Однако комментировать посты возможно и без входа в аккаунт.",
            "forUsers" => "Пользовательское",
            "addPost" => "Добавить пост",
            "readMore" => "Продолжение",
            "logOut" => "Выход",
            "logIn" => "Войти",
            "en" => "English",
            "title" => "Заглавие",
            "publish" => "Опубликовать",
            "showComments" => "Комментарии",
            "postBy" => "Опубликовал",
            "addComment" => "Добавить комментарий",
            "send" => "Отправить",
            "typeCommentHere" => "Печатайте тут",
            "typeName" => "Введите имя",
            "Please sign in" => "Войдите",
            "Please sign up" => "Зарегистрируйтесь",
            "Login" => "Логин",
            "Password" => "Пароль",
            "Remember me" => "Запомнить меня",
            "Sign in" => "Войти",
            "Sign Up" => "Регистрация",
            "failed to log in" => "Логин или пароль некорректны",
            "sign up success" => "Регистрация прошла успешно. <a href = '/'>Нажми сюда</a> чтобы продолжить",
            "sign up failed" => "Выберите другое имя пользователя",
            "login and pass length" => "Логин и пароль должны состоять как минимум из 5 символов",
            "edit" => "Редактировать",
            "delete" => "Удалить",
            "save" => "Сохранить",
            "top" => "Наверх",
            "footer-text-1" => "Авторство  © Nick Syromyatnikov, все права сохранены",
            "footer-text-2" => "По всем вопросам обращаться на почту nik.syromyatnikov@gmail.com или в <a href='https://web.telegram.org/#/im?p=@FoundedFuture'>Telegram</a>",


        ],

        "en" => [
            "name" => "Testblog",
            "about" => "For readers",
            "aboutText" => "Этот блог был создан для публикации различных информативных постов. Для создания публикаций необходимо зарегистрироваться либо войти, если уже имеется учётная запись. Однако комментировать посты возможно и без входа в аккаунт.",
            "forUsers" => "For Users",
            "addPost" => "Add Post",
            "readMore" => "Read more",
            "logOut" => "Log Out",
            "logIn" => "Log In",
            "ru" => "Русский",
            "title" => "Title",
            "publish" => "Publish",
            "showComments" => "Comments",
            "postBy" => "Post by",
            "addComment" => "Add comment",
            "send" => "Send",
            "typeCommentHere" => "Type comment here",
            "typeName" => "Type name",
            "Please sign in" => "Please sign in",
            "Please sign up" => "Please sign up",
            "Login" => "Login",
            "Password" => "Password",
            "Remember me" => "Remember me",
            "Sign in" => "Sign in",
            "Sign Up" => "Sign Up",
            "failed to log in" => "Login or password are not correct",
            "sign up failed" => "This username is not available",
            "sign up success" => "Your account was successfully created. <a href ='/'>Click here</a> to continue",
            "login and pass length" => "Login and password must contain 5 symbols at least",
            "edit" => "Edit",
            "delete" => "Delete",
            "save" => "Save",
            "top" => "Back to top",
            "footer-text-1" => "Powered by © Nick Syromyatnikov, all rights reserved",
            "footer-text-2" => "Feel free to ask your questions on gmail nik.syromyatnikov@gmail.com or in <a href='https://web.telegram.org/#/im?p=@FoundedFuture'>Telegram</a>",





        ]
    ];


}