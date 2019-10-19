<template>
    <div>
      <apexchart width="500" type="donut" :options="options" :series="series"></apexchart>
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
            		labels: ['Apple', 'Mango', 'Orange', 'Watermelon'],
            		title: {
                              text: 'Ventas por mes',
                              align: 'left'
                          },
            	},
      			series: [44, 55, 41, 17, 15]
				 }
        	},

	};

</script>