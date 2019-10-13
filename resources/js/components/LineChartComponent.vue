<template>
    <div>
      <apexchart width="100%" type="line" :options="options" :series="series"></apexchart>
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
            	options: {
                          
                          dataLabels: {
                              enabled: false
                          },
                          stroke: {
                              curve: 'straight'
                          },
                          title: {
                              text: 'Product Trends by Month',
                              align: 'left'
                          },
                          grid: {
                              row: {
                                  colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                  opacity: 0.5
                              },
                          },
                          xaxis: {
                              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                          }
                  	},
                series: [{
                              name: "Desktops",
                              data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                          }],
      				 }
        	},

	};

</script>