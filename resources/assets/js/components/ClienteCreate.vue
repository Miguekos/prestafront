<template>
<div class="container-fluid">
    <div class="row">
        <div id="sombra" class="col-md-12">
            <form id="ContactForm" @submit="sendForm">
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" required autofocus name="nombre" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="telf">DNI</label>
                                <input type="text" class="form-control" required name="dni" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="direccion">Direccion</label>
                                <input type="text" class="form-control" required name="direccion" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" required name="fecha" value="" id="fecha">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="dni">Telf</label>
                                <input type="text" class="form-control" required name="telf" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="prestamo">Prestamo</label>
                                <input type="number" class="form-control" required onkeyup="calcular()" id="prestamo" name="prestamo" placeholder="">
                                <input type="hidden" class="form-control" required id="deuda" name="deuda" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="interes">Interes %</label>
                                <input type="number" class="form-control" required onkeyup="calcular()" id=interes name="interes" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Monto a Pagar</label>
                                <input type="text" class="form-control" required readonly name="monto_a_apagar" id="total" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Dias del prestamo</label>
                                <input type="number" class="form-control" required onkeyup="pago_por_dia()" id="dias" name="dias_para_pagar" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Pago por dia</label>
                                <input type="text" class="form-control" required readonly id="totaldias" name="pago_dia" placeholder="">
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <!--<input  class="btn btn-success btn-block" value="Guardar">-->
                            <!--<v-btn type="submit" block color="green" dark>Guardar</v-btn>-->
                            <v-btn
                                    :loading="loading"
                                    :disabled="loading"
                                    color="green"
                                    @click="loader = 'loading', preciono()"
                                    type="submit"
                                    block
                                    black
                            >
                                Guardar
                            </v-btn>
                        </div>
                        <input type="hidden" name="agregado" value="">
                        <input type="hidden" name="agregado_id" value="">
                        <input type="hidden" name="abono_id" value="0">
                    </form>

        </div>
    </div>
</div>
</template>

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

<script>
    export default{
        data() {
            return{
                loader: null,
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
            sendForm (e) {
                console.log("aqui");
//                alert('Enviando Form')
//                this.snackbar= true
                let form = document.getElementById('ContactForm'),
                    formData = new FormData(form)

                axios.post('/cliente',formData)
                    .then(response => {
                        console.log(response)
//                        this.snackbar = true
//                        this.message.serverResponse = response.data
//                        this.serverResponse = true
                    })
                    .catch(error => {
                        console.log(error)
//                        this.message.serverResponse = error
//                        this.serverResponse = false
                    })
            },
            preciono: function () {
                console.log("preciono el boton")
            }
        }
    }
</script>