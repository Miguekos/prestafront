<template>
  <div>

    <v-toolbar flat color="white">
      <v-toolbar-title>Clientes</v-toolbar-title>
      <v-btn @click="createdFormData">create</v-btn>
      <v-divider
        class="mx-4"
        inset
        vertical
      ></v-divider>
      <v-text-field append-icon="search" label="Buscar" single-line hide-details v-model="search"></v-text-field>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="700px">
        <v-btn slot="activator" color="green" fab small dark class="mb-2"><v-icon>add</v-icon></v-btn>
        
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
            <!-- <cliente-crear></cliente-crear> -->
            <template>
<div class="container-fluid">
    <div class="row">
        <div id="sombra" class="col-md-12">
            <form id="ContactForm" class="ContactForm" @submit.prevent="sendForm">
                        <div class="form-group">
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" v-model="editedItem.nombre" autofocus name="nombre" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="telf">DNI</label>
                                <input type="text" class="form-control" v-model="editedItem.dni" name="dni" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="direccion">Direccion</label>
                                <input type="text" class="form-control" v-model="editedItem.direccion" name="direccion" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" v-model="editedItem.fecha" name="fecha" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="" id="fecha">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="dni">Telf</label>
                                <input type="text" class="form-control" v-model="editedItem.telf" name="telf" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="prestamo">Prestamo</label>
                                <input type="number" class="form-control" v-model="editedItem.prestamo" onkeyup="calcular()" id="prestamo" name="prestamo" placeholder="">
                                <input type="hidden" class="form-control" id="deuda" name="deuda" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="interes">Interes %</label>
                                <input type="number" class="form-control" v-model="editedItem.interes" onkeyup="calcular()" id=interes name="interes" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Monto a Pagar</label>
                                <input type="text" class="form-control" readonly name="monto_a_apagar" id="total" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Dias del prestamo</label>
                                <input type="number" class="form-control" v-model="editedItem.dias" onkeyup="pago_por_dia()" id="dias" name="dias_para_pagar" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Pago por dia</label>
                                <input type="text" class="form-control" readonly id="totaldias" name="pago_dia" placeholder="">
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <!--<input  class="btn btn-success btn-block" value="Guardar">-->
                            <!--<v-btn type="submit" block color="green" dark>Guardar</v-btn>-->
                            <v-btn
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
                            </v-btn>
                            <v-btn color="red darken-1" block flat @click.native="close">Cancel</v-btn>
                            <v-btn @click="createdFormData">create</v-btn>
                        </div>
                        <input type="hidden" name="agregado" value="">
                        <input type="hidden" name="agregado_id" value="">
                        <input type="hidden" name="abono_id" value="0">
                    </form>

        </div>
    </div>
</div>
</template>

          <!--<v-card-text>-->
            <!--<v-container grid-list-md>-->
              <!--<v-layout wrap>-->
                <!--<v-flex xs12 sm6 md4>-->
                  <!--<v-text-field v-model="editedItem.id" label="#"></v-text-field>-->
                <!--</v-flex>-->
                <!--<v-flex xs12 sm6 md4>-->
                  <!--<v-text-field v-model="editedItem.nombre" label="Nombre"></v-text-field>-->
                <!--</v-flex>-->
                <!--<v-flex xs12 sm6 md4>-->
                  <!--<v-text-field v-model="editedItem.dni" label="DNI"></v-text-field>-->
                <!--</v-flex>-->
                <!--<v-flex xs12 sm6 md4>-->
                  <!--<v-text-field v-model="editedItem.telf" label="Telf"></v-text-field>-->
                <!--</v-flex>-->
                <!--<v-flex xs12 sm6 md4>-->
                  <!--<v-text-field v-model="editedItem.deuda" label="Deuda"></v-text-field>-->
                <!--</v-flex>-->
                  <!--<v-flex xs12 sm6 md4>-->
                      <!--<v-text-field v-model="editedItem.dni" label="DNIss"></v-text-field>-->
                  <!--</v-flex>-->
                  <!--<v-flex xs12 sm6 md4>-->
                      <!--<v-text-field v-model="editedItem.telf" label="Telf"></v-text-field>-->
                  <!--</v-flex>-->
                  <!--<v-flex xs12 sm6 md4>-->
                      <!--<v-text-field v-model="editedItem.deuda" label="Deuda"></v-text-field>-->
                  <!--</v-flex>-->
              <!--</v-layout>-->
            <!--</v-container>-->
          <!--</v-card-text>-->

          <v-card-actions>
            <v-spacer></v-spacer>
            <!-- <v-btn color="red darken-1" flat @click.native="close">Cancel</v-btn>
            <v-btn color="blue darken-1" 
                flat
                :loading="loading"
                :disabled="loading"
                  @click="loader = 'loading'"
                  type="submit"
                  black
                                    >Save</v-btn> -->
          </v-card-actions>
        </v-card>
      </v-dialog>
        <!-- <v-btn @click="deleteCliente(160)" color="success">Success</v-btn> -->
    </v-toolbar>
    <!-- <v-card> -->
          <!-- <v-card-text style="height: 300px;" class="grey lighten-5"></v-card-text> -->
          <!-- <v-card-text style="height: 100px; position: relative"> -->
            
          <!-- </v-card-text> -->
        <!-- </v-card> -->
    <v-data-table
      :headers="headers"
      :items="desserts"
      class="elevation-1"
      :search="search"
      :rows-per-page-items="[5,10,20]"
    >
    
      <template slot="items" slot-scope="props">
        <td>{{ props.item.id }}</td>
        <td class="">{{ props.item.nombre }}</td>
        <td class="">{{ props.item.dni }}</td>
        <td class="">{{ props.item.telf }}</td>
        <td class="">{{ props.item.deuda }}</td>
        <td class="justify-center layout px-0">
          <v-icon
            small
            class="mr-2"
            @click="editItem(props.item)"
          >
            edit
          </v-icon>
          <v-icon
            small
            @click="deleteItem(props.item)"
          >
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
    
  </div>
