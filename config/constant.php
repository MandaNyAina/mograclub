<?php
    require 'database.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'phpmailer/vendor/autoload.php';
    $config = parse_ini_file('config.ini');
    $database = new Database($config['db_host'],$config['db_name'],$config['db_user'],$config['db_password']);
    session_start(); 
    function encrypt(string $str) {
        $ini = parse_ini_file('config.ini');
        $key_encrypt = $ini['key_encrypt'];
        $encrypted_string = openssl_encrypt($str, "AES-128-CTR", $key_encrypt, 0, '8565825542115032'); 
        return $encrypted_string;
    }

    function decrypt(string $str_encrypt): string {   
        $ini = parse_ini_file('config.ini');
        $key_encrypt = $ini['key_encrypt'];
        $decrypted_string = openssl_decrypt ($str_encrypt, "AES-128-CTR", $key_encrypt, 0, '8565825542115032');
        return $decrypted_string; 
    }

    function randomValue(int $length, bool $specialChar = false) {
        $result = "";
        $char = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        if ($specialChar) {
            $charSpec = ".*',.#^$!-:;=+_%";
            $full = $char.$charSpec;
            for($i=1;$i<=$length;$i++){
                $j = 0;
                while ($j<15) {
                    $random = round((rand(0,10) / 10) * strlen($full));
                    $j++;
                }
                $result = $result.$full[(int)($random-1)];
            }
        } else {
            for($i=1;$i<=$length;$i++){
                $j = 0;
                while ($j<15) {
                    $random = round((rand(0,10) / 10) * strlen($char));
                    $j++;
                }
                $result = $result.$char[(int)($random-1)];
            }
        }
        return $result;
    }

    function password_encrypt(string $str): string {
        return password_hash($str, PASSWORD_BCRYPT);
    }

    function password_match(string $encrypt, string $value) {
        if (password_verify($value,$encrypt)) {
            return true;
        } else {
            return false;
        }
    }

    function clearString(string $str): string {
        $str = trim($str);
        $str = stripslashes($str);
        $str = strip_tags($str);
        return $str;
    }

    function is_form_valid($data) {
        if (isset($data) && !empty($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    function sendMail($object,$to,$message) {
        // Import PHPMailer classes into the global namespace
        // These must be at the top of your script, not inside a function

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings    
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                          // Send using SMTP
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';                // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'mograclub.sav@gmail.com';                     // SMTP username
            $mail->Password   = 'azerty777!';                               // SMTP password

            //Recipients
            $mail->setFrom('mograclub.sav@gmail.com', 'MograClub');   // Add a recipient
            $mail->addAddress($to);     

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $object;
            $mail->Body    = $message;

            $mail->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>