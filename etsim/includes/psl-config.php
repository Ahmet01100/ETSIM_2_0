<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 10-10-2015
*/
/**
 * Voici les détails de connexion à la base de données
 */
require_once 'swiftmailer/lib/swift_required.php';

define("HOST", "localhost");                                // L’hébergeur où vous voulez vous connecter.
define("USER", "root");                                     // Le nom d’utilisateur de la base de données.
define("PASSWORD", "");                                     // Le mot de passe de la base de données. 
define("DATABASE", "db596949605");                          // Le nom de la base de données.            
define("GMAIL_ADMIN", "serious.game90@gmail.com");          // Adresse gmail de l'administrateur
define("GMAIL_PWD", "AdminUTBM90");                         // Password gmail de l'administrateur  
define("GMAIL_SMTP", "smtp.gmail.com");                     // Adresse du serveur de mail sortant GMAIL
define("GMAIL_ENCRYPTION", "ssl");                          // Type de chiffrement utilisé lors de l'envoi du mail

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);                                    // SEULEMENT DANS LE CADRE DE CE GUIDE!!!!
?>