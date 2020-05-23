@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pagos</h1>
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
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Forma de pago</th>
                    <th>Creación</th>
                    <th>Edición</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                <tr>
                  <td>{{$payment->id_payment}}</td>
                  <td>{{$payment->sale->id_sale}} - {{$payment->sale->client->name}} ({{$payment->sale->date}})</td>
                  <td>{{$payment->date}}</td>
                  <td>${{$payment->amount}}</td>
                  <td>{{$payment->payment_type->payment_type}}</td>
                  <td>{{$payment->created_at}}</td>
                  <td>{{$payment->updated_at}}</td>
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