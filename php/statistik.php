<!DOCTYPE html>
<html>
<head>
<title>URL Shortener</title>
    <link type='text/css' rel='stylesheet' href='URLShortener/css/statistik.css'/>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="URLShortener/morris/morris.min.js"></script>
    <script src="URLShortener/morris/morris.css"></script>
</head>

<body>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title">
            <i class="fa fa-long-arrow-right"></i> Zugriffe nach Browsern
          </h2>  
        </div>
        <div class="panel-body">
          <div class="col-md-2">
            <div class="legend">
              <p class="hidden-xs">Zugriffe auf Ihre URLs nach Browsern</p>
              <ul class="list-group">
                <li>
                  <span id ="Firefox" class="label label-default">Firefox</span>
                  <span id ="Firefox" class="label label-default small"><?php percentage("browser", "Mozilla Firefox") ?></span>
                  <span id ="Firefox" class="label label-default small chevron"><i class="fa fa-chevron-circle-right"></i></span>
                </li>
                <li>
                  <span id ="Chrome" class="label label-default">Chrome</span>
                  <span id ="Chrome" class="label label-default small"><?php percentage("browser", "Google Chrome") ?></span>
                  <span id ="Chrome" class="label label-default small chevron"><i class="fa fa-chevron-circle-right"></i></span>
                </li>
                <li>
                  <span id ="IE" class="label label-default">Internet Explorer</span>
                  <span id ="IE" class="label label-default small"><?php percentage("browser", "Internet Explorer") ?></span>
                  <span id ="IE" class="label label-default small chevron"><i class="fa fa-chevron-circle-right"></i></span>
                </li>
                <li>
                  <span id ="Opera" class="label label-default">Opera</span>
                  <span id ="Opera" class="label label-default small"><?php percentage("browser", "Opera") ?></span>
                  <span id ="Opera" class="label label-default small chevron"><i class="fa fa-chevron-circle-right"></i></span>
                </li>
                <li>
                  <span id ="Safari" class="label label-default">Safari</span>
                  <span id ="Safari" class="label label-default small"><?php percentage("browser", "Apple Safari") ?></span>
                  <span id ="Safari" class="label label-default small chevron"><i class="fa fa-chevron-circle-right"></i></span>
                </li>
                <li>
                  <span id ="Netscape" class="label label-default">Netscape</span>
                  <span id ="Netscape" class="label label-default small"><?php percentage("browser", "Netscape") ?></span>
                  <span id ="Netscape" class="label label-default small chevron"><i class="fa fa-chevron-circle-right"></i></span>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
            <div class="flot-chart">
              <div id="pieChart">
                  <?php if(check_for_browser_data() == false) {
                          print("<p id='noHitsError'>Keine Hits bisher</p>");
                        } else { ?>
                <script type="text/javascript">
                  Morris.Donut({
                  element: 'pieChart',
                    data: [
                      {label: "Firefox", value: <?php print(browser_hits('Mozilla Firefox')) ?>, color: "#E66000"},
                      {label: "Chrome", value: <?php print(browser_hits('Google Chrome')) ?>, color: "#53AD47"},
                      {label: "IE", value: <?php print(browser_hits('Internet Explorer')) ?>, color:"#0CF"},
                      {label: "Opera", value: <?php print(browser_hits('Opera')) ?>, color:"#CC0F16"},
                      {label: "Safari", value: <?php print(browser_hits('Apple Safari')) ?>, color: "#666666"},
                      {label: "Netscape", value: <?php print(browser_hits('Netscape')) ?>, color: "#0A7D87"},
                      {label: "Unbekannt", value: <?php print(browser_hits('Unknown')) ?>, color: "#FFE4C4"}
                    ]
                  });
                <?php } ?>
                </script>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="flot-pie-chart">
              <div id="pieChart2">
                  <?php if(check_for_browser_data() == false) {
                          print("<p id='noHitsError'>Keine Hits bisher</p>");
                        } else { ?>
                <script type="text/javascript">
                  Morris.Donut({
                  element: 'pieChart2',
                    data: [
                      {label: "Windows", value: <?php print(platform_hits('windows')) ?>, color: "#00ADEF"},
                      {label: "Mac OS", value: <?php print(platform_hits('mac')) ?>, color: "#666666"},
                      {label: "Linux", value: <?php print(platform_hits('linux')) ?>, color:"#DD4814"},
                      {label: "Unbekannt", value: <?php print(platform_hits('Unknown')) ?>, color:"#FFE4C4"}
                    ]
                  });
                <?php } ?>
                </script>   
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div id ="legend-right" class="legend">
              <p class="hidden-xs">Zugriffe auf Ihre URLs nach Betriebsystemen</p>
              <ul id="list-group-right" class="list-group">
                <li>
                  <span id ="Windows" class="label label-default small chevron"><i class="fa fa-chevron-circle-left"></i></span>                
                  <span id ="Windows" class="label label-default small"><?php percentage("platform","windows") ?></span>
                  <span id ="Windows" class="label label-default">Windows</span>               
                </li>
                <li>
                  <span id ="Linux" class="label label-default small chevron"><i class="fa fa-chevron-circle-left"></i></span>                
                  <span id ="Linux" class="label label-default small"><?php percentage("platform","linux") ?></span>
                  <span id ="Linux" class="label label-default">Linux</span>
                </li>                
                <li>
                  <span id ="Mac" class="label label-default small chevron"><i class="fa fa-chevron-circle-left"></i></span>                
                  <span id ="Mac" class="label label-default small"><?php percentage("platform","mac") ?></span>
                  <span id ="Mac" class="label label-default">Mac OS</span>                
                </li>
              </ul>
            </div>
          </div>          
        </div>
      </div>
    </div>
    <div class="container-fluid">  
        <div class="panel panel-success">
          <div class="panel-heading">
            <h2 class="panel-title">
              <i class="fa fa-long-arrow-right"></i> Top 5 URLs der letzten Woche
            </h2>
          </div>
          <div class="panel-body">
            <div class="col-md-2">
              <div class="legend">
                <p>Ihre Top 5 URLs, auf die in dieser Woche zugegriffen wurden</p>
                <ul class="list-group">
                  <?php printTop5URLs(); ?>
                </ul>
              </div>
            </div>  
            <div class="col-md-10">  
              <div class="flot-areachart">
                <div id="areaChart">
                  <script type="text/javascript">
                    Morris.Line({
                    element: 'areaChart',
                    data: [
                      <?php printTop5URLsMorris() ?>
                    ],
                    xkey: 'date',
                    ykeys: ['a', 'b', 'c', 'd', 'e'],
                    xLabelFormat: function(date) {
                    if (date.getDate() < 10) {
                      return '0' + date.getDate() + '-' + (date.getMonth() + 1);
                    } else {
                      return date.getDate() + '-' + (date.getMonth() + 1);
                      }
                    },
                    xLabels:'day',
                    behaveLikeLine: true,
                    xLabelAngle: 45,
                    labels: ['URL 1', 'URL 2', 'URL 3', 'URL 4', 'URL 5'],
                    lineColors: ["#E66000", "#53AD47", "#00CCFF", "#CC0F16", "#666666"],
                    dateFormat: function (date) {
                      var f = new Date(date);
                      return f.getDate() + '-' + (f.getMonth() + 1);
                    },  
                    hideHover: true,
                    hoverCallback: function (index, options) {
                    var row = options.data[index];  

                    return '<div class="hover-title">' + row.date + '</div><b style="color: ' + options.lineColors[0] + '">' + row.a + ' </b><span>' + options.labels[0] + '</span></br>'
                                                                  + '</div><b style="color: ' + options.lineColors[1] + '">' + row.b + ' </b><span>' + options.labels[1] + '</span></br>'
                                                                  + '</div><b style="color: ' + options.lineColors[2] + '">' + row.c + ' </b><span>' + options.labels[2] + '</span></br>'
                                                                  + '</div><b style="color: ' + options.lineColors[3] + '">' + row.d + ' </b><span>' + options.labels[3] + '</span></br>'
                                                                  + '</div><b style="color: ' + options.lineColors[4] + '">' + row.e + ' </b><span>' + options.labels[4] + '</span>'
                    }
                  });
                  </script>
                </div>
              </div>
            </div>
          </div>  
        </div>
      </div>         
    </div>
  </div>     
</div>
<script>
  $(".chevron").hover(function() {
    $(this).children().toggleClass('rotated');
      $(this).css('z-index', 3000).css('position', 'absolute').animate({
        width: "87%",
        right: "7%"
      }, 500, 'linear');
  });
</script>  
</body>

</html> 