<template>
    <v-app id="inspire">
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Login form</v-toolbar-title>
                                <v-spacer></v-spacer>
                                <v-tooltip bottom>
                                    <v-btn slot="activator" :href="source" icon large target="_blank">
                                        <v-icon large>code</v-icon>
                                    </v-btn>
                                    <span>Source</span>
                                </v-tooltip>
                                <v-tooltip right>
                                    <v-btn slot="activator" icon large href="https://codepen.io/johnjleider/pen/wyYVVj"
                                        target="_blank">
                                        <v-icon large>mdi-codepen</v-icon>
                                    </v-btn>
                                    <span>Codepen</span>
                                </v-tooltip>
                            </v-toolbar>
                            <v-form id="LoginForm" @submit.prevent="entrar">
                                <v-card-text>

                                    <v-text-field prepend-icon="person" v-model="email" name="email" label="Email" type="email"></v-text-field>
                                    <v-text-field id="password" prepend-icon="lock" v-model="password" name="password" label="Password"
                                        type="password"></v-text-field>

                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="primary" type="submit">Login</v-btn>
                                </v-card-actions>
                            </v-form>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
        <pre>{{ $data }}</pre>
    </v-app>
</template>

<script>
    export default {
        data: () => ({
            drawer: null,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            email:"",
            password: ""
        }),

        props: {
            source: String
        },
        methods: {
            login(e) {
                console.log("aqui LOGIN");
                //                alert('Enviando Form')
                //                this.snackbar= true
                let form = document.getElementById('LoginForm'),
                    formData = new FormData(form)

                axios.post('/login',
                        this.csrf,
                        formData
                    )
                    .then(response => {
                        console.log(response)
                        console.log("Se loguea correctamente");

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
            },
            entrar: function () {
                axios.post('/v1.0/login', {
                        email: this.email,
                        password: this.password,
                        _token: this.csrf
                    })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>