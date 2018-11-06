   .reduceXTicks(false)
      .staggerLabels(true)
      .yAxis.tickFormat(d3.format('d'));

    d3.select('#classCoverageDistribution svg')
      .datum(getCoverageDistributionData({{class_coverage_distribution}}, "Class Coverage"))
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
      .datum(getCoverageDistributionData({{method_coverage_distribution}}, "Method Coverage"))
      .transition().duration(500).call(chart);

    nv.utils.windowResize(chart.update);

    return chart;
  });

  function getCoverageDistributionData(data, label) {
    var labels = [
      '0%',
      '0-10%',
      '10-20%',
      '20-30%',
      '30-40%',
      '40-50%',
      '50-60%',
      '60-70%',
      '70-80%',
      '80-90%',
      '90-100%',
      '100%'
    ];
    var values = [];
    $.each(labels, function(key) {
