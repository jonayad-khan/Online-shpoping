eady(function() {
  nv.addGraph(function() {
    var chart = nv.models.multiBarChart();
    chart.tooltips(false)
      .showControls(false)
      .showLegend(false)
      .reduceXTicks(false)
      .staggerLabels(true)
      .yAxis.tickFormat(d3.format('d'));

    d3.select('#classCoverageDistribution svg')
      .datum(getCoverageDistributionData([0,0,0,0,0,0,0,0,0,1,0,0], "Class Coverage"))
      .transition().duration(500).call(chart);

    nv.utils.windowResize(chart.update);

    return chart;
  });

  nv.addGraph(function() {
    var chart = nv.models.multiBarChart();
    chart.tooltips(false)
      .showControls(false)
      .showLegend(false)
      .reduceXTicks(false)
      .staggerLabels(true)
      .yAxis.tickFormat(d3.format('d'));

    d3.select('#methodCoverageDistribution svg')
      .datum(getCoverageDistributionData([0,0,0,0,0,0,0,1,0,0,0,1], "Method Coverage"))
      .transition().duration(500).call(chart);

    nv.utils.wi