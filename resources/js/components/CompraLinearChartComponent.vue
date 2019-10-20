<template>
    <div>
      <apexchart width="100%" type="line" :options="options_computed" :series="series_computed"></apexchart>
    </div>
  </template>
<script>

	import apexchart from 'vue-apexcharts'

	export default
	{
		components: {
            apexchart
          },

		data(){
            return {
              xaxis:{},
              series:[],

               }
        	},

          created(){
            let self = this

            self.llenar_line_chart()
          },
      methods:{

        llenar_line_chart(){
           let self = this

           axios.get('/reporte-compras')
                            .then(r => {

                                  self.xaxis = r.data.data.etiquetas
                                  self.series = r.data.data.valores
                                  
                            })
                            .catch(error => {
                                if (error.response) {
                                    Toastr.error(error.response.data.error,''); 
                                }else{
                                    Toastr.error('Ocurrió un error: ' + error,'Error');
                                }
                            });
        },

        dibujar_series(data)
        {
            var series = []
            
            return  series = data
        },

        dibujar_options(data)
        {
           var options = {}

            return options = {
                          
                          dataLabels: {
                              enabled: false
                          },
                          stroke: {
                              curve: 'straight'
                          },
                          title: {
                              text: 'Compras por mes',
                              align: 'left'
                          },
                          colors: ['#f71010'],
                         yaxis: {
                            title: {
                              text: 'Cifras en Quetzales'
                            },
                          },

                          grid: {
                              row: {
                                  colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                  opacity: 0.5
                              },
                          },
                          xaxis: data
                    }
        },

      },

      computed:{

      options_computed(){


          if(!this.xaxis)
          {
             return this.dibujar_options({})
          }
          else
          {
              return this.dibujar_options(this.xaxis)
          }
      },

      series_computed()
      {

         if(!this.series)
         {
             return this.dibujar_series([])
         }
         else
         {
             return this.dibujar_series(this.series)
         }
      }
    }
	};

</script>