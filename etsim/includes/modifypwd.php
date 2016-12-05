<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 15-10-2015
*/
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

if(!isset($_SESSION))
    sec_session_start();

if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" || $_SESSION['role'] == "Player") {
	if (isset($_POST['changepwdform']) && $_POST['changepwdform'] == 'changepwdform') {
		if(/*!isset($_POST['lpwd']) || */!isset($_POST['pwd']) || !isset($_POST['cpwd']) ) {
			echo 'We are sorry, but there appears to be a problem with the form you submitted.';       
		}
        else if($_POST['pwd']=='' || $_POST['cpwd']=='')
        {
            echo 'Please enter a password.';
        }
        else {
            $lpwd = $_POST['lpwd'];
			$pwd = $_POST['pwd'];
			$cpwd = $_POST['cpwd'];
            /*echo 'Last : '.$lpwd;
            echo 'Password : '.$pwd;
            echo 'Confirm : '.$cpwd;*/
            $selectLastPwd = "SELECT password_etsim_members FROM etsim_members WHERE id_etsim_members = ".$_SESSION['user_id'].";";
            
			if ((strlen($pwd) > 128) && (strlen($cpwd) > 128)) {
				// Le mot de passe hashé ne doit pas dépasser les 128 caractères
				// Si ce n’est aps le cas, quelque chose de vraiment bizarre s’est produit
				$error_msg .= '<p class="error">Password are invalid.</p>';
			}
			if ( $pwd != $cpwd ) {
					$error_msg .= '<p class="error">Your password and confirmation must match exactly</p>';
			//}   elseif ( $lwpd != $selectLastPwd ){ 
            //        $error_msg .= '<p class="error">Your last password must match exactly</p>';
            } else {
				$select="SELECT username_etsim_members
							   ,email_etsim_members
                               ,password_etsim_members
                               ,salt_etsim_members
						FROM etsim_members
						WHERE id_etsim_members = ".$_SESSION['user_id'].";";
				
                if ($stmt = $mysqli->prepare($select)) {
					$stmt->execute();
					//$stmt->store_result();
					$stmt->bindColumn('username_etsim_members',$username);
                    $stmt->bindColumn('email_etsim_members', $email);
                    $stmt->bindColumn('password_etsim_members', $current_pwd);
                    $stmt->bindColumn('salt_etsim_members', $current_salt);
                                    
                    
                    $stmt->fetch();
					//if ($stmt->fetch() == 1) {
						if (empty($error_msg)) {
                            // Vérif last pwd
				
                            $current_salt = trim($current_salt);
                            # Crée un IV aléatoire à utiliser avec l'encodage CBC
                            $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
                            $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);	
                            $ciphertext_dec = base64_decode($current_pwd);
                            # Récupère le IV, iv_size doit avoir été créé en utilisant la fonction
                            # mcrypt_get_iv_size()
                            $iv_dec = substr($ciphertext_dec, 0, $iv_size);

                            # Récupère le texte du cipher (tout, sauf $iv_size du début)
                            $ciphertext_dec = substr($ciphertext_dec, $iv_size);

                            # On doit supprimer les caractères de valeur 00h de la fin du texte plein
                            $decryptgamepassword = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $current_salt, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
                            
                            
                            /*echo 'crypt:'.$lpwd."\n";
                            echo 'current:'.$decryptgamepassword;*/
                            
                            
                            if(trim($lpwd) == trim($decryptgamepassword))
                            {
                                // Crée un salt au hasard
                                $random_salt = base64_encode(openssl_random_pseudo_bytes(16, $secure));

                                // echo "hash : ".$random_salt."<br>";
                                // Crée le mot de passe en se servant du salt généré ci-dessus 
                                # Crée un IV aléatoire à utiliser avec l'encodage CBC
                                $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
                                $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

                                # Crée un texte cipher compatible avec AES (Rijndael block size = 128)
                                # pour conserver le texte confidentiel.
                                # Uniquement applicable pour les entrées encodées qui ne se terminent jamais
                                # pas la valeur 00h (en raison de la suppression par défaut des zéros finaux)
                                $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $random_salt, $pwd, MCRYPT_MODE_CBC, $iv);
                                # On ajoute le IV au début du texte chiffré pour le rendre disponible pour le déchiffrement
                                $ciphertext = $iv . $ciphertext;
                                # Encode le texte chiffré résultant pour qu'il puisse être représenté par une chaîne de caractères
                                $cryptpassword = base64_encode($ciphertext);

							
                                // Enregistre le nouveau mot de passe dans la base de données
                                $query= "UPDATE etsim_members SET password_etsim_members = '$cryptpassword', salt_etsim_members = '$random_salt' WHERE id_etsim_members = ".$_SESSION['user_id'].";";

                                if ($update_stmt = $mysqli->prepare($query)) {
                                    // echo "password_départ : ".$password."<br>";
                                    $update_stmt->execute();
                                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                                    $_SESSION['login_string'] = hash('sha512', $cryptpassword . $user_browser);
                                    $message = "	Dear Mr. $username
                                                The password of your account has been correctly modified on http://etsim.pro-project.fr/. 
                                                You can try to connect on website with your new password.

                                                Yours sincerely
                                                ";
                                    $header = "From: etsim.SERIOUS-GAME@utbm.fr";
                                    $subject = "Password modification on ETSIM Serious Game";

                                    // Envoi du mail de changement de mot de passe

                                    $transport = Swift_SmtpTransport::newInstance(GMAIL_SMTP, 465, GMAIL_ENCRYPTION)
                                        ->setUsername(GMAIL_ADMIN)
                                        ->setPassword(GMAIL_PWD);

                                    $mailer = Swift_Mailer::newInstance($transport);

                                    $messageSwift = Swift_Message::newInstance($subject)
                                      ->setFrom(array($email => $header))
                                      ->setTo(array($_SESSION['email']))
                                      ->setBody($message);

                                    $result = $mailer->send($messageSwift);

                                    $success = '<p class="error" style="color:green; font-weight:bold">Send password : SUCCESS! </p>';
                                    if (!isset($_SESSION['user_id'])){
                                        header('Location: ../index.php');
                                        exit;
                                    }
                                    //$update_stmt->close();
                                    //$mysqli->close();
                                }
                            }

                            else
                            {
                                echo 'The last password is not correct.';
                            }
							
						
				} else {
					$error_msg .= '<p class="error">Error access modification</p>';
				    }
                }
			}
		}
	}
}
?>