<!DOCTYPE HTML>
<html>
<head>
    <?php
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';

    if(!isset($_SESSION))
        sec_session_start();

    ?>
    
    <link rel="stylesheet" type="text/css" href="assets/css/styleTableResults.css">
</head>

    <!-- Head Bar -->
	<?php include_once 'includes/layout/HeadBar.php'; ?>
    <!-- Navigation Bar -->
    <?php include_once 'includes/layout/NavigBar.php'; ?>        
    <!-- Login Bar -->
    <?php include_once 'includes/layout/LoginDiv.php'; ?>
	
    <body>
        <!-- Results -->
            <section>
                <h1 style="text-align: center">Final Score</h1>
                <table>
                  <tr>
                    <th>Position</th>
                    <th>Player</th>
                    <th>Revenue</th>
                  </tr>
                  <tr>
                    <td>Alfreds Futterkiste</td>
                    <td>Maria Anders</td>
                    <td>Germany</td>
                  </tr>
                  <tr>
                    <td>Centro comercial Moctezuma</td>
                    <td>Francisco Chang</td>
                    <td>Mexico</td>
                  </tr>
                  <tr>
                    <td>Ernst Handel</td>
                    <td>Roland Mendel</td>
                    <td>Austria</td>
                  </tr>
                  <tr>
                    <td>Island Trading</td>
                    <td>Helen Bennett</td>
                    <td>UK</td>
                  </tr>
                  <tr>
                    <td>Laughing Bacchus Winecellars</td>
                    <td>Yoshi Tannamuri</td>
                    <td>Canada</td>
                  </tr>
                  <tr>
                    <td>Magazzini Alimentari Riuniti</td>
                    <td>Giovanni Rovelli</td>
                    <td>Italy</td>
                  </tr>
                </table>
                
                <div>
                    <a href="statistique.php">See the chart here</a>
                </div>
            </section>
        <!-- CTA -->
            <section id="cta" class="wrapper style3">
            </section>
        <!-- Copyright -->
            <?php include_once 'includes/layout/CopyrightBar.php'; ?>
	</body>
</html>