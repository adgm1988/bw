@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pagos entradas</h1>
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
                    <th>Entrada</th>
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
                  <td>{{$payment->id_entry_payment}}</td>
                  <td>{{$payment->id_entry}}  ({{$payment->entry->date}})</td>
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