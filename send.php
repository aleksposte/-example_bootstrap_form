<?php
if($_POST){
    $to_Email = "aleks.poste@gmail.com";
    $subject = 'Заявка на модули '.$_POST["name"];

    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

        $answer_serv = json_encode(
        array(
        'text' => 'Возникла ошибка при отправке данных'
        ));

        die($answer_serv);
    }

    if(!isset($_POST["name"]) || !isset($_POST["number"]) || !isset($_POST["code"]) || !isset($_POST["email"]) || !isset($_POST["phone"]) || !isset($_POST["comments"])) {
        $answer_serv = json_encode(array('type'=>'error', 'text' => 'Заполните форму'));
        die($answer_serv);
    }

    $user_Name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST["number"], FILTER_SANITIZE_STRING);
    $code = filter_var($_POST["code"], FILTER_SANITIZE_STRING);
    $modules = filter_var($_POST["modules"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $user_Phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
    $comments = filter_var($_POST["comments"], FILTER_SANITIZE_STRING);


    if(strlen($user_Name)<3) {
        $answer_serv = json_encode(array('text' => 'Поле Имя слишком короткое или пустое'));
        die($answer_serv);
    }
    if(!is_numeric($user_Phone)) {
        $answer_serv = json_encode(array('text' => 'Номер телефона может состоять только из цифр'));
        die($answer_serv);
    }

    $message =
        "Имя: ".$user_Name."\n".
        "Серийный номер прибора: ".$number."\n".
        "Код ключа: ".$code."\n".
        "Модуль: ".$modules."\n".
        "E-mail: ".$email."\n".
        "Телефон: ".$user_Phone."\n".
        "Сообщение: ".$comments;

}
?>
