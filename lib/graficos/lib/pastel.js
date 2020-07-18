/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
            

            
            function  generarGraficaPastel(chartData, ubicacion, titulo, nombre, total) {
                var chart;                
                chart = new AmCharts.AmPieChart();

                // title of the chart
                chart.addTitle(titulo, 16);

                chart.dataProvider = chartData;
                chart.titleField = nombre;
                chart.valueField = total;
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration = 2;
                chart.labelRadius = 15;
                chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // the following two lines makes the chart 3D
                chart.depth3D = 10;
                chart.angle = 15;

                // WRITE
                chart.write(ubicacion);
            }