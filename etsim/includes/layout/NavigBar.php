<?php
 /*
* Created by : bryan.maisano@gmail.com
* date * 02-01-2016
*/ ?>
<!-- Header -->
<div id="header">
	<!-- Logo -->
	<h1><a href="index.php" id="logo">Serious Game <em>by UTBM</em></a></h1>
	<!-- Nav -->
	<nav id="nav">
		<ul>
			<li <?php if ($_SERVER["PHP_SELF"] == '/index.php') { echo "class=\"current\""; } ?> ><a href="index.php">HOME</a></li>
			<?php if(isset($_SESSION['user_id']) && isset($_SESSION['role'])) :?>
                <?php if ($_SESSION['role'] == 'Player' || $_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager') : ?>
                    <li <?php if (($_SERVER["PHP_SELF"] == '/play_game.php') || ($_SERVER["PHP_SELF"] == '/play_rules.php') || ($_SERVER["PHP_SELF"] == '/play_manage.php')) { echo " class=\"current\"";} ?> >
                        <a href="play_game.php">PLAY</a>
                        <ul>
                            <li><a href="play_game.php">MAIN PAGE</a></li>
                            <li><a href="play_rules.php">RULES</a></li>
                        <?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager') : ?>
                            <li><a href="play_manage.php">MANAGER PANEL</a></li>
                        <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                    <li <?php if ($_SERVER["PHP_SELF"] == '/creators.php') { echo " class=\"current\""; } ?> ><a href="creators.php">CREATORS</a></li>
                <?php if ($_SESSION['role'] == 'Admin') : ?>
                    <li <?php if (($_SERVER["PHP_SELF"] == '/admin_users.php') || ($_SERVER["PHP_SELF"] == '/admin_download.php')) { echo " class=\"current\""; } ?>>
                        <a href="admin_users.php">ADMINISTRATION</a>
                        <ul>
                            <li><a href="admin_users.php">USER</a></li>
                            <li><a href="admin_download.php">DOWNLOAD</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
				<li <?php if ($_SERVER["PHP_SELF"] == '/contact.php') { echo " class=\"current\""; } ?> ><a href="contact.php">CONTACT</a></li>
		</ul>
	</nav>
</div>