<template>
    <div>
        <div class="row">
             <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="control-label">Nombre del cliente</label>
                            <autocomplete 
                            :search="buscar_cliente"
                            :get-result-value="getCliente"
                            @submit="onSubmitCliente"
                            ></autocomplete>
                    </div> 
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="control-label">NIT del cliente</label>
                    <input type="text" class="form-control" v-model="form.cliente.nit">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="" class="control-label">Serie de Factura</label>
                    <multiselect 
                            v-model="serie" 
                            :options="series"
                            label="nombre" 
                            track-by="id"
                            :show-labels="false"
                            placeholder="Seleccionar"></multiselect>
                </div>
            </div>
        </div>
            <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="control-label">Nombre del producto</label>
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
                <button class="btn btn-success btn-block" @click="guardar">Guardar</button>
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

    fieldset[disabled] .multiselect{pointer-events:none}.multiselect__spinner{position:absolute;right:1px;top:1px;width:48px;height:35px;background:#fff;display:block}.multiselect__spinner:after,.multiselect__spinner:before{position:absolute;content:"";top:50%;left:50%;margin:-8px 0 0 -8px;width:16px;height:16px;border-radius:100%;border:2px solid transparent;border-top-color:#41b883;box-shadow:0 0 0 1px transparent}.multiselect__spinner:before{animation:spinning 2.4s cubic-bezier(.41,.26,.2,.62);animation-iteration-count:infinite}.multiselect__spinner:after{animation:spinning 2.4s cubic-bezier(.51,.09,.21,.8);animation-iteration-count:infinite}.multiselect__loading-enter-active,.multiselect__loading-leave-active{transition:opacity .4s ease-in-out;opacity:1}.multiselect__loading-enter,.multiselect__loading-leave-active{opacity:0}.multiselect,.multiselect__input,.multiselect__single{font-family:inherit;font-size:16px;-ms-touch-action:manipulation;touch-action:manipulation}.multiselect{box-sizing:content-box;display:block;position:relative;width:100%;min-height:40px;text-align:left;color:#35495e}.multiselect *{box-sizing:border-box}.multiselect:focus{outline:none}.multiselect--disabled{background:#ededed;pointer-events:none;opacity:.6}.multiselect--active{z-index:50}.multiselect--active:not(.multiselect--above) .multiselect__current,.multiselect--active:not(.multiselect--above) .multiselect__input,.multiselect--active:not(.multiselect--above) .multiselect__tags{border-bottom-left-radius:0;border-bottom-right-radius:0}.multiselect--active .multiselect__select{transform:rotate(180deg)}.multiselect--above.multiselect--active .multiselect__current,.multiselect--above.multiselect--active .multiselect__input,.multiselect--above.multiselect--active .multiselect__tags{border-top-left-radius:0;border-top-right-radius:0}.multiselect__input,.multiselect__single{position:relative;display:inline-block;min-height:20px;line-height:20px;border:none;border-radius:5px;background:#fff;padding:0 0 0 5px;width:100%;transition:border .1s ease;box-sizing:border-box;margin-bottom:8px;vertical-align:top}.multiselect__input:-ms-input-placeholder{color:#35495e}.multiselect__input::placeholder{color:#35495e}.multiselect__tag~.multiselect__input,.multiselect__tag~.multiselect__single{width:auto}.multiselect__input:hover,.multiselect__single:hover{border-color:#cfcfcf}.multiselect__input:focus,.multiselect__single:focus{border-color:#a8a8a8;outline:none}.multiselect__single{padding-left:5px;margin-bottom:8px}.multiselect__tags-wrap{display:inline}

.multiselect__tags{
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
}

.multiselect__tag{position:relative;display:inline-block;padding:4px 26px 4px 10px;border-radius:5px;margin-right:10px;color:#fff;line-height:1;background:#41b883;margin-bottom:5px;white-space:nowrap;overflow:hidden;max-width:100%;text-overflow:ellipsis}.multiselect__tag-icon{cursor:pointer;margin-left:7px;position:absolute;right:0;top:0;bottom:0;font-weight:700;font-style:normal;width:22px;text-align:center;line-height:22px;transition:all .2s ease;border-radius:5px}.multiselect__tag-icon:after{content:"\D7";color:#266d4d;font-size:14px}.multiselect__tag-icon:focus,.multiselect__tag-icon:hover{background:#369a6e}.multiselect__tag-icon:focus:after,.multiselect__tag-icon:hover:after{color:#fff}.multiselect__current{min-height:40px;overflow:hidden;padding:8px 30px 0 12px;white-space:nowrap;border-radius:5px;border:1px solid #e8e8e8}.multiselect__current,.multiselect__select{line-height:16px;box-sizing:border-box;display:block;margin:0;text-decoration:none;cursor:pointer}.multiselect__select{position:absolute;width:40px;height:38px;right:1px;top:1px;padding:4px 8px;text-align:center;transition:transform .2s ease}.multiselect__select:before{position:relative;right:0;top:65%;color:#999;margin-top:4px;border-color:#999 transparent transparent;border-style:solid;border-width:5px 5px 0;content:""}.multiselect__placeholder{color:#adadad;display:inline-block;margin-bottom:10px;padding-top:2px}.multiselect--active .multiselect__placeholder{display:none}.multiselect__content-wrapper{position:absolute;display:block;background:#fff;width:100%;max-height:240px;overflow:auto;border:1px solid #e8e8e8;border-top:none;border-bottom-left-radius:5px;border-bottom-right-radius:5px;z-index:50;-webkit-overflow-scrolling:touch}.multiselect__content{list-style:none;display:inline-block;padding:0;margin:0;min-width:100%;vertical-align:top}.multiselect--above .multiselect__content-wrapper{bottom:100%;border-bottom-left-radius:0;border-bottom-right-radius:0;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom:none;border-top:1px solid #e8e8e8}.multiselect__content::webkit-scrollbar{display:none}.multiselect__element{display:block}.multiselect__option{display:block;padding:12px;min-height:40px;line-height:16px;text-decoration:none;text-transform:none;vertical-align:middle;position:relative;cursor:pointer;white-space:nowrap}.multiselect__option:after{top:0;right:0;position:absolute;line-height:40px;padding-right:12px;padding-left:20px;font-size:13px}.multiselect__option--highlight{background:#41b883;outline:none;color:#fff}.multiselect__option--highlight:after{content:attr(data-select);background:#41b883;color:#fff}.multiselect__option--selected{background:#f3f3f3;color:#35495e;font-weight:700}.multiselect__option--selected:after{content:attr(data-selected);color:silver}.multiselect__option--selected.multiselect__option--highlight{background:#ff6a6a;color:#fff}.multiselect__option--selected.multiselect__option--highlight:after{background:#ff6a6a;content:attr(data-deselect);color:#fff}.multiselect--disabled .multiselect__current,.multiselect--disabled .multiselect__select{background:#ededed;color:#a6a6a6}.multiselect__option--disabled{background:#ededed!important;color:#a6a6a6!important;cursor:text;pointer-events:none}.multiselect__option--group{background:#ededed;color:#35495e}.multiselect__option--group.multiselect__option--highlight{background:#35495e;color:#fff}.multiselect__option--group.multiselect__option--highlight:after{background:#35495e}.multiselect__option--disabled.multiselect__option--highlight{background:#dedede}.multiselect__option--group-selected.multiselect__option--highlight{background:#ff6a6a;color:#fff}.multiselect__option--group-selected.multiselect__option--highlight:after{background:#ff6a6a;content:attr(data-deselect);color:#fff}.multiselect-enter-active,.multiselect-leave-active{transition:all .15s ease}.multiselect-enter,.multiselect-leave-active{opacity:0}.multiselect__strong{margin-bottom:8px;line-height:20px;display:inline-block;vertical-align:top}[dir=rtl] .multiselect{text-align:right}[dir=rtl] .multiselect__select{right:auto;left:1px}[dir=rtl] .multiselect__tags{padding:8px 8px 0 40px}[dir=rtl] .multiselect__content{text-align:right}[dir=rtl] .multiselect__option:after{right:auto;left:0}[dir=rtl] .multiselect__clear{right:auto;left:12px}[dir=rtl] .multiselect__spinner{right:auto;left:1px}@keyframes spinning{0%{transform:rotate(0)}to{transform:rotate(2turn)}}
</style>
<script>
    import Autocomplete from '@trevoreyre/autocomplete-vue'
    import Multiselect from 'vue-multiselect'

    export default {

        components: {
            Autocomplete,
            Multiselect
          },

        data(){
            return{
                series: [],

                form:{
                    cliente:{},
                },
                productos:[],
                producto:null,

                precio:'',
                cantidad:'',
                serie: null,
                total:0.00,
            }
        },

        mounted() {
            
        },

        created(){
            let self = this

            self.obtener_serie_factura()
        },

        methods:{

            guardar(){
                let self = this

                if((self.productos.length > 0) && self.form.cliente && self.serie)
                {
                    let data = {
                        cliente_id : self.form.cliente.id,
                        monto : self.total,
                        detalle : self.productos,
                        serie: self.serie,
                    }

                    axios({
                          url: '/ventas',
                          method: 'POST',
                          responseType: 'blob', // important
                          data:data,
                        }).then((response) => {
                          Toastr.success('Registro generado con éxito','Mensaje')
                          self.vaciarPantalla()
                          
                          const blob = new Blob([response.data], {type: response.data.type});
                            const url = window.URL.createObjectURL(blob);
                            const link = document.createElement('a');
                            link.href = url;
                            const contentDisposition = response.headers['content-disposition'];
                            let fileName = 'unknown';
                            if (contentDisposition) {
                                const fileNameMatch = contentDisposition.match(/filename="(.+)"/);
                                if (fileNameMatch.length === 2)
                                    fileName = fileNameMatch[1];
                            }
                            link.setAttribute('download', fileName);
                            document.body.appendChild(link);
                            link.click();
                            link.remove();
                            window.URL.revokeObjectURL(url);
                        }).catch(error => {

                            if (error.response) {
                                    Toastr.error('Ocurrió un error por favor revise el rango de su factura y su inventario','Mensaje'); 
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

            obtener_serie_factura(){
                let self = this

                 axios.get('/series-habilitadas')
                            .then(response => {
                                self.series = response.data.data
                            }).
                            catch(error =>{

                            });
            },

            buscar_cliente(input){
                return new Promise(resolve => {
                        if(input < 2){
                            return resolve([])
                        }

                         axios.get('/ventas/'+input)
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

            getCliente(result){

                return result.nombres+' - '+result.apellidos
            },

            onSubmitCliente(data){

                let self = this

                self.form.cliente = data
            },


            buscar_producto(input){
                 return new Promise(resolve => {
                        if(input < 2){
                            return resolve([])
                        }

                         axios.get('/ventas-producto/'+input)
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
                //self.form.cliente = ''
                self.productos = []
                self.total = 0.00
                self.serie = null

            },
        }
    }
</script>
