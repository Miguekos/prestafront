<template>
    <div>
        <v-toolbar flat color="white">
            <v-toolbar-title>Clientes </v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-text-field append-icon="search" label="Buscar" single-line hide-details v-model="search"></v-text-field>
            <v-spacer></v-spacer>
            <!-- Dialog Para Crear Cliente -->
            <v-dialog v-model="dialog" max-width="700px">
                <v-btn slot="activator" color="green" fab small dark class="mb-2">
                    <v-icon>add</v-icon>
                </v-btn>
                <v-card>
                    <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                    </v-card-title>
                    <template>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <cliente-crear 
                                    :user="user" 
                                    :close="close" 
                                    :carga="getDataCliente"
                                    ></cliente-crear>
                                </div>
                            </div>
                        </div>
                    </template>
                </v-card>
            </v-dialog>
            <!-- Dialog para editar -->
            <v-dialog v-model="dialog1" max-width="700px">
                <v-card>
                    <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                    </v-card-title>
                    <template>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <cliente-edit 
                                    :cliente="editCliente" 
                                    :user="user" 
                                    :close="close" 
                                    :carga="getDataCliente"
                                    ></cliente-edit>
                                </div>
                            </div>
                        </div>
                    </template>
                </v-card>
            </v-dialog>
        </v-toolbar>

        <v-data-table must-sort :pagination.sync="pagination" :headers="headers" :items="desserts" class="elevation-1" :search="search" :rows-per-page-items="[5,10,20]">
            

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
        </v-data-table>
        <!-- <pre>{{ $data }}</pre> -->
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data: () => ({
            errors: [],
            editCliente: "",
            agregado: "",
            agregado_id: "",
            abono_id: "",
            mirar: "",
            idedit: "",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            loading: false,
            dialog: false,
            dialog1: false,
            search: "",
            pagination: {
                sortBy: 'id'
            },
            headers: [{
                    text: '#',
                    align: 'left',
                    value: 'id',
                    
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
                "comentario": null,
            },
            defaultItem: {
                "nombre": "",
                "dni": "",
                "direccion": null,
                "fecha": "",
                "telf": "",
                "prestamo": null,
                "deuda": null,
                "interes": null,
                "monto_a_apagar": null,
                "dias_para_pagar": null,
                "pago_dia": null,
                "fecha_limite": null,
                "comentario": null,
            },
        }),

        computed: {
            getPr() {
                return this.user.name;
            },
            formTitle() {
                return this.editedIndex === -1 ? 'Nuevo Cliente' : 'Editar Cliente'
            },
            envio() {
                return this.editedIndex === -1 ? 'sendForm' : 'editForm'
            }
        },
        mounted() {
            // Cuando carga la pagina pasa los valores del props a las variables en data que pasan por : a los input
            this.agregado = this.user.id
            this.agregado_id = this.user.id
            this.abono_id = 0
        },
        watch: {
            dialog(val) {
                val || this.close()
            }
        },
        created() {
            // Carga lsita de clientes despues de cargar la pagina
            this.getDataCliente();
        },
        methods: {
            getDataCliente() {
                axios
                    .get(`/v1.0/clientes`)
                    .then(response => {
                        this.desserts = response.data.cliente;
                        console.log(response.data.cliente);
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });
            },
            editItem(item) {
                // this.editedIndex = this.desserts.indexOf(item)
                // this.editedItem = Object.assign({}, item)
                this.dialog1 = true
                this.idedit = item.id
                axios
                    .get(`/v1.0/cliente/${item.id}`)
                    .then(response => {
                        this.editCliente = response.data;
                        console.log(response.data);
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });
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
                this.dialog1 = false
                this.dialog = false
                console.log("entro seguo que si");

                // setTimeout(() => {
                // this.editedItem = Object.assign({}, this.defaultItem)
                // this.editedIndex = -1
                // }, 300)
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