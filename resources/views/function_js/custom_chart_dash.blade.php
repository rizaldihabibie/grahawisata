        <script>
        function dash_chart(){
          var raw_data_pemasukan= <?php echo json_encode($data_chart_pemasukan ); ?>;
          if(raw_data_pemasukan != null){
                var keterangan = [];
                var nilai_pemasukan = [];
                var total_pengunjung = [];
                var all_pemasukan = [];
                var bulan = null;
                for(var i=0;i<raw_data_pemasukan.length;i++){
                    // alert(raw_data_pemasukan[i]['day']);
                    if(i==0){bulan="Januari";}else if(i==1){bulan="Februari";}else if(i==2){bulan="Maret";}else if(i==3){bulan="April";}
                    else if(i==4){bulan="Mei";}else if(i==5){bulan="Juni";}else if(i==6){bulan="Juli";}else if(i==7){bulan="Agustus";}
                    else if(i==8){bulan="September";}else if(i==9){bulan="Oktober";}else if(i==10){bulan="November";}else if(i==11){bulan="Desember";}

                    keterangan[i]=raw_data_pemasukan[i]['day'];
                    nilai_pemasukan[i]=parseInt(raw_data_pemasukan[i]['pemasukan']);
                    total_pengunjung[i]=parseInt(raw_data_pemasukan[i]['total']);
                    all_pemasukan[i]= {meta:(' Bulan '+ bulan +' - Total Pemesanan = '+raw_data_pemasukan[i]['total']),
                                       value:raw_data_pemasukan[i]['pemasukan']};
                }
                var test = [{meta: 'description A', value: 1 },{meta: 'description B', value: 5},{meta: 'description C', value: 3}];
                // alert(test);
                var chart =  new Chartist.Line('#chart-pemasukan-dash', 
                    {
                        labels: keterangan,
                        series: [all_pemasukan]  
                        // series: [test]  
                    },
                    {
                          fullWidth: true,
                          // high: 8,
                          // showLine: false,
                          // showPoint: false,
                          low: 0,
                          axisX: { showGrid: false,position: 'start' },
                          axisY: { showGrid: false },
                          showArea: true,
                          plugins: [
                            Chartist.plugins.tooltip()
                          ]
                    }

                  );

                // On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
                chart.on('draw', function(data) {
                   if(data.type === 'label'){
                      data.element.remove();
                    }
                });

          }
        }

        dash_chart();
        </script>