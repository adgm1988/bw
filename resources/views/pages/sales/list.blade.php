@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ventas</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="/sales/create">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              Agregar
            </button>
            </a>
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
                    <th></th>
                    <th>id</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Nota</th>
                    <th>Creción</th>
                    <th>Edición</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                <tr>
                  <td> 
                    <a href="{{url('sales/'.$sale->id_sale)}}"><i class="fas fa-eye"></i></a>
                  </td>
                  <td>{{$sale->id_sale}}</td>
                  <td>{{$sale->date}}</td>
                  <td>{{$sale->client->name}}</td>
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
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
@endsection

@section('script')
    @include('generals.general_list_script');
@endsection