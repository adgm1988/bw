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
            <a href="{{url('/sales')}}">
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">
                Cancelar
              </button>
            </a>
            <a href="{{url('/sales/create')}}">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                Guardar
              </button>
            </a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <form id="sale_form">
                <div class="row">
                   <div class="col-6">
                     <label for="id_client">Cliente:</label>
                     <input class="form-control" name="id_client" id="id_client" type="text">
                    </div>  
                    <div class="col-6">
                     <label for="id_client">Fecha:</label>
                     <input class="form-control" name="id_client" id="date" type="date" value="{{ date('Y-m-d') }}">
                   </div>
                 </div>
                 <div class="row">
                  <div class="col-12">
                     <label for="note">Nota:</label>
                     <textarea class="form-control" name="note" id="note" cols="30" rows="4"></textarea>
                   </div>
                 </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <form id="sale_form">
                <div class="row">
                   <div class="col-6">
                     <label for="id_client">Cliente:</label>
                     <input class="form-control" name="id_client" id="id_client" type="text">

                     <label for="id_client">Fecha:</label>
                     <input class="form-control" name="id_client" id="date" type="date" value="{{ date('Y-m-d') }}">
                   </div>
                  <div class="col-6">
                     <label for="note">Nota:</label>
                     <textarea class="form-control" name="note" id="note" cols="30" rows="4"></textarea>
                   </div>
                 </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
    
@endsection

@section('script')
    <script>
      $(document).ready(function() {
        $('#listado').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        } );
      } );
    </script>
@endsection