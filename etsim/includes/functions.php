<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 12-10-2015
*/
include_once 'psl-config.php';

/*
* Add by : bryan.maisano@gmail.com
* Authentification
* date * 12-10-2015
*/
function sec_session_start() {
    $session_name = 'sec_session_id';   // Attribue un nom de session
    $secure = SECURE;
    // Cette variable empêche Javascript d’accéder à l’id de session
    $httponly = true;
    // Force la session à n’utiliser que les cookies
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Récupère les paramètres actuels de cookies
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Donne à la session le nom configuré plus haut
    session_name($session_name);
    session_start();            // Démarre la session PHP 
    session_regenerate_id();    // Génère une nouvelle session et efface la précédente
}
/*
* Add by : bryan.maisano@gmail.com
* Authentification login
* date * 12-10-2015
*/
function login($login, $password, $mysqli) {
    // L’utilisation de déclarations empêche les injections SQL
    if ($stmt = $mysqli->prepare("SELECT id_etsim_members, username_etsim_members, email_etsim_members, password_etsim_members, salt_etsim_members, role_etsim_members, group_etsim_members
        FROM etsim_members
        WHERE email_etsim_members = :email
		OR username_etsim_members = :username
		AND enable_etsim_members = 1
        LIMIT 1")) {
		//echo "Echec de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
        $stmt->bindParam(':email', $login);  // Lie "$email" aux paramètres.
        $stmt->bindParam(':username', $login);  // Lie "$email" aux paramètres.
        $stmt->execute();    // Exécute la déclaration.
        //$stmt->store_result();
 
        // Récupère les variables dans le résultat
        $stmt->bindColumn('id_etsim_members',$user_id);
        $stmt->bindColumn('username_etsim_members', $username);
        $stmt->bindColumn('email_etsim_members', $email);
        $stmt->bindColumn('password_etsim_members', $db_password);
        $stmt->bindColumn('salt_etsim_members', $salt);
        $stmt->bindColumn('role_etsim_members', $role);
        $stmt->bindColumn('group_etsim_members', $group);
        
        
        $stmt->fetch();
        
		// echo "$salt <br />";
		// echo "$db_password <br />";
		$salt = trim($salt);
		# Crée un IV aléatoire à utiliser avec l'encodage CBC
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
        if ($stmt->rowCount() == 1) {
            // Si l’utilisateur existe, le script vérifie qu’il n’est pas verrouillé
            // à cause d’essais de connexion trop répétés
			// $search="SELECT id_etsim_members
					 // FROM etsim_members
					 // WHERE email_etsim_members = '$login'
					 // OR username_etsim_members = '$login';";
			// $searchstmt = $mysqli->prepare($search);
			// $searchstmt->execute();
			// $searchstmt->store_result();
			// $searchstmt->bind_result($uid);
			// echo checkbrute($user_id, $mysqli);
            if (checkbrute($user_id, $mysqli) == true) {
                // Le compte est verrouillé 
                // Envoie un email à l’utilisateur l’informant que son compte est verrouillé
				if (empty($error_msg)) {
					if ($stmtbrut = $mysqli->prepare("UPDATE etsim_members SET enable_etsim_members = '0' WHERE id_etsim_members = :id")) {
						//echo "Echec de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
						//echo 'Vérouillé';
						$stmtbrut->bindParam(':id', $user_id);  // Lie "$email" aux paramètres.
						$stmtbrut->execute();    // Exécute la déclaration.
						$error_msg .= '<p class="error">Yours has been disabled. Contact Administrator for resolve !</p>';
						$message = "	Dear Mr. ROCHE
											The account $username with mail : $email has been disabled for Brutforce.										
											Connect to website for resolve.
											
											Yours sincerely
											";
						$headers = "From: etsim.SERIOUS-GAME@utbm.fr";
						$email_to = "bryan.maisano@gmail.com";
						$subject = "Member disabled on ETSIM Serious Game";
						mail($email_to,$subject,$message,$headers);
						$stmtbrut->close();
					}
				}
                return false;
            } else {
                // Vérifie si les deux mots de passe sont les mêmes
                // Le mot de passe que l’utilisateur a donné.
                if ( trim($decryptpassword) == trim($password) ) {
					// echo $decryptpassword.'<br />';
                    // Le mot de passe est correct!
                    // Récupère la chaîne user-agent de l’utilisateur
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // Protection XSS car nous pourrions conserver cette valeur
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // Protection XSS car nous pourrions conserver cette valeur
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', $db_password . $user_browser);
					$_SESSION['role'] = $role;
					$_SESSION['institution'] = $group;
                    // Ouverture de session réussie.
                    return true;
                } else {
                    // Le mot de passe n’est pas correct
                    // Nous enregistrons cet essai dans la base de données
                    $now = time();
                    $mysqli->query("INSERT INTO etsim_login_attempt(user_id_login_attempt, time_login_attempt) VALUES ('$user_id', '$now')");
                    return false;
                }
            }
			$searchstmt->close();
        } else {
            // L’utilisateur n’existe pas.
            return false;
        }
    } else {
		header('error.php?err=User not enabled!');
		return false;
	}
}
/*
* Add by : bryan.maisano@gmail.com
* Authentification check brut force
* date * 15-10-2015
*/
function checkbrute($user_id, $mysqli) {
    // Récupère le timestamp actuel
    $now = time();
    // Tous les essais de connexion sont répertoriés pour les 2 dernières heures
    $valid_attempts = $now - (2 * 60 * 60);
	$searchdate = "SELECT * FROM etsim_login_attempt WHERE user_id_login_attempt = '$user_id' AND time_login_attempt BETWEEN '$valid_attempts' AND '$now';";
    if ($stmtsearchdate = $mysqli->query($searchdate)) {
        // S’il y a eu plus de 5 essais de connexion 
		$rowNumber = $stmtsearchdate->num_rows;
        if ($rowNumber > 5) {
            return true;
        } else {
            return false;
        }
		$stmtsearchdate->close();
    }
}
/*
* Add by : bryan.maisano@gmail.com
* Authentification check user
* date * 12-10-2015
*/
function login_check($mysqli) {
    // Vérifie que toutes les variables de session sont mises en place
    if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['role'], $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
		$role = $_SESSION['role'];
		$institution = $_SESSION['institution'];
 
        // Récupère la chaîne user-agent de l’utilisateur
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        
        
        
        if ($stmt = $mysqli->prepare("SELECT password_etsim_members FROM etsim_members WHERE id_etsim_members = :iduser LIMIT 1")) {
            // Lie "$user_id" aux paramètres. 
            $stmt->bindParam('iduser', $user_id);
            $stmt->execute();   // Exécute la déclaration.
            //$stmt->store_result();
 
            if ($stmt->rowCount() == 1) {
                // Si l’utilisateur existe, on récupère son mot de passe depuis la base
                $password = $stmt->fetchColumn();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Connecté!!!! 
					// echo 'connecté';
                    return true;
                } else {
                    // Pas connecté 
                    // echo ' 1 non';
					return false;
                }
            } else {
                // Pas connecté 
                // echo ' 2 non';
				return false;
            }
        } else {
            // Pas connecté 
            // echo ' 3 non';
			return false;
        }
    } else {
        // Pas connecté 
        // echo ' 4 non';
		return false;
    }
}
/*
* Add by : bryan.maisano@gmail.com
* Authentification escape url
* date * 12-10-2015
*/
function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // Nous ne voulons que les liens relatifs de $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}
/*
* Add by : bryan.maisano@gmail.com
* Create table user in admin_user
* date * 25-10-2015
*/
function createTable($mysqli, $sql_query) {
	
	$role = array();
	$stmt = $mysqli->prepare($sql_query);
	$stmt->execute();
	//$result = $stmt->get_result();

	while($row = $stmt->fetch()){
		echo '<tr id="'.$row['id_etsim_members'].'"><td>';
		echo '<input disabled type="text" class="id_etsim_members" value="'.$row['id_etsim_members'].'">';
		echo '</td><td>';
		echo '<input type="text" class="username_etsim_members" value="'.$row['username_etsim_members'].'">';
		echo '</td><td>';
		echo '<input id="email" type="text" class="email_etsim_members" value="'.$row['email_etsim_members'].'">';
		echo '</td><td>';
		echo '<input id="institution" type="text" class="group_etsim_members" value="'.$row['group_etsim_members'].'">';
		echo '</td><td>';
		echo '<select id="selectrole" class="role_etsim_members">';
		$tableSelect = "SELECT role_etsim_members FROM etsim_members GROUP BY role_etsim_members ORDER BY role_etsim_members ASC";
		$stmttableSelect = $mysqli->prepare($tableSelect);
		$stmttableSelect->execute();
		//$resulttableSelect = $stmttableSelect->get_result();
		while($rowresulttableSelect = $stmttableSelect->fetch()) {
			if ($row['role_etsim_members'] == $rowresulttableSelect['role_etsim_members']) {
				echo '<option value="'.$rowresulttableSelect['role_etsim_members'].'" selected>'.$rowresulttableSelect['role_etsim_members'].'</option>';
				$role[] = $rowresulttableSelect['role_etsim_members'];
			} else {
				echo '<option value="'.$rowresulttableSelect['role_etsim_members'].'">'.$rowresulttableSelect['role_etsim_members'].'</option>';
				$role[] = $rowresulttableSelect['role_etsim_members'];
			}
		}
		if (!in_array("Admin", $role)) {
			echo '<option value="Admin">Admin</option>';
		}
		if (!in_array("Manager", $role)) {
			echo '<option value="Manager">Manager</option>';
		}
		if (!in_array("Player", $role)) {
			echo '<option value="Player">Player</option>';
		}	
		echo '</select>';
		//$stmttableSelect->close();
		echo '</td><td>';
		if ($row['enable_etsim_members'] == 0) {
			echo '<input id="without" type="checkbox" class="enable_etsim_members">';
		} else {
			echo '<input id="with" type="checkbox" class="enable_etsim_members" checked="checked">';
		}
		echo '</td><td>';
		echo '<button type="button" class="delete_etsim_members">Delete</button>';
		echo '</td></tr>';
	}
}
?>