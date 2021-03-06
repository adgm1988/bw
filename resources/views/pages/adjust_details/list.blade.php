@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clientes</h1>
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
              <table id="listado" class="display table table-bordered table-striped" width=100%>
                <thead>
                  <tr>
                    <th></th>
                    <th>id</th>
                    <th>Ajuste</th>
                    <th>Inventario</th>
                    <th>Razón</th>
                    <th>Nota</th>
                    <th>Creación</th>
                    <th>Edición</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($adjust_details as $adjust_details)
                <tr>
                  <td> 
                    <a href="{{url('adjust_details/delete/'.$adjust_details->id_adjust_detail)}}"><i class="fas fa-trash"></i></a>
                  </td>
                  <td>{{$adjust_details->id_adjust_detail}}</td>
                  <td>{{$adjust_details->id_adjust}}</td>
                  <td>{{$adjust_details->inventory->id_inventory}} - {{$adjust_details->inventory->product->product}} - {{$adjust_details->inventory->weight}}gr</td>
                  <td>{{$adjust_details->reason}}</td>
                  <td>{{$adjust_details->note}}</td>
                  <td>{{$adjust_details->created_at}}</td>
                  <td>{{$adjust_details->updated_at}}</td>
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