<?php
$lang['email_must_be_array'] = "<p style='color:red'>Метод проверки e-mail должен быть передан через массив.</p>";
$lang['email_invalid_address'] = "<p style='color:red'>Неверный e-mail: %s.</p>";
$lang['email_attachment_missing'] = "<p style='color:red'>Невозможно найти вложения для письма: %s.</p>";
$lang['email_attachment_unreadable'] = "<p style='color:red'>Невозможно открыть вложение %s.</p>";
$lang['email_no_recipients'] = "<p style='color:red'>Необходимо указать получателей в полях: To, Cc, или Bcc.</p>";
$lang['email_send_failure_phpmail'] = "<p style='color:red'>Невозможно отправить почту с помощью PHP-функции mail().  Необходимо должным образом настроить сервер.</p>";
$lang['email_send_failure_sendmail'] = "<p style='color:red'>Невозможно отправить почту, используя sendmail. Необходимо настроить сервер.</p>";
$lang['email_send_failure_smtp'] = "<p style='color:red'>Невозможно отправить почту, используя SMTP. Необходимо настроить сервер.</p>";
$lang['email_sent'] = "<p style='color:red'>Ваше сообщение успешно отправлено. Использован протокол: %s.</p>";
$lang['email_no_socket'] = "<p style='color:red'>Невозможно установить сокет-подключение к Sendmail. Пожалуйста, проверьте настройки.</p>";
$lang['email_no_hostname'] = "<p style='color:red'>Вы не указали сервер SMTP.</p>";
$lang['email_smtp_error'] = "<p style='color:red'>Ошибки при передаче данных через SMTP: %s.</p>";
$lang['email_no_smtp_unpw'] = "<p style='color:red'>Ошибка: Укажите имя пользователя и пароль для SMTP.</p>";
$lang['email_failed_smtp_login'] = "<p style='color:red'>Невозможно выполнить команду AUTH LOGIN. Ошибка: %s.</p>";
$lang['email_smtp_auth_un'] = "<p style='color:red'>Невозможно провести аутентификацию имени пользователя. Ошибка: %s.</p>";
$lang['email_smtp_auth_pw'] = "<p style='color:red'>Невозможно провести аутентификацию пароля. Ошибка: %s.</p>";
$lang['email_smtp_data_failure'] = "<p style='color:red'>Невозможна отправка данных: %s.</p>";