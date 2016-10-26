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
		if(!isset($_POST['pwd']) || !isset($_POST['cpwd']) ) {
			echo 'We are sorry, but there appears to be a problem with the form you submitted.';       
		} else {
			$pwd = $_POST['pwd'];
			$cpwd = $_POST['cpwd'];
			if ((strlen($pwd) > 128) && (strlen($cpwd) > 128)) {
				// Le mot de passe hashé ne doit pas dépasser les 128 caractères
				// Si ce n’est aps le cas, quelque chose de vraiment bizarre s’est produit
				$error_msg .= '<p class="error">Password are invalid.</p>';
			}
			if ( $pwd != $cpwd ) {
					$error_msg .= '<p class="error">Your password and confirmation must match exactly</p>';
			} else {
				$select="SELECT username_etsim_members
							   ,email_etsim_members
						FROM etsim_members
						WHERE id_etsim_members = ".$_SESSION['user_id'].";";
				if ($stmt = $mysqli->prepare($select)) {
					$stmt->execute();
					//$stmt->store_result();
					$stmt->bindColumn('username_etsim_members',$username);
                    $stmt->bindColumn('email_etsim_members', $email);
					if ($stmt->fetch() == 1) {
						if (empty($error_msg)) {
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

							// echo  $cryptpassword . "\n";
							// echo "password arrivée ".$cryptpassword . "\n";
					 
							// Enregistre le nouvel utilisateur dans la base de données
							$query= "UPDATE etsim_members SET password_etsim_members = '$cryptpassword', salt_etsim_members = '$random_salt' WHERE id_etsim_members = ".$_SESSION['user_id'].";";

							if ($update_stmt = $mysqli->prepare($query)) {
								// echo "password_départ : ".$password."<br>";
								$update_stmt->execute();
								$message = "	Dear Mr. $username
											The password of your account has been correctly modified on http://etsim.pro-project.fr/. 
											You can try to connect on website with your new password.
											
											Yours sincerely
											";
								$header = "From: etsim.SERIOUS-GAME@utbm.fr";
								$subject = "Password mofication on ETSIM Serious Game";
								mail($email,$subject,$message,$header);
								$success .= '<p class="error">Send password : SUCCESS! </p>';
								unset($_SESSION);
								//$update_stmt->close();
								//$mysqli->close();
							}
						}
					}
				} else {
					$error_msg .= '<p class="error">Error access modification</p>';
				}
			}
		}
	}
}
?>