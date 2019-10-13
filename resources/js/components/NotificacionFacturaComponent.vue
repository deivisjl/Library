<template>
	<div>
	  	<div class="alert alert-info" role="alert" v-for="alerta in items">
		  <span>Tiene {{ alerta.hasta - alerta.emitida }} factura(s) disponibles para emitir de la Serie {{ alerta.nombre }}</span>
		</div>
	</div>
</template>

<script>

	export default
	{

		data(){
            return {
		       items:[],
		    }
        },

        created(){
        	let self = this
        	self.obtener_notificacion_factura();
        },

        methods:{

        	obtener_notificacion_factura()
        	{
        		let self = this

        		axios.get('/habilitar-facturas-info')
                            .then(response => {

                                self.items = response.data.data
                                
                            })
                            .catch(error => {
                                if (error.response) {
                                    Toastr.error(error.response.data.error,''); 
                                }else{
                                    Toastr.error('Ocurrió un error: ' + error,'Error');
                                }
                            });
        	},
        },
	};

</script>