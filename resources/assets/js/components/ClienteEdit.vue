<template>
<div class="container-fluid">
    <div class="row">
        <div id="" class="col-md-12">
            <form id="ContactForm" @submit.prevent="update">
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" required :value="cliente.nombre" autofocus name="nombre" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="telf">DNI</label>
                                <input type="text" class="form-control" required :value="cliente.dni" name="dni" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="direccion">Direccion</label>
                                <input type="text" class="form-control" required :value="cliente.direccion" name="direccion" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" required :value="cliente.fecha" name="fecha" id="fecha">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="dni">Telf</label>
                                <input type="text" class="form-control" required :value="cliente.telf" name="telf" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="prestamo">Prestamo</label>
                                <input type="number" class="form-control" required :value="cliente.prestamo" onkeyup="calcular()" id="prestamo" name="prestamo" placeholder="">
                                <input type="hidden" class="form-control" required :value="cliente.deuda" id="deuda" name="deuda" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="interes">Interes %</label>
                                <input type="number" class="form-control" required :value="cliente.interes" onkeyup="calcular()" id="interes" name="interes" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Monto a Pagar</label>
                                <input type="text" class="form-control" required :value="cliente.monto_a_apagar" readonly name="monto_a_apagar" id="total" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Dias del prestamo</label>
                                <input type="number" class="form-control" required :value="cliente.dias_para_pagar" onkeyup="pago_por_dia()" id="dias" name="dias_para_pagar" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Pago por dia</label>
                                <input type="text" class="form-control" required :value="cliente.pago_dia" readonly id="totaldias" name="pago_dia" placeholder="">
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <!--<input  class="btn btn-success btn-block" value="Guardar">-->
                            <!--<v-btn type="submit" block color="green" dark>Guardar</v-btn>-->
                            <v-btn
                                    :loading="loading"
                                    :disabled="loading"
                                    color="green"
                                    type="submit"
                                    black
                                    small
                            >
                                Guardar
                            </v-btn>
                            <v-btn black small color="red darken-1" dark @click.native="close">Cancel</v-btn>
                            
                        </div>
                        <input type="hidden" name="agregado" :value="user.name">
                        <input type="hidden" name="agregado_id" :value="user.id">
                        <input type="hidden" name="abono_id" :value="0">
                        <input type="hidden" name="_token" :value="csrf">
                    </form>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: ['cliente','user','close','carga'],
        data() {
            return{
                loader: null,
                agregado: "",
                agregado_id: "",
                abono_id: "",
                loading: false,
                loading2: false,
                loading3: false,
                loading4: false,
                formType: true,
//                serverResponse: false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        watch: {
            loader () {
                const l = this.loader
                this[l] = !this[l]

                setTimeout(() => (this[l] = false), 3000)

                this.loader = null
            }
        },
        methods: {
            update () {
                console.log("aqui id para ipdate");
                console.log(this.cliente.id);
//                alert('Enviando Form')
//                this.snackbar= true
                let form = document.getElementById('ContactForm');
                //     formData = new FormData(form);
                //     console.log(form);
                    const formData = new FormData(form);
                    let jsonObject = {};

                    for (const [key, value]  of formData.entries()) {
                        jsonObject[key] = value;
                    }
                    console.log(jsonObject);
                axios({
                            method: 'put',
                            url: `/v1.0/cliente/${this.cliente.id}`,
                            data: jsonObject,
                        })
                        .then(function (response) {
                            response.data
                            console.log(response.data);
                        });
                        this.close();
                        this.carga();
            },
            preciono: function () {
                console.log("preciono el boton")
            }
        }
    }
</script>


<style>
    .custom-loader {
        animation: loader 1s infinite;
        display: flex;
    }
    @-moz-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @-webkit-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @-o-keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @keyframes loader {
        from {
            transform: rotate(0);
        }
        to {
            transform: rotate(360deg);
        }
    }
</style>
