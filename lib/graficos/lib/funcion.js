/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

        function generarGraficaPastel(chartData,ubicacion, titulo, claveEtiquetas, claveValores){
        var chart;
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = claveEtiquetas;
                chart.valueField = claveValores;
                chart.gradientRatio = [0, 0, 0 ,-0.2, -0.4];
                chart.gradientType = "radial";

                // LEGEND
                legend = new AmCharts.AmLegend();
                legend.align = "center";
                legend.markerType = "circle";
                chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                chart.addLegend(legend);

                // WRITE
                chart.write("chartdiv");
            }