
            @if(auth()->user()->user_id == 1)
                <nav-bar-admin :user="{{ auth()->user() }}"></nav-bar-admin>
                {{--<li class=""><a href="/cliente">Clientes <span class="sr-only">(current)</span></a></li>--}}
                {{--<li class=""><a href="/pago_admin">Control <span class="sr-only">(current)</span></a></li>--}}
                {{--<!-- <li class=""><a href="/control_admin">Control <span class="sr-only">(current)</span></a></li> -->--}}
                {{--<li class=""><a href="/report">Reportes <span class="sr-only">(current)</span></a></li>--}}
                {{--<li class=""><a href="/pendiente">Pendientes <span class="sr-only">(current)</span></a></li>--}}
                {{--<!-- <li><a href="#">Barberias</a></li> -->--}}
                {{--<li><a href="/user">Colaborador</a></li>--}}
                <!-- <li class=""><a href="/nomina">Cierre de Caja <span class="sr-only">(current)</span></a></li> -->
            @else
                <nav-bar-user :user="{{ auth()->user() }}"></nav-bar-user>
                {{--<li class=""><a href="/cliente">Clientes <span class="sr-only">(current)</span></a></li>--}}
                {{--<li class=""><a href="/control">Pagos <span class="sr-only">(current)</span></a></li>--}}
                {{--<li class=""><a href="/pago">Control <span class="sr-only">(current)</span></a></li>--}}
                {{--<li class=""><a href="/cierre">Contabilidad <span class="sr-only">(current)</span></a></li>--}}
            @endif
