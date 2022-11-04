<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar">
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="{{ url('/dashboard') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Inicio</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="pcoded-hasmenu">
                <a href="{{ url('/profile') }}">
                    <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                    <span class="pcoded-mtext">Perfil</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            {{-- <li class="pcoded-hasmenu">
                <a href="{{ url('/invoices') }}">
                    <span class="pcoded-micon"><i class="ti-clipboard"></i></span>
                    <span class="pcoded-mtext">Facturas</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li> --}}
            <li class="pcoded-hasmenu">
                <a href="{{ url('/wallet') }}">
                    <span class="pcoded-micon"><i class="ti-wallet"></i></span>
                    <span class="pcoded-mtext">Billetera</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            {{-- <li class="pcoded-hasmenu">
                <a href="{{ url('/wallet/register') }}">
                    <span class="pcoded-micon"><i class="ti-wallet"></i></span>
                    <span class="pcoded-mtext">Registro</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>--}}
            <li class="pcoded-hasmenu">
                <a href="{{ url('/tickets') }}">
                    <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                    <span class="pcoded-mtext">Ticket</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="pcoded-hasmenu">
                <a href="{{ url('/donate') }}">
                    <span class="pcoded-micon"><i class="feather icon-heart"></i></span>
                    <span class="pcoded-mtext">Donativos</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </div>
</nav>