<template>
	<div>
	  <apexchart width="100%" type="bar" :options="options" :series="series"></apexchart>
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
		      	title: {
                              text: 'Product Trends by Month',
                              align: 'left'
                          },
		        chart: {
		          id: 'vuechart-example'
		        },
		        xaxis: {
		          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
		        }
		      },
		      series: [{
		        name: 'series-1',
		        data: [30, 40, 45, 50, 49, 60, 70, 91]
		      }]
		    }
        },
	};

</script>