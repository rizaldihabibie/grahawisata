
<script>

var raw_data_pemasukan= <?php echo json_encode($data_chart_pemasukan ); ?>;
if(raw_data_pemasukan != null){
      var keterangan = [];
      var nilai_pemasukan = [];
      var total_pengunjung = [];
      var all_pemasukan = [];
      for(var i=0;i<raw_data_pemasukan.length;i++){
          // alert(raw_data_pemasukan[i]['day']);
          keterangan[i]=raw_data_pemasukan[i]['day'];
          nilai_pemasukan[i]=parseInt(raw_data_pemasukan[i]['pemasukan']);
          total_pengunjung[i]=parseInt(raw_data_pemasukan[i]['total']);
          all_pemasukan[i]= {meta:('Total Pemesanan = '+raw_data_pemasukan[i]['total']),
                             value:raw_data_pemasukan[i]['pemasukan']};
      }
      var test = [{meta: 'description A', value: 1 },{meta: 'description B', value: 5},{meta: 'description C', value: 3}];
      // alert(test);
      var chart =  new Chartist.Line('#chart-pemasukan', 
          {
              labels: keterangan,
              series: [all_pemasukan]  
              // series: [test]  
          },
          {
                fullWidth: false,
                low: 0,
                // axisX: { showGrid: false,position: 'start' },
                // axisY: { showGrid: false },
                showArea: true,
                plugins: [
                  Chartist.plugins.tooltip()
                ]
          }

        );
      // ini part of effect 

      // Let's put a sequence number aside so we can use it in the event callbacks
      var seq = 0,
        delays = 80,
        durations = 500;

      // Once the chart is fully created we reset the sequence
      chart.on('created', function() {
        seq = 0;
      });

      // On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
      chart.on('draw', function(data) {
        seq++;

        if(data.type === 'line') {
          // If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
          data.element.animate({
            opacity: {
              // The delay when we like to start the animation
              begin: seq * delays + 1000,
              // Duration of the animation
              dur: durations,
              // The value where the animation should start
              from: 0,
              // The value where it should end
              to: 1
            }
          });
        
        // }else if(data.type === 'label'){
        // data.element.remove();
        
        }else if(data.type === 'label' && data.axis === 'x') {
          data.element.animate({
            y: {
              begin: seq * delays,
              dur: durations,
              from: data.y + 100,
              to: data.y,
              // We can specify an easing function from Chartist.Svg.Easing
              easing: 'easeOutQuart'
            }
          });
        } else if(data.type === 'label' && data.axis === 'y') {
          data.element.animate({
            x: {
              begin: seq * delays,
              dur: durations,
              from: data.x - 100,
              to: data.x,
              easing: 'easeOutQuart'
            }
          });
        } else if(data.type === 'point') {
          data.element.animate({
            x1: {
              begin: seq * delays,
              dur: durations,
              from: data.x - 10,
              to: data.x,
              easing: 'easeOutQuart'
            },
            x2: {
              begin: seq * delays,
              dur: durations,
              from: data.x - 10,
              to: data.x,
              easing: 'easeOutQuart'
            },
            opacity: {
              begin: seq * delays,
              dur: durations,
              from: 0,
              to: 1,
              easing: 'easeOutQuart'
            }
          });
        } else if(data.type === 'grid') {
          // Using data.axis we get x or y which we can use to construct our animation definition objects
          var pos1Animation = {
            begin: seq * delays,
            dur: durations,
            from: data[data.axis.units.pos + '1'] - 30,
            to: data[data.axis.units.pos + '1'],
            easing: 'easeOutQuart'
          };

          var pos2Animation = {
            begin: seq * delays,
            dur: durations,
            from: data[data.axis.units.pos + '2'] - 100,
            to: data[data.axis.units.pos + '2'],
            easing: 'easeOutQuart'
          };

          var animations = {};
          animations[data.axis.units.pos + '1'] = pos1Animation;
          animations[data.axis.units.pos + '2'] = pos2Animation;
          animations['opacity'] = {
            begin: seq * delays,
            dur: durations,
            from: 0,
            to: 1,
            easing: 'easeOutQuart'
          };

          data.element.animate(animations);
        }
      });

      // For the sake of the example we update the chart every time it's created with a delay of 10 seconds
      chart.on('created', function() {
        if(window.__exampleAnimateTimeout) {
          clearTimeout(window.__exampleAnimateTimeout);
          window.__exampleAnimateTimeout = null;
        }
        window.__exampleAnimateTimeout = setTimeout(chart.update.bind(chart), 500000);
      });
}
    // var seriesData =  [
    //        [{ x: 0, y: 120 }, 
    //         { x: 1, y: 890 }, 
    //         { x: 2, y: 38 }, 
    //         { x: 3, y: 70 }, 
    //         { x: 4, y: 32 }, 
    //         { x: 5, y: 60 }]
    // ];


    // var rdc = new Rickshaw.Graph( {
    //         element: document.getElementById("chart-pemasukan"),
    //         renderer: 'area',
    //         width: $("#chart-pemasukan").width(),
    //         height: 500,
    //         series: [{color: "#3FBAE4",data: seriesData[0],name: 'Graph Pemasukan'}]
    // } );

    // var xAxis = new Rickshaw.Graph.Axis.Time({
    //         graph: rdc,
    //         tickFormat: function(x){
    //             return new Date(x).toLocaleString();
    //         },
    //         ticks: 4
    //     });

    // rdc.render();

    // var legend = new Rickshaw.Graph.Legend({graph: rdc, element: document.getElementById('pemasukan-legend')});

    // var shelving = new Rickshaw.Graph.Behavior.Series.Toggle({graph: rdc,legend: legend});
    // var order = new Rickshaw.Graph.Behavior.Series.Order({graph: rdc,legend: legend});
    // var highlight = new Rickshaw.Graph.Behavior.Series.Highlight( {graph: rdc,legend: legend} );     
 

    // var rdc_resize = function() {                
    //         rdc.configure({
    //                 width: $("#chart-pemasukan").width(),
    //                 height: $("#chart-pemasukan").height()
    //         });
    //         rdc.render();
    // }

    // var hoverDetail = new Rickshaw.Graph.HoverDetail({graph: rdc});

    // window.addEventListener('resize', rdc_resize);        

    // rdc_resize();
</script>