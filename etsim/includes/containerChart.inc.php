<style type="text/css">
        ${demo.css}
</style>

<?php
    include_once 'includes/inGame.inc.php';
    $liste=listCurrentGameResults($mysqli, $_SESSION['id_etsim_game']);
    if(empty($liste)==true)
    {
        echo '<p>Il n\'y a aucune performance pour le moment</p>';
    }
    echo "
             <script type=\"text/javascript\">
                    $(function () {
                        $('#containerLine').highcharts({
                            title: {
                                text: 'Mesures',
                                x: -20 //center
                            },
                            subtitle: {
                                text: '',
                                x: -20
                            },
                            xAxis: {
                                categories: [";
                            foreach ($liste as $stats) 
                            {
                                echo "'".$stats[0]."',";
                            }
                        echo "
                            ]},
                            yAxis: {
                                title: {
                                    text: 'Unités'
                                },
                                plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#808080'
                                }]
                            },
                            tooltip: {
                                valueSuffix: 'unités'
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle',
                                borderWidth: 0
                            },
                            series: [{
                                name: 'Bid volume',
                                data: [";
                                foreach ($liste as $stats) 
                                {
                                    echo $stats[1].",";
                                }
                        echo "
                                ]}, {
                                name: 'Demande volume',
                                data: [
                                ";
                                foreach ($liste as $stats) 
                                {
                                    echo $stats[2].",";
                                }
                        echo "
                                ]}, {
                                name: 'Market price',
                                data: [
                                ";
                                foreach ($liste as $stats) 
                                {
                                    echo $stats[3].",";
                                }
                        echo "
                                ]},
                            {
                                name: 'Income',
                                data: [";
                                foreach ($liste as $stats) 
                                {
                                    echo $stats[4].",";
                                }
                        echo "
                                ]},
                            {
                                name: 'Costs',
                                data: [
                                
                                ";
                                foreach ($liste as $stats) 
                                {
                                    echo $stats[5].",";
                                }

                        echo "
                                ]},
                            {
                                name: 'Benefit',
                                data: [
                                ";
                                foreach ($liste as $stats) 
                                {
                                    echo $stats[6].",";
                                }

                        echo "
                                ]
                            }]
                        });
                    });

                </script>
                ";


?>