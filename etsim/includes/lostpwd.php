<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 15-10-2015
*/
include_once 'db_connect.php';
include_once 'functions.php';

if(!isset($_SESSION))
    sec_session_start();

if(isset($_SESSION["user_id"]))
{
    if (!empty($_SESSION['user_id'])) {
        $session = 1;
    } else {
        $session = 0;
    }
}
else
{
    $session = 0;
}
    

if ($session == 0) {
	if (isset($_POST['lostpwdform']) && $_POST['lostpwdform'] == 'lostpwdform') {
		if(!isset($_POST['email'])) {
			echo 'We are sorry, but there appears to be a problem with the form you submitted.';       
		} else {
			$email = $_POST['email'];
			$select="SELECT username_etsim_members
							,password_etsim_members
							 ,salt_etsim_members
					 FROM etsim_members
					 WHERE email_etsim_members = '$email';";
			if ($stmt = $mysqli->prepare($select)) {
				$stmt->execute();
				//$stmt->store_result();
				$stmt->bindColumn('username_etsim_members',$username);
                $stmt->bindColumn('password_etsim_members',$db_password);
                $stmt->bindColumn('salt_etsim_members',$salt);
				if ($stmt->fetch() == 1) {
					if (empty($error_msg)) {
						$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
						$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
						$ciphertext_dec = base64_decode($db_password);
						# Récupère le IV, iv_size doit avoir été créé en utilisant la fonction
						# mcrypt_get_iv_size()
						$iv_dec = substr($ciphertext_dec, 0, $iv_size);
						
						# Récupère le texte du cipher (tout, sauf $iv_size du début)
						$ciphertext_dec = substr($ciphertext_dec, $iv_size);

						# On doit supprimer les caractères de valeur 00h de la fin du texte plein
						$decryptpassword = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
							
						$message = "	Dear Mr. $username
											The password of your account is : $decryptpassword.										
											You can try to connect on website with your password.
											
											Yours sincerely
											";
						$headers = "From: etsim.SERIOUS-GAME@utbm.fr";
						$subject = "Password mofication on ETSIM Serious Game";
						mail($email,$subject,$message,$headers);

						// Exécute la déclaration.
						$success .= '<p class="error">Send password : SUCCESS! </p>';
						//$mysqli->close();
						//$stmt->close();
					}
				} else {
					$error_msg .= '<p class="error">Users not found !</p>';
				}
			} else {
				$error_msg .= '<p class="error">Users not found !</p>';
			}
		}
	}
}
?>