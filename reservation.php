<?php
function wp_path()
    {
    if (strstr($_SERVER["SCRIPT_FILENAME"], "/wp-content/"))
        {
        return preg_replace("/\/wp-content\/.*/", "", $_SERVER["SCRIPT_FILENAME"]);
        }
    return preg_replace("/\/[^\/]+?\/themes\/.*/", "", $_SERVER["SCRIPT_FILENAME"]);
    }
require wp_path() . "/wp-load.php"; if (true == $sh_redux['switch-top-header-wpml']) { $sitepress->switch_lang($_SESSION["new_current_lang"]); }
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Error messages
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    if(isset($_POST['room'])){ $room = $_POST['room']; }
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo 'Inserire un indirizzo valio per l\'email';
        exit();
    }
    else
        if (isset($room) == '')
        {
            echo 'Inserire un numero di stanze valido';
            exit();
        }
        else
            if (trim($checkin) == '')
            {
                echo 'Inserire una data di checkin valida';
                exit();
            }
            else
                if (trim($checkout) == '')
                {
                    echo 'Inserire una data di checkout valida';
                    exit();
                }

    // Your e-mailadress.
    $recipient = "";
    // Mail subject
    $subject = '=?UTF-8?B?' . $subject . '?=';
    $subject = 'Ottima notizia! Hai ricevuto una richiesta di prenotazione da ' . "$email";
    // Mail content
    $email_content = 'Ottima notizia! Hai ricevuto una richiesta di prenotazione da ' . "$email".

    "\r\n". 'Il visitatore vuole fare il checkin il ' . "$checkin" . ' ed il checkout il ' . "$checkout" .
"\r\n".' Il tipo di camera richiesta è un ' . "$room" . ' per ' . "$adults" . ' adulti e ' . "$children" . ' bambini ' .

"\r\n".'Il visitatore può essere contattato via email all\'indirizzo ' . "$email" ;


    // Mail headers
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email_headers= "From: $name <$email> \r\nMIME-Version: 1.0\r\nContent-Type: text/plain;charset=utf-8";
    // Main messages
    if (mail($recipient, $subject, $email_content, $email_headers))
    {
        echo "Reservation sent successfully!";
    }
    else
    {
        echo "Oops! Something went wrong and we couldn't send your reservation.";
    }
}
else
{
    echo "There was a problem with your submission, please try again.";
}
?>
