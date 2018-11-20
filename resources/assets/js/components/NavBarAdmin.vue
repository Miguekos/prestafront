<template>
    <div>
        <v-toolbar dense color="blue lighten-1" dark>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>

            <v-toolbar-title>Prestamos</v-toolbar-title>

            <v-divider class="mx-3" inset vertical></v-divider>

            <span class="subheading">Admin</span>

            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down">
                <v-btn @click="clientes()" flat>Cliente</v-btn>
                <v-divider inset vertical></v-divider>
                <v-btn @click="control()" flat>Control</v-btn>
                <v-divider inset vertical></v-divider>
                <v-btn @click="reporte()" flat>Reporte</v-btn>
                <v-divider inset vertical></v-divider>
                <v-btn @click="usuarios()" flat>Usuarios</v-btn>
                <v-menu bottom origin="center center" transition="scale-transition" offset-y>
                    <v-btn slot="activator" color="primary" dark>
                        {{ user.name }}
                    </v-btn>
                    <v-list>
                        <v-list-tile>
                            <v-list-tile-title>{{ user.name }}</v-list-tile-title>
                        </v-list-tile>
                        <v-list-tile @click="logout()">
                            <v-list-tile-title>Salir</v-list-tile-title>
                        </v-list-tile>
                    </v-list>
                </v-menu>
            </v-toolbar-items>
        </v-toolbar>


        <v-navigation-drawer v-model="drawer" :mini-variant="mini" absolute temporary>

            <v-list-tile avatar tag="div">
                <v-list-tile-avatar>
                    <img src="https://randomuser.me/api/portraits/men/85.jpg">
                </v-list-tile-avatar>


                <v-list-tile-title>{{ user.name }}</v-list-tile-title>

            </v-list-tile>


            <v-list class="pt-0" dense>
                <v-divider light></v-divider>

                <v-list-tile @click="home()">
                    <v-list-tile-action>
                        <v-icon>dashboard</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>Home</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

                <v-list-tile @click="clientes()">
                    <v-list-tile-action>
                        <v-icon>dashboard</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>Cliente</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

                <v-list-tile @click="control()">
                    <v-list-tile-action>
                        <v-icon>dashboard</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>Control</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

                <v-list-tile @click="reporte()">
                    <v-list-tile-action>
                        <v-icon>dashboard</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>Reporte</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

                <v-list-tile @click="usuarios()">
                    <v-list-tile-action>
                        <v-icon>dashboard</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>Usuarios</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

                <v-divider light></v-divider>

                <v-list-tile @click="logout()">
                    <v-list-tile-action>
                        <v-icon>dashboard</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>Salir</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

            </v-list>
        </v-navigation-drawer>

    </div>
</template>
<pre>{{ $data }}</pre>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                drawer: null,
                mini: false,
                right: null,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        created() {
        },
        methods: {
            logout: function () {
                console.log("entro a al logout");
                //                this.dialog = true;
                axios
                    .post(`/logout`, {
                        _token: this.csrf
                    })
                    .then(response => {
                        window.location.href = '/';
                        // JSON responses are automatically parsed.
                        //                        this.user = response.data;
                        //                        console.log(response.data);
                    })
                    .catch(e => {
                        //                        this.errors.push(e);
                    });
            },
            home: function () {
                window.location.href = '/';
            },
            clientes: function () {
                window.location.href = '/cliente';
            },
            control: function () {
                window.location.href = '/control';
            },
            reporte: function () {
                window.location.href = '/report';
            },
            usuarios: function () {
                window.location.href = '/user';
            },
        },
    };
</script>