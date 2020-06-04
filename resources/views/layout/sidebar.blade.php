<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{url('img/bw_logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">BW Top Beef</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar text-sm nav-flat">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('img/user_mau.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">          
          <li class="nav-header">Módulos</li>
          <li class="nav-item">
            <a href="{{ url('sales') }}" class="nav-link">
              <i class="nav-icon fas fa-handshake"></i>
              <p>
                Ventas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('clients') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Clientes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('entries') }}" class="nav-link">
              <i class="nav-icon fas fa-door-open"></i>
              <p>
                Entradas
              </p>
            </a>
          </li>
          <!--
          <li class="nav-item">
            <a href="{{ url('adjusts') }}" class="nav-link">
              <i class="nav-icon fas fa-sliders-h"></i>
              <p>
                Ajustes
              </p>
            </a>
          </li>
        -->
          <li class="nav-item">
            <a href="{{ url('inventories') }}" class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Almacén
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('reports') }}" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                BI
              </p>
            </a>
          </li>
        </ul>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Historiales</li>
          <li class="nav-item">
            <a href="{{ url('sale_details') }}" class="nav-link">
              <i class="nav-icon fas fa-handshake"></i>
              <p>
                Detalles de venta
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('payments') }}" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Pagos Clientes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('entry_payments') }}" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Pagos Proveedor
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('entry_details') }}" class="nav-link">
              <i class="nav-icon fas fa-door-open"></i>
              <p>
                Detalles de entrada
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('adjust_details') }}" class="nav-link">
              <i class="nav-icon fas fa-sliders-h"></i>
              <p>
                Detalles de ajuste
              </p>
            </a>
          </li>
        </ul>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Catálogos</li>
          <li class="nav-item">
            <a href="{{ url('product_categories') }}" class="nav-link">
              <i class="nav-icon fas fa-drumstick-bite"></i>
              <p>
                Categorías de producto
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('products') }}" class="nav-link">
              <i class="nav-icon fas fa-drumstick-bite"></i>
              <p>
                Productos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('payment_types') }}" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Formas de pago
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('origins') }}" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Origenes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('users') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>