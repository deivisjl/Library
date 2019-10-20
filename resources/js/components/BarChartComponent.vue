<template>
	<div>
	  <apexchart width="100%" type="bar" :options="options_computed" :series="series_computed"></apexchart>
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
            	xaxis:null,

		      options: {
		      	title: {
                              text: 'Los 3 productos más vendidos',
                              align: 'left'
                          },
		        chart: {
		          id: 'vuechart-example'
		        },
		        xaxis: {
		          categories: []
		        }
		      },
		      series: []
		    }
        },

        created(){
        	let self = this

        	self.llenar_bar_chart()
        },

        methods:{

	        llenar_bar_chart(){
	           let self = this

	           axios.get('/reporte-mas-vendidos')
	                            .then(r => {
	                                  self.xaxis = r.data.data.base.categories
	                                  self.series = r.data.data.series
	                                  
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
	    	options_computed:function(){
	    		var options = {}

	    		if(!this.xaxis){

	    			return options= {
				      	title:{
		                              text: 'Los 3 productos más vendidos',
		                              align: 'left'
		                          },
				        chart:{
				          id:'vuechart-example'
				        },
				        xaxis: {
				           categories: []
				        }
				      }
	    		}
	    		else{
	    			return options = {

				      	title : {
		                              text : 'Los 3 productos más vendidos',
		                              align : 'left'
		                          },
				        chart : {
				          id : 'vuechart-example'
				        },
				        xaxis : {
				           categories : this.xaxis
				        }
				      }
	    		}
	    	},

	    	series_computed:function(){

	    		return this.series
	    	},
	    },
	};

</script>