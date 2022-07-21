am4core.useTheme(am4themes_dark);
am4core.useTheme(am4themes_animated);

// Create chart instance
let chart = am4core.create("chartdiv", am4charts.PieChart);

var option = document.getElementsByClassName('resultado-encuesta-opcion');
var votos = document.getElementsByClassName('resultado-encuesta-votos');

// Add data
chart.data = [ ];
for (let i = 0; i < option.length; i++){
    chart.data.push({
        "opcion": option[i].innerText,
        "votos" : votos[i].innerText,
    })
}

// Set inner radius
chart.innerRadius = am4core.percent(50);

// Add and configure Series
let pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "votos";
pieSeries.dataFields.category = "opcion";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;