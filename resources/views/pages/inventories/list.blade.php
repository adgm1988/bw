@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Almacén</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Clientes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
        
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="listado" class="display table table-bordered table-striped" width="100%">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Producto</th>
                    <th>Peso (gr)</th>
                    <th>Precio</th>
                    <th>Creación</th>
                    <th>Edición</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($inventories as $inventory)
                <tr>
                  <td>{{$inventory->id_inventory}}</td>
                  <td>{{$inventory->product->product}}</td>
                  <td>{{$inventory->weight}}</td>
                  <td>$ {{($inventory->product->price)*$inventory->weight/100}}</td>
                  <td>{{$inventory->created_at}}</td>
                  <td>{{$inventory->updated_at}}</td>
                @endforeach

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
@endsection

@section('script')
    @include('generals.general_list_script')
@endsection