</template>

<script>
  export default {
    data: () => ({
        idedit: "",
        token: "",
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      loading: false,
        dialog: false,
        search: "",
      headers: [
        { text: '#', align: 'left', value: 'id', sortable: true },
        { text: 'Nombre', value: 'nombre' },
        { text: 'DNI', value: 'dni' },
        { text: 'Telf', value: 'telf' },
        { text: 'Deuda', value: 'deuda' },
        { text: 'Actions', value: 'id', sortable: false }
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        nombre: '',
        dni: '',
        telf: '',
        deuda: '',
        nombre: ''
      },
      defaultItem: {
        nombre: '',
        dni: '',
        telf: '',
        deuda: '',
        nombre: ''
      }
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Nuevo Cliente' : 'Editar Cliente'
      },
      envio () {
        return this.editedIndex === -1 ? 'sendForm' : 'editForm'
      }
    },

    watch: {
      dialog (val) {
        val || this.close()
      }
    },

    created () {
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
//      initialize () {
//        this.desserts = [ ]
//      },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
        this.idedit = item.id
        
      },

      deleteItem (item) {
        const index = this.desserts.indexOf(item)
          console.log("Aqui abajo");
          console.log(item.id);
        confirm('Esta seguro que desea borrar esta Cliente?') && this.desserts.splice(index, 1)
          axios
              .delete(`/v1.0/cliente/${item.id}`, {
                  _token : this.csrf
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

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
       if (this.editedIndex > -1) {
        //  edit
        //  Object.assign(this.desserts[this.editedIndex], this.editedItem)
         console.log("aqui 1");
        //  console.log(this.editedItem.id);
       } else {
        //  nuevo
        //  this.desserts.push(this.editedItem)
         console.log("aqui 2");
         alert('NUevo Form')
            let form = document.getElementById('ContactForm'),
                formData = new FormData(form)
                
            axios.post('/v1.0/cliente',formData)
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
        //  console.log(this.editedItem);

       }
        this.close()
      },
      sendForm (){
            axios.put(`/v1.0/cliente/${this.idedit}`,this.createdFormData())
            .then((response) => {
            // this.resultado = response.data
            console.log(response.data);
            })
        },
        createdFormData : function (){
            console.log("SE PRECIONO aqiooooioi");
            var formDa = new FormData();
            for(var key in this.objeto){
                formDa.append(key, this.objeto[key]);
            }
            return formDa;
            console.log(formDa);
            console.log("SE PRECIONO");
        },
        sendForm3(e) {
                alert('Nuusdfsdevo Form')
                let token = this.csrf
                axios.defaults.headers.common['Content-Type'] = 'application/json'
                axios.defaults.headers.common['Authorization'] = 'Basic ' + this.csrf
                console.log(this.csrf);
                let form = document.getElementById('ContactForm'),
                    formData = new FormData(form)
                console.log("entro a editar");
                console.log(formData);
                console.log(this.idedit);
                axios.put(`/v1.0/cliente/${this.idedit}`, formData)
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error => {
                        console.log(error)
                    })
                axios({
                        method: 'put',
                        url: `/v1.0/cliente/${this.idedit}`,
                        data: formData,
                    })
                    .then(function (response) {
                        response.data
                        console.log(response.data);
                    });
                this.close();
            },
            editForm(e) {
                alert('Editar Form')
                let form = document.getElementById('ContactForm'),
                    formData = new FormData(form)
                console.log("entro a editar");
                console.log(formData);
                axios.patch(`/v1.0/cliente/${id}`, formData)
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
        deleteCliente: function (id) {
            console.log("entro a al borrar");
//                this.dialog = true;
            axios
                .delete(`/v1.0/cliente/${id}`, {
                    _token : this.csrf
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