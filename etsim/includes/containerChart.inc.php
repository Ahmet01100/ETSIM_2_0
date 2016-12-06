<style type="text/css">
        ${demo.css}
</style>

<?php

    /*$liste=listerPerformances($connexion,$_SESSION['idUtilisateur']);
    if(empty($liste)==true)
    {
        echo '<p>Il n\'y a aucune performance pour le moment</p>';
    }*/
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
                                categories: [1,2,3,";
                            /*foreach ($liste as $performance) 
                            {
                                echo "'".$performance[9]."',";
                            }*/
                        echo "
                            ]},
                            yAxis: {
                                title: {
                                    text: 'Mesures en cm'
                                },
                                plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#808080'
                                }]
                            },
                            tooltip: {
                                valueSuffix: 'cm'
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle',
                                borderWidth: 0
                            },
                            series: [{
                                name: 'Bras',
                                data: [15,20,35,";
                                /*foreach ($liste as $performance) 
                                {
                                    echo $performance[4].",";
                                }*/
                        echo "
                                ]}, {
                                name: 'Poitrine',
                                data: [35,69,87,
                                ";
                                /*foreach ($liste as $performance) 
                                {
                                    echo $performance[6].",";
                                }*/
                        echo "
                                ]}, {
                                name: 'Cuisse',
                                data: [100,68,92,
                                ";
                                /*foreach ($liste as $performance) 
                                {
                                    echo $performance[7].",";
                                }*/
                        echo "
                                ]},
                            {
                                name: 'Epaules',
                                data: [22,33,44,";
                               /* foreach ($liste as $performance) 
                                {
                                    echo $performance[5].",";
                                }*/
                        echo "
                                ]},
                            {
                                name: 'Masse graisseuse',
                                data: [68,99,54,
                                
                                ";
                               /* foreach ($liste as $performance) 
                                {
                                    echo $performance[10].",";
                                }*/

                        echo "
                                ]},
                            {
                                name: 'Tour de taille',
                                data: [45,68,65,
                                ";
                                /*foreach ($liste as $performance) 
                                {
                                    echo $performance[8].",";
                                }*/

                        echo "
                                ]
                            }]
                        });
                    });
                    


                    $(function () {
                        $('#containerColumn').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Evolution du poids'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                type: 'category',
                                labels: {
                                    rotation: -45,
                                    style: {
                                        fontSize: '13px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Population (millions)'
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            tooltip: {
                                pointFormat: 'Poids'
                            },
                            series: [{
                                name: 'Population',
                                data: [
                                
                                    ";
                           /* foreach ($liste as $performance) 
                            {
                                echo "['".$performance[9]."',".$performance[2]."],";


                            }*/

                            echo "['1',25],";
                            echo "['2',35],";
                            echo "['3',45],";
                            echo "['4',65],";
                            echo "['5',55],";


            echo "
                                  

                                ],
                                dataLabels: {
                                    enabled: true,
                                    rotation: -90,
                                    color: '#FFFFFF',
                                    align: 'right',
                                    format: '{point.y:.1f}', // one decimal
                                    y: 10, // 10 pixels down from the top
                                    style: {
                                        fontSize: '13px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            }]
                        });
                    });
                </script>
                ";


?>