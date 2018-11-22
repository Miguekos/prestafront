<form id="ContactForm" class="ContactForm" @submit="save">
                                        <div class="form-group">
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" name="nombre" class="form-control" v-model="editedItem.nombre"
                                                    autofocus placeholder="">
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
                                        <input type="hidden" name="abono_id" v-model="abono_id" value="0">
                                        <input type="hidden" name="_token" v-model="csrf" value="token">

                                    </form>