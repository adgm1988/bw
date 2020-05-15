@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Entradas</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="/entries/create">
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
                    <th>Fecha</th>
                    <th>Nota</th>
                    <th>Creación</th>
                    <th>Edición</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($entries as $entry)
                <tr>
                  <td>
                    <a href="{{url('entries/'.$entry->id_entry)}}"><i class="fas fa-eye"></i></a>
                  </td>
                  <td>{{$entry->id_entry}}</td>
                  <td>{{$entry->date}}</td>
                  <td>{{$entry->note}}</td>
                  <td>{{$entry->created_at}}</td>
                  <td>{{$entry->updated_at}}</td>
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