@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detalle de venta</h1>
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
                    <th>Venta</th>
                    <th>Producto</th>
                    <th>Peso</th>
                    <th>Precio</th>
                    <th>Creación</th>
                    <th>Edición</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($sale_details as $sale_details)
                <tr>
                  <td>{{$sale_details->id_sale_details}}</td>
                  <td>{{$sale_details->id_sale}}</td>
                  <td>{{$sale_details->inventory->product->product}}</td>
                  <td>{{$sale_details->inventory->weight}} gr</td>
                  <td> calculado y guardado al vender</td>
                  <td>{{$sale_details->created_at}}</td>
                  <td>{{$sale_details->updated_at}}</td>
                </tr>
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