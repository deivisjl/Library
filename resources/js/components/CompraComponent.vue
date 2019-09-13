<template>
    <div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="" class="control-label">No. factura</label>
                    <input type="text" class="form-control" v-model="form.factura">
                </div>
            </div>
            <div class="col-md-5">
                    <div class="form-group">
                        <label for="" class="control-label">Nit proveedor</label>
                            <autocomplete 
                            :search="buscar_proveedor"
                            :get-result-value="getProveedor"
                            @submit="onSubmitProveedor"
                            ></autocomplete>
                    </div> 
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="" class="control-label">Nombre del proveedor</label>
                    <input type="text" class="form-control" disabled="" v-model="form.proveedor.nombre">
                </div>
            </div>
        </div>
            <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="control-label">Nombre producto</label>
                                <autocomplete 
                                :search="buscar_producto"
                                :get-result-value="getProducto"
                                @submit="onSubmitProducto"
                                ></autocomplete>
                        </div> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                             <label for="" class="control-label">Precio</label>
                             <input type="text" class="form-control" v-model="precio">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                             <label for="" class="control-label">Cantidad</label>
                             <input type="text" class="form-control" v-model="cantidad">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="" class="control-label">&nbsp;</label>
                            <button type="button" class="my-button btn btn-primary btn-block" @click="agregar_producto">Agregar</button>
                        </div>
                    </div>
            </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) in productos">
                            <td>{{ index +1 }}</td>
                            <td>{{ item.nombre }} {{ item.marca }}</td>
                            <td>Q. {{ item.precio}}</td>
                            <td>{{ item.cantidad }}</td>
                            <td>Q. {{ item.subtotal }}</td>
                            <td><button class="btn btn-danger btn-sm" @click="quitar(index)"><i class="fas fa-trash-alt"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="float-right">Total Q. <span v-text="formatPrice(total)"></span></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary btn-block" @click="guardar">Guardar</button>
            </div>
        </div>
    </div>
</template>

<style>
    .autocomplete-input{
        font-size: 11px !important;
    }
    .my-button{
        display: block !important;
    }
</style>
<script>
    import Autocomplete from '@trevoreyre/autocomplete-vue'

    export default {

        components: {
            Autocomplete
          },

        data(){
            return{
                form:{
                    factura:'',
                    proveedor:{},
                },
                productos:[],
                producto:null,

                precio:'',
                cantidad:'',

                total:0.00,
            }
        },

        mounted() {
            
        },

        methods:{

            guardar(){
                let self = this

                if((self.productos.length > 0) && self.form.factura && self.form.proveedor)
                {
                    let data = {
                        proveedor_id : self.form.proveedor.id,
                        factura : self.form.factura,
                        monto : self.total,
                        detalle : self.productos,
                    }

                    axios.post('/compras',data)
                            .then(response => {
                                Toastr.success(response.data.data,'Mensaje')
                                self.vaciarPantalla()
                            })
                            .catch(error => {
                                if (error.response) {
                                    Toastr.error(error.response.data.error,''); 
                                }else{
                                    Toastr.error('Ocurrió un error: ' + error,'Error');
                                }
                            });

                }else{
                    Toastr.error('Por favor complete los campos','Mensaje');
                }
            },
            agregar_producto()
            {
                let self = this

                if(self.precio && self.cantidad && self.producto){

                   if(self.isNumeric(self.precio)){
                        if(self.isNumeric(self.cantidad)){
                            var subtotal = parseFloat(self.precio * self.cantidad).toFixed(2)
                            self.total = parseFloat(self.total) + parseFloat(subtotal)

                                var data = { 
                                        id: self.producto.id,
                                        producto: self.producto.nombre,
                                        marca: self.producto.marca.nombre,
                                        precio: parseFloat(self.precio).toFixed(2),
                                        cantidad: self.cantidad,
                                        subtotal: subtotal,
                                    }

                                self.productos.push(data)

                                self.precio = ''
                                self.cantidad = ''
                        }else{
                            Toastr.error('Debe ingresar datos válidos','Mensaje');
                        }
                   }else{
                        Toastr.error('Debe ingresar datos válidos','Mensaje');
                    }
                }else{
                    Toastr.error('Debe ingresar datos válidos','Mensaje');
                }
                
            },
            buscar_proveedor(input){
                return new Promise(resolve => {
                        if(input < 2){
                            return resolve([])
                        }

                         axios.get('/compras/'+input)
                            .then(response => {
                                resolve(response.data.data)
                            });
                    });
            },

            actualizar_total()
            {
                let self = this

                self.productos.forEach(function(item){
                    self.total += item.subtotal
                })
            },

            getProveedor(result){

                return result.nit+' - '+result.nombre
            },

            onSubmitProveedor(data){

                let self = this

                self.form.proveedor = data
            },


            buscar_producto(input){
                 return new Promise(resolve => {
                        if(input < 2){
                            return resolve([])
                        }

                         axios.get('/compras-producto/'+input)
                            .then(response => {
                                resolve(response.data.data)
                            });
                    });
            },

            getProducto(result){
                return result.nombre +' - '+ result.marca.nombre
            },

            onSubmitProducto(data){
                let self = this
                return self.producto = data
            },

            formatPrice(value) {
                return  parseFloat(value).toFixed(2);             
            },

            isNumeric(value){
                 return !isNaN(parseFloat(value)) && isFinite(value)
            },

            quitar(index){

                let self = this

                self.total = parseFloat(self.total) - parseFloat(self.productos[index].subtotal )
                self.productos.splice(index,1)
            },

            vaciarPantalla(){
                let self = this

                self.form.factura = ''
                self.form.proveedor = ''
                self.productos = ''
                self.total = 0.00
            },
        }
    }
</script>
