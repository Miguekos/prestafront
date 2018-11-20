<template>
    <div>

        <!-- <v-card> -->
        <v-card-title>
            <h3>Clientes sin deudas</h3>
             <v-spacer></v-spacer>
            <!-- <v-container grid-list-md text-xs-center> -->
                <!-- <v-layout> -->
                    <!-- <v-flex xs6> -->
                        <!-- <v-card> -->
                        <!-- <v-select :items="itemsc" @change="getData(itemsc[0].value)" v-model="selected" label="Monitores"></v-select> -->
                        <!-- </v-card> -->
                    <!-- </v-flex> -->
                    <!-- <v-flex xs6> -->
                        <!-- <v-card dark color="blue-grey darken-4"> -->
                        <v-text-field append-icon="search" label="Buscar" single-line hide-details v-model="search"></v-text-field>
                        <!-- </v-card> -->
                    <!-- </v-flex> -->
                <!-- </v-layout> -->
            <!-- </v-container> -->
        </v-card-title>

        <v-dialog v-model="dialog" hide-overlay persistent width="50%">
            <v-card color="primary" dark>
                <v-card-text>
                    Por favor espere!
                    <v-progress-linear indeterminate color="white" class="mb-0"></v-progress-linear>
                </v-card-text>
            </v-card>
        </v-dialog>

        <!-- <v-data-table :headers="headers" :items="items" :search="search"> -->
        <v-data-table :rows-per-page-items="[5,10,20]" :headers="headers" :items="desserts" :search="search" v-model="selected"
            item-key="id" class="elevation-1">
            <template slot="headerCell" slot-scope="props">
                <v-tooltip bottom>
                    <span slot="activator">
                        {{ props.header.text }}
                    </span>
                    <span>
                        {{ props.header.text }}
                    </span>
                </v-tooltip>
            </template>
            <template slot="items" slot-scope="props">
                <td>
                    <v-checkbox v-model="props.selected" primary hide-details></v-checkbox>
                </td>
                <td class="text-xs-center">{{ props.item.id }}</td>
                <td class="text-xs-center">{{ props.item.nombre }}</td>
                <td class="text-xs-center">{{ props.item.dni }}</td>
                <td class="text-xs-center">{{ props.item.telf }}</td>
                <td class="text-xs-center">{{ props.item.deuda }}</td>
                <td class="text-xs-center">{{ props.item.agregado }}</td>
                <td class="text-xs-center">{{ props.item.fecha }}</td>
            </template>
            <v-alert slot="no-results" :value="true" color="error" icon="warning">
                Tu busqueda para "{{ search }}" no tiene resultados.
            </v-alert>
        </v-data-table>


        <!-- <pre>{{ $data }}</pre> -->

        <!-- </v-card> -->

        <ul v-if="errors && errors.length">
            <li v-for="error in errors" :key="error.request">
                {{error.message}}
            </li>
        </ul>
    </div>
</template>

<script>
    import axios from "axios";
    import moment from "moment";

    export default {
        data() {
            return {
                errors: [],
                dialog: false,
                search: "",
                selected: [],
                headers: [{
                        text: "",
                        align: "center",
                        sortable: false,
                        value: ""
                    },
                    {
                        text: "#",
                        align: "center",
                        value: "id",
                    },
                    {
                        text: "Nombre",
                        align: "center",
                        value: "nombre",
                    },
                    {
                        text: "DNI",
                        align: "center",
                        value: "dni",
                    },
                    {
                        text: "Telf",
                        align: "center",
                        value: "telf",
                    },
                    {
                        text: "Deuda",
                        align: "center",
                        value: "deuda",
                    },
                    {
                        text: "Agregado Por:",
                        align: "center",
                        value: "agregado",
                    },
                    {
                        text: "Fecha Prestamo",
                        align: "center",
                        value: "fecha",
                    }
                ],
                desserts: []
            };
        },
        created() {
            this.getData();
        },
        watch: {
            dialog(val) {
                if (!val) return;
                setTimeout(() => (this.dialog = false), 4000);
            }
        },
        methods: {
            moment: function (date) {
                return moment(date);
            },
            getData: function (n) {
                this.dialog = true;
                axios
                    .get(`http://prestamos.test/v1.0/clientes`)
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.desserts = response.data.cliente;
                        console.log(response.data.cliente);
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });
            },
            ticketPegado: function (monitor, estacion, ticket) {
                this.dialog = true;
                axios
                    .get(`https://jsonplaceholder.typicode.com/todos/${n}`)
                    .then(response => {
                        // JSON responses are automatically parsed.
                        this.desserts = response.data;
                        console.log(response.data);
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });
            }
        },
    };
</script>