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
            <a href="/clients/create">
            <button type="button" class="btn btn-primary">
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
                    <th>Nombre</th>
                    <th>Celular</th>
                    <th>Correo</th>
                    <th>Procedencia</th>
                    <th>Dirección</th>
                    <th>Notas</th>
                    <th>Creación</th>
                    <th>Edición</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                <tr>
                  <td> 
                    <a href="{{url('clients/'.$client->id_client)}}"><i class="fas fa-eye"></i></a>
                  </td>
                  <td>{{$client->id_client}}</td>
                  <td>{{$client->name}}</td>
                  <td>{{$client->cellphone}}</td>
                  <td>{{$client->email}}</td>
                  <td>{{$client->origin->origin}}</td>
                  <td>{{$client->address}}</td>
                  <td>{{$client->notes}}</td>
                  <td>{{$client->created_at}}</td>
                  <td>{{$client->updated_at}}</td>
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