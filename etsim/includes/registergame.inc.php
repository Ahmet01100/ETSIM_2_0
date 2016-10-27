<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 7-11-2015
*/
include_once 'db_connect.php';
include_once 'functions.php';
if(!isset($_SESSION))
    sec_session_start();
 
$error_msg = "";
if ($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Manager" ) {
	if (isset($_POST['registergame']) && $_POST['registergame'] == 'registergame') {
		if ( (isset($_POST['name_etsim_game']) && !empty($_POST['name_etsim_game'])) && (isset($_POST['password_etsim_game']) && !empty($_POST['password_etsim_game']))	) {
			// Nettoyez et validez les données transmises au script
			$namegame = $_POST['name_etsim_game'];
			$password = $_POST['password_etsim_game'];
			$maxplayer = $_POST['maxplayer_etsim_game'];
			$today = date("Y-m-d H:i:s");
			
			if (strlen($password) > 128) {
				// Le mot de passe hashé ne doit pas dépasser les 128 caractères
				// Si ce n’est aps le cas, quelque chose de vraiment bizarre s’est produit
				$error_msg .= '<p class="error">Invalid password.</p>';
			}
			
			if (!isset($namegame)) {
				$error_msg .= '<p class="error">Description game must be used.</p>';
			}
			
			if (!isset($password)) {
				$error_msg .= '<p class="error">Password game must be used.</p>';
			}
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
				$ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $random_salt, $password, MCRYPT_MODE_CBC, $iv);

				# On ajoute le IV au début du texte chiffré pour le rendre disponible pour le déchiffrement
				$ciphertext = $iv . $ciphertext;
							
				# Encode le texte chiffré résultant pour qu'il puisse être représenté par une chaîne de caractères
				$cryptpassword = base64_encode($ciphertext);

				
				// Enregistre le nouvel utilisateur dans la base de données
				$status = "Open";
				if ($insertGame_stmt = $mysqli->prepare("INSERT INTO etsim_game (date_etsim_game, description_etsim_game, password_etsim_game, salt_etsim_game, status_etsim_game, maxplayer_etsim_game) VALUES (:date, :desc, :pwd, :salt, :status, :maxPlayer)")) {
					$insertGame_stmt->bindParam(':date',$today);
                    $insertGame_stmt->bindParam(':desc', $namegame);
                    $insertGame_stmt->bindParam(':pwd', $cryptpassword);
                    $insertGame_stmt->bindParam(':salt', $random_salt);
                    $insertGame_stmt->bindParam(':status', $status);
                    $insertGame_stmt->bindParam(':maxPlayer', $maxplayer);
					$insertGame_stmt->execute();
					//$insertGame_stmt->close();
					$success_msg = '<p class="error">Your game has been created !</p>';
				} else {
					$error_msg .= '<p class="error">Your game hasn t been created !</p>';
				}
			}
			if (empty($error_msg)) {
				echo '<SCRIPT>javascript:window.close()</SCRIPT>';
			}
		}
	}
}

?>