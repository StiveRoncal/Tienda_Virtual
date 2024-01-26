<?php  headerAdmin($data); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> <?= $data['page_title'];?></h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url();?>/dashboard">Dashboard</a></li>
        </ul>
      </div>

      
      <!-- Los WIDGET -->
      <div class="row">

      <?php  if(!empty($_SESSION['permisos'][2]['r'])){ ?>

        <div class="col-md-6 col-lg-3">

          <a href="<?= base_url();?>/usuarios" class="linkw">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Usuarios</h4>
                <p><b><?= $data['usuarios'] ?></b></p>
              </div>
            </div>
          </a>

        </div>

      <?php } ?>
      <?php if(!empty($_SESSION['permisos'][3]['r'])){ ?>

        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url();?>/clientes" class="linkw">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-user fa-3x"></i>
              <div class="info">
                <h4>Clientes</h4>
                <p><b><?= $data['clientes'] ?></b></p>
              </div>
           </div>
          </a>
        </div>

      <?php } ?>
      <?php if(!empty($_SESSION['permisos'][4]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
        <a href="<?= base_url();?>/productos" class="linkw"> 
            <div class="widget-small warning coloured-icon"><i class="icon fa fa fa-archive fa-3x"></i>
              <div class="info">
                <h4>Productos</h4>
                <p><b><?= $data['productos'] ?></b></p>
              </div>
            </div>
        </a>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url();?>/pedidos" class="linkw">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
              <div class="info">
                <h4>Pedidos</h4>
                <p><b><?= $data['pedidos'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
      </div> 


      <!-- Mostar los 10 ultimos Pedidos -->
      <div class="row">
          <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
          <div class="col-md-6">
              <div class="tile">
                <h3 class="tile-title">Últimos Pedidos</h3>
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Nro.</th>
                      <th>Cliente</th>
                      <th>Estado</th>
                      <th class="text-right">Monto</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      if(count($data['lastOrders']) > 0){
                        
                        foreach($data['lastOrders'] as $pedido){

                        
                    ?>
                    <tr>
                      <td><?= $pedido['idpedido']?></td>
                      <td><?= $pedido['nombre']?></td>
                      <td><?= $pedido['status']?></td>
                      <td class="text-right"><?= SMONEY." ".formatMoney($pedido['monto'])?></td>
                      <td><a href="<?= base_url() ?>/pedidos/orden/<?= $pedido['idpedido'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php } 
                        }
                        ?>
                  </tbody>
                </table>
              </div>
          </div>
          <?php } ?>

        <div class="col-md-6">
              <div class="tile">

                <div class="container-title">

                    <h3 class="tile-title">Tipos de Pago por Mes</h3>
                    
                    <div class="dflex">
                        <input class="date-picker pagoMes" name="pagoMes" placeholder="Mes y Año">
                        <button type="button" class="btnTipoVentaMes btn btn-info btn-sm" onclick="fntSearchPagos()"><i class="fa fa-search"></i> </button>
                    </div>

                </div>

                <div id="pagosMesAnio">
                </div>

              </div>

              
        </div>

        </div>
      
      <div class="row">
          <div class="col-md-12">
                <div class="tile">
                  <div class="container-title">
                    <h3 class="tile-title">Ventas Por Mes</h3>

                    <div class="dflex">
                        <input class="date-picker ventasMes" name="ventasMes" placeholder="Mes y Año">
                        <button type="button" class="btnVentasMes btn btn-info btn-sm" onclick="fntSearchVMes()"><i class="fa fa-search"></i> </button>
                    </div>
                  </div>

                  <div id="graficaMes">
                  </div>
                </div>

                
          </div>
      </div>

      <div class="row">
          <div class="col-md-12">
                <div class="tile">
                  <div class="container-title">
                    <h3 class="tile-title">Ventas Por Año</h3>
                    <div class="dflex">
                        <input class="ventasAnio" name="ventasAnio" placeholder="Año" minlength="4" maxlength="4" onkeypress="return controlTag(event);">
                        <button type="button" class="btnVentasAnio btn btn-info btn-sm" onclick="fntSearchVAnio()"><i class="fa fa-search"></i> </button>
                    </div>
                  </div>
                  <div id="graficaAnio">
                  </div>
                </div>

                
          </div>
      </div>

      

      
      

    </main>

<?php  footerAdmin($data); ?>

<!-- JS de Libreria de Graficos -->
<script>

  // #1 Grafico Circular
 
  Highcharts.chart('pagosMesAnio', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Ventas por Tipo Pago, <?= $data['pagosMes']['mes'].' '. $data['pagosMes']['anio']?>'
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

                    foreach($data['pagosMes']['tipospago'] as  $pagos){

                        echo "{name: '".$pagos['tipopago']."' , y:".$pagos['total'] ."}," ;

                    }
                
                ?>  
            ]
        }
    ]
});


  //#2 Grafico linea
  
    Highcharts.chart('graficaMes', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Ventas de <?=  $data['ventasMDia']['mes'].' del '.$data['ventasMDia']['anio']?>'
        },
        subtitle: {
            text: 'Total Ventas <?= SMONEY.' '.formatMoney($data['ventasMDia']['total'])?>'
        },
        xAxis: {
            categories: [

                <?php
                foreach($data['ventasMDia']['ventas'] as $dia){
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
                foreach($data['ventasMDia']['ventas'] as $dia){
                    echo $dia['total'].",";
                }
            
            ?>
            ]
        },]
    });



  //#3 Grafico en Barra

  Highcharts.chart('graficaAnio', {
      chart: {
          type: 'column'
      },
      title: {
          align: 'center',
          text: 'Ventas del Año <?= $data['ventasAnio']['anio']?>'
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

                        foreach($data['ventasAnio']['meses'] as $venta){
                            echo "{name: '".$venta['mes']."' , y:".$venta['venta'] ."}," ;
                        }
                    
                    ?>

                  
              ]
          }
      ],
     
  });


  //da

  // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Browser market shares. January, 2022'
    },
    subtitle: {
        align: 'left',
        text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
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
            text: 'Total percent market share'
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
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: 'Browsers',
            colorByPoint: true,
            data: [
                {
                    name: 'Chrome',
                    y: 63.06,
                    drilldown: 'Chrome'
                },
                {
                    name: 'Safari',
                    y: 19.84,
                    drilldown: 'Safari'
                },
                {
                    name: 'Firefox',
                    y: 4.18,
                    drilldown: 'Firefox'
                },
                {
                    name: 'Edge',
                    y: 4.12,
                    drilldown: 'Edge'
                },
                {
                    name: 'Opera',
                    y: 2.33,
                    drilldown: 'Opera'
                },
                {
                    name: 'Internet Explorer',
                    y: 0.45,
                    drilldown: 'Internet Explorer'
                },
                {
                    name: 'Other',
                    y: 1.582,
                    drilldown: null
                }
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: [
            {
                name: 'Chrome',
                id: 'Chrome',
                data: [
                    [
                        'v65.0',
                        0.1
                    ],
                    [
                        'v64.0',
                        1.3
                    ],
                    [
                        'v63.0',
                        53.02
                    ],
                    [
                        'v62.0',
                        1.4
                    ],
                    [
                        'v61.0',
                        0.88
                    ],
                    [
                        'v60.0',
                        0.56
                    ],
                    [
                        'v59.0',
                        0.45
                    ],
                    [
                        'v58.0',
                        0.49
                    ],
                    [
                        'v57.0',
                        0.32
                    ],
                    [
                        'v56.0',
                        0.29
                    ],
                    [
                        'v55.0',
                        0.79
                    ],
                    [
                        'v54.0',
                        0.18
                    ],
                    [
                        'v51.0',
                        0.13
                    ],
                    [
                        'v49.0',
                        2.16
                    ],
                    [
                        'v48.0',
                        0.13
                    ],
                    [
                        'v47.0',
                        0.11
                    ],
                    [
                        'v43.0',
                        0.17
                    ],
                    [
                        'v29.0',
                        0.26
                    ]
                ]
            },
            {
                name: 'Firefox',
                id: 'Firefox',
                data: [
                    [
                        'v58.0',
                        1.02
                    ],
                    [
                        'v57.0',
                        7.36
                    ],
                    [
                        'v56.0',
                        0.35
                    ],
                    [
                        'v55.0',
                        0.11
                    ],
                    [
                        'v54.0',
                        0.1
                    ],
                    [
                        'v52.0',
                        0.95
                    ],
                    [
                        'v51.0',
                        0.15
                    ],
                    [
                        'v50.0',
                        0.1
                    ],
                    [
                        'v48.0',
                        0.31
                    ],
                    [
                        'v47.0',
                        0.12
                    ]
                ]
            },
            {
                name: 'Internet Explorer',
                id: 'Internet Explorer',
                data: [
                    [
                        'v11.0',
                        6.2
                    ],
                    [
                        'v10.0',
                        0.29
                    ],
                    [
                        'v9.0',
                        0.27
                    ],
                    [
                        'v8.0',
                        0.47
                    ]
                ]
            },
            {
                name: 'Safari',
                id: 'Safari',
                data: [
                    [
                        'v11.0',
                        3.39
                    ],
                    [
                        'v10.1',
                        0.96
                    ],
                    [
                        'v10.0',
                        0.36
                    ],
                    [
                        'v9.1',
                        0.54
                    ],
                    [
                        'v9.0',
                        0.13
                    ],
                    [
                        'v5.1',
                        0.2
                    ]
                ]
            },
            {
                name: 'Edge',
                id: 'Edge',
                data: [
                    [
                        'v16',
                        2.6
                    ],
                    [
                        'v15',
                        0.92
                    ],
                    [
                        'v14',
                        0.4
                    ],
                    [
                        'v13',
                        0.1
                    ]
                ]
            },
            {
                name: 'Opera',
                id: 'Opera',
                data: [
                    [
                        'v50.0',
                        0.96
                    ],
                    [
                        'v49.0',
                        0.82
                    ],
                    [
                        'v12.1',
                        0.14
                    ]
                ]
            }
        ]
    }
});

</script>

