<template>
    <div>
      <apexchart width="500" type="donut" :options="options_computed" :series="series"></apexchart>
    </div>
  </template>

<script>

	import apexchart from 'vue-apexcharts'

	export default
	{
		components: {
            apexchart
          },

    mounted(){
      let self = this

      self.llenar_donut_chart()
    },

		data(){
            return {

              meses:[],
              montos:[],

              	options: {
              		// labels: ['Apple', 'Mango', 'Orange', 'Watermelon','Pineapple'],
                  labels:[],
              		title: {
                                text: 'Ventas por mes',
                                align: 'left'
                            },
              	},
        			//series: [44, 55, 41, 17, 15]
              series:[],
  				 }
      },

    methods:{

        llenar_donut_chart(){
           let self = this

           axios.get('/reporte-mensual')
                            .then(r => {

                                  self.meses = r.data.data.meses
                                  self.series = r.data.data.montos
                            })
                            .catch(error => {
                                if (error.response) {
                                    Toastr.error(error.response.data.error,''); 
                                }else{
                                    Toastr.error('Ocurrió un error: ' + error,'Error');
                                }
                            });
        }
    },

    computed:{

      options_computed(){

        var options = {}

        if(!this.meses)
        {
            return options = {
                  labels:[],
                  title: {
                                text: 'Ventas por mes',
                                align: 'left'
                            },
                }
        }
        else
        {
          return options = {
                  labels:this.meses,
                  title: {
                                text: 'Ventas por mes',
                                align: 'left'
                            },
                } 
        }
      },

      series_computed(){

          this.series = null
          this.series = this.montos

          return this.series
      }
    }

	};

</script>