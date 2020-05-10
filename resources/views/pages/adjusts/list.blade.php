@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajustes</h1>
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
                    <th>Fecha</th>
                    <th>Nota</th>
                    <th>Creación</th>
                    <th>Edición</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($adjusts as $adjust)
                <tr>
                  <td>{{$adjust->id_adjust}}</td>
                  <td>{{$adjust->date}}</td>
                  <td>{{$adjust->note}}</td>
                  <td>{{$adjust->created_at}}</td>
                  <td>{{$adjust->updated_at}}</td>
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