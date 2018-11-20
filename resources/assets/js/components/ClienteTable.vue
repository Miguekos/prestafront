<template>
    <div>
        <v-toolbar flat color="white">
            <v-toolbar-title>Clientes</v-toolbar-title>
            <!-- <v-btn @click="createdFormData">create</v-btn> -->
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-text-field append-icon="search" label="Buscar" single-line hide-details v-model="search"></v-text-field>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="700px">
                <v-btn slot="activator" color="green" fab small dark class="mb-2">
                    <v-icon>add</v-icon>
                </v-btn>

                <v-card>
                    <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                    </v-card-title>
                    <!-- <cliente-crear></cliente-crear> -->
                    <template>
                        <div class="container-fluid">
                            <div class="row">
                                <div id="sombra" class="col-md-12">
                                    <form>
                                        <div class="form-group">
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" v-model="editedItem.nombre"
                                                    autofocus name="nombre" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="telf">DNI</label>
                                                <input type="text" class="form-control" v-model="editedItem.dni" name="dni"
                                                    placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="direccion">Direccion</label>
                                                <input type="text" class="form-control" v-model="editedItem.direccion"
                                                    name="direccion" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="fecha">Fecha</label>
                                                <input type="date" class="form-control" v-model="editedItem.fecha" name="fecha"
                                                    pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="" id="fecha">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="dni">Telf</label>
                                                <input type="text" class="form-control" v-model="editedItem.telf" name="telf"
                                                    placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="prestamo">Prestamo</label>
                                                <input type="number" class="form-control" v-model="editedItem.prestamo"
                                                    onkeyup="calcular()" id="prestamo" name="prestamo" placeholder="">
                                                <input type="hidden" class="form-control" v-model="editedItem.deuda" id="deuda"
                                                    name="deuda" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="interes">Interes %</label>
                                                <input type="number" class="form-control" v-model="editedItem.interes"
                                                    onkeyup="calcular()" id=interes name="interes" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">Monto a Pagar</label>
                                                <input type="text" class="form-control" v-model="editedItem.monto_a_apagar"
                                                    readonly name="monto_a_apagar" id="total" placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">Dias del prestamo</label>
                                                <input type="number" class="form-control" v-model="editedItem.dias"
                                                    onkeyup="pago_por_dia()" id="dias" name="dias_para_pagar"
                                                    placeholder="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">Pago por dia</label>
                                                <input type="text" class="form-control" readonly id="totaldias" v-model="editedItem.pago_dia"
                                                    name="pago_dia" placeholder="">

                                            </div>

                                        </div>
                                        <div class="form-group col-md-12">
                                            <!--<input  class="btn btn-success btn-block" value="Guardar">-->
                                            <!--<v-btn type="submit" block color="green" dark>Guardar</v-btn>-->
                                            <!-- <v-btn
                                    :loading="loading"
                                    :disabled="loading"
                                    color="green"
                                    @click="loader = 'loading'"
                                    type="submit"
                                    block
                                    black
                                    dark
                            >
                                Guardar
                            </v-btn> -->

                                            <v-btn color="green darken-1" dark @click="save">Save</v-btn>
                                            <v-btn color="red darken-1" dark @click.native="close">Cancel</v-btn>

                                            <!-- <v-btn @click="createdFormData">create</v-btn> -->

                                        </div>
                                        <input type="hidden" name="agregado" v-model="agregado" value="user.name">
                                        <input type="hidden" name="agregado_id" v-model="agregado_id" value="user.id">
                                        <input type="hidden" name="abono_id" v-model="editedItem.abono_id" value="0">

                                    </form>

                                </div>
                            </div>
                        </div>
                    </template>

                    <!--<v-card-text>-->


                    <v-card-actions>
                        <v-spacer></v-spacer>

                    </v-card-actions>
                </v-card>
            </v-dialog>

        </v-toolbar>

        <v-data-table :headers="headers" :items="desserts" class="elevation-1" :search="search" :rows-per-page-items="[5,10,20]">

            <template slot="items" slot-scope="props">
                <td>{{ props.item.id }}</td>
                <td class="">{{ props.item.nombre }}</td>
                <td class="">{{ props.item.dni }}</td>
                <td class="">{{ props.item.telf }}</td>
                <td class="">{{ props.item.deuda }}</td>
                <td class="justify-center layout px-0">
                    <v-icon small class="mr-2" @click="editItem(props.item)">
                        edit
                    </v-icon>
                    <v-icon small @click="deleteItem(props.item)">
                        delete
                    </v-icon>
                </td>

            </template>

            <template slot="no-data">
                <v-alert :value="true" color="error" icon="warning">
                    Sorry, nothing to display here :(
                </v-alert>
            </template>
            <!--<template slot="no-data">-->
            <!--<v-btn color="primary" @click="getDataCliente">Reset</v-btn>-->
            <!--</template>-->
        </v-data-table>
        <!-- <pre>{{ $data }}</pre> -->
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data: () => ({
            errors: [],
            agregado: "",
            agregado_id: "",
            mirar: "",
            idedit: "",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            loading: false,
            dialog: false,
            search: "",
            headers: [{
                    text: '#',
                    align: 'left',
                    value: 'id',
                    sortable: true
                },
                {
                    text: 'Nombre',
                    value: 'nombre'
                },
                {
                    text: 'DNI',
                    value: 'dni'
                },
                {
                    text: 'Telf',
                    value: 'telf'
                },
                {
                    text: 'Deuda',
                    value: 'deuda'
                },
                {
                    text: 'Actions',
                    value: 'id',
                    sortable: false
                }
            ],
            desserts: [],
            editedIndex: -1,
            editedItem: {
                "nombre": "",
                "dni": "",
                "direccion": "",
                "fecha": "",
                "telf": "",
                "prestamo": null,
                "deuda": null,
                "interes": null,
                "monto_a_apagar": null,
                "dias_para_pagar": null,
                "pago_dia": null,
                "fecha_limite": null,
                "abono_id": null,
                "comentario": null,
                "agregado": null,
                "agregado_id": null,
                "_token": this.csrf,
            },
            defaultItem: {
                "nombre": "",
                "dni": "",
                "direccion": "",
                "fecha": "",
                "telf": "",
                "prestamo": null,
                "deuda": null,
                "interes": null,
                "monto_a_apagar": null,
                "dias_para_pagar": null,
                "pago_dia": null,
                "fecha_limite": null,
                "abono_id": null,
                "comentario": null,
                "_token": this.csrf,
            },
        }),

        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'Nuevo Cliente' : 'Editar Cliente'
            },
            envio() {
                return this.editedIndex === -1 ? 'sendForm' : 'editForm'
            }
        },

        watch: {
            dialog(val) {
                val || this.close()
            }
        },

        created() {
            //      this.initialize()
            this.getDataCliente();
        },
        methods: {
            getDataCliente: function (n) {
                //  this.dialog = true;
                axios
                    .get(`/v1.0/clientes`)
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.desserts = response.data.cliente;
                        console.log(response.data.cliente);
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });
            },
            editItem(item) {
                this.editedIndex = this.desserts.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
                this.idedit = item.id
            },
            deleteItem(item) {
                const index = this.desserts.indexOf(item)
                console.log("Aqui abajo");
                console.log(item.id);
                confirm('Esta seguro que desea borrar esta Cliente?') && this.desserts.splice(index, 1)
                axios
                    .delete(`/v1.0/cliente/${item.id}`, {
                        _token: this.csrf
                    })
                    .then(response => {
                        //                    window.location.href = '/';
                        // JSON responses are automatically parsed.
                        //                        this.user = response.data;
                        //                        console.log(response.data);
                        console.log("Borrado correctamente");
                    })
                    .catch(e => {
                        //                        this.errors.push(e);
                    });
            },

            close() {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },
            save() {
                if (this.editedIndex > -1) {
                    //   edit
                    // Object.assign(this.desserts[this.editedIndex], this.editedItem)
                    console.log(this.editedItem);
                    axios({
                            method: 'put',
                            url: `/v1.0/cliente/${this.idedit}`,
                            data: this.editedItem,
                        })
                        .then(function (response) {
                            response.data
                            console.log(response.data);
                            this.getDataCliente();
                        });

                } else {
                    // nuevo
                    // console.log(this.editedItem);
                    axios({
                            method: 'post',
                            url: `/v1.0/cliente`,
                            data: this.editedItem,
                        })
                        .then(function (response) {
                            response.data
                            console.log(response.data);
                            this.getDataCliente();
                        });
                }
                this.close()
            },
            deleteCliente: function (id) {
                console.log("entro a al borrar");
                //                this.dialog = true;
                axios
                    .delete(`/v1.0/cliente/${id}`, {
                        _token: this.csrf
                    })
                    .then(response => {
                        //                    window.location.href = '/';
                        // JSON responses are automatically parsed.
                        //                        this.user = response.data;
                        //                        console.log(response.data);
                        console.log("Borrado correctamente");
                    })
                    .catch(e => {
                        //                        this.errors.push(e);
                    });
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