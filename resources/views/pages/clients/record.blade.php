@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Clientes</h1>
      </div>
      <div class="col-sm-6 text-right">
        <a href="{{url('clients')}}">
          <button type="button" class="btn btn-secondary">
            Cancelar
          </button>
        </a>
        <a href="#">
          <button type="submit"  form="sale_form" class="btn btn-primary" >
            Editar
          </button>
        </a>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-3">
              <label>Nombre:</label>
              <div>{{$client->name}}</div>
            </div>
            <div class='col-3'>
              <label for="cellphone">Celular</label>
              <div>{{$client->cellphone}}</div>
            </div>
            <div class="col-3">
              <label for="mail">Correo</label>
              <div>{{$client->email}}</div>
            </div>
            <div class="col-3">
              <label for="origin">Procedencia</label>
              <div>{{$client->origin->origin}}</div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-6">
              <label for="note">Nota</label>
              <div>{{$client->notes}}</div>
            </div>
            <div class="col-6">
              <label for="address">Dirección</label>
              <div>{{$client->address}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="true">Ventas</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="false">Pagos</a>
    </li>
    
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="sales" role="tabpanel" aria-labelledby="sales-tab">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="listado" class="display table table-bordered table-striped" width="100%">
                <thead>
                  <tr>
                    <th></th>
                    <th>id</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Nota</th>
                    <th>Creación</th>
                    <th>Edición</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($client->sales as $sale)
                  <tr>
                    <td> 
                      <a href="{{url('sales/'.$sale->id_sale)}}" target='_blank'><i class="fas fa-eye"></i></a>
                    </td>
                    <td>{{$sale->id_sale}}</td>
                    <td>{{$sale->date}}</td>
                    <td>$ {{number_format($sale->sale_details->sum('sale_price'))}}</td>
                    <td>{{$sale->client->note}}</td>
                    <td>{{$sale->created_at}}</td>
                    <td>{{$sale->updated_at}}</td>
                  </tr>
                  @endforeach
                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div>
    <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
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
                @foreach($client->payments as $payment)
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
      </div>
    </div>
  </div>


</section>
<!-- /.content -->

@endsection

@section('script')
@endsection