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
            <a href="{{url('entries')}}">
              <button type="button" class="btn btn-secondary">
                Cancelar
              </button>
            </a>
            <a href="#">
              <button type="submit"  form="entry_form" class="btn btn-success" >
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
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form id="entry_form" action="{{url('/entries/store')}}" method="post">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-3">
                    <label for="date">Folio:</label>
                    <input class="form-control" type="text" id="nuevo_id" name="nuevo_id" value="{{ $nuevo_id }}" disabled>
                <br>  
                    <label for="date">Fecha:</label>
                    <input class="form-control" type="date" id="date" name="date" value="{{ date('Y-m-d') }}">
                  </div>
                  <div class="col-9">
                    <label for="note">Nota:</label>
                    <textarea class="form-control" name="note" id="note" cols="30" rows="5"></textarea>
                  </div>
                </div>
                <br>
              </form>
            </div>
          </div>
        </div>
      </div>


    </section>
    <!-- /.content -->
    
@endsection

@section('script')
@endsection