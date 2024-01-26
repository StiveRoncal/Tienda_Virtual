
<!-- GRAFICO 1 -->
<?php
    // dep($data);exit;
    if( $grafica = "tipoPagoMes"){

        $pagosMes = $data;
?>

<script>
    Highcharts.chart('pagosMesAnio', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Ventas por Tipo Pago, <?= $pagosMes['mes'].' '. $pagosMes['anio']?>'
        },
        tooltip: {
            valuePrefix: 'S/. ',
            valueSuffix: ''
        },
        subtitle: {
            text:
            ''
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: [{
                    enabled: true,
                    distance: 20
                }, {
                    enabled: true,
                    distance: -40,
                    format: '{point.percentage:.1f}%',
                    style: {
                        fontSize: '1.2em',
                        textOutline: 'none',
                        opacity: 0.7
                    },
                    filter: {
                        operator: '>',
                        property: 'percentage',
                        value: 10
                    }
                }]
            }
        },
        series: [
            {
                name: 'Total',
                colorByPoint: true,
                data: [
                    <?php

                        foreach($pagosMes['tipospago'] as  $pagos){

                            echo "{name: '".$pagos['tipopago']."' , y:".$pagos['total'] ."}," ;

                        }
                    
                    ?>  
                ]
            }
        ]
    });

</script>

<?php

    }

?>

<!-- GRAFICO 2 -->

<?php
    // dep($data);exit;
    if($grafica = "ventasMes"){

        $VentaMes = $data;

        // dep($VentaMes);exit;
?>
<script>

    Highcharts.chart('graficaMes', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Ventas de <?=  $VentaMes['mes'].' del '.$VentaMes['anio']?>'
        },
        subtitle: {
            text: 'Total Ventas <?= SMONEY.' '.formatMoney($VentaMes['total'])?>'
        },
        xAxis: {
            categories: [

                <?php
                foreach($VentaMes['ventas'] as $dia){
                    echo $dia['dia'].",";
                }
            
                ?>
            ]
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: '',
            data: [
                <?php
                foreach($VentaMes['ventas'] as $dia){
                    echo $dia['total'].",";
                }
            
            ?>
            ]
        },]
    });

</script>

<?php
    }
?>


<!-- GRAFICO 3 -->






<?php

    if( $grafica = "ventasAnio"){

        $ventasAnio = $data;

        // dep($ventasAnio);exit;
?>

<script>
    Highcharts.chart('graficaAnio', {
      chart: {
          type: 'column'
      },
      title: {
          align: 'center',
          text: 'Ventas del Año <?=  $ventasAnio['anio']?>'
      },
      subtitle: {
          align: 'center',
          text: 'Estadística de Venta por Mes'
      },
      accessibility: {
          announceNewData: {
              enabled: true
          }
      },
      xAxis: {
          type: 'category'
      },
      yAxis: {
          title: {
              text: ''
          }

      },
      legend: {
          enabled: false
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: 'S/. {point.y:.1f}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>S/. {point.y:.2f}</b> Soles<br/>'
      },

      series: [
          {
              name: 'Ganancia Totales:',
              colorByPoint: true,
              data: [
                    <?php

                        foreach( $ventasAnio['meses'] as $venta){
                            echo "{name: '".$venta['mes']."' , y:".$venta['venta'] ."}," ;
                        }
                    
                    ?>

                  
              ]
          }
      ],
     
  });
</script>


<?php

    }

?>

