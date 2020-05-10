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
            <a href="{{url('/sales')}}">
              <button type="button" class="btn btn-secondary">
                Cancelar
              </button>
            </a>
            <a href="#">
              <button type="submit"  form="sale_form" class="btn btn-success" >
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
              <form id="sale_form" action="{{url('/clients/store')}}" method="post">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-3">
                    <label for="name">Nombre:</label>
                    <input class="form-control" type="text" id="name" name="name">
                  </div>
                  <div class="col-3">
                    <label for="cellphone">Celular:</label>
                    <input class="form-control" type="text" id="cellphone" name="cellphone">
                  </div>

                  <div class="col-3">
                    <label for="email">Correo:</label>
                    <input class="form-control" type="email" id="email" name="email">
                  </div>
                  <div class="col-3">
                    <label for="id_origin">Procedencia:</label>
                    <select class="form-control" name="id_origin" id="id_origin">
                      @foreach($origins as $origin)
                        <option value="{{$origin->id_origin}}">{{$origin->origin}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-6">
                     <label for="adress">Dirección:</label>
                     <textarea class="form-control" name="address" id="note" cols="30" rows="4"></textarea>
                   </div>
                   <div class="col-6">
                     <label for="note">Nota:</label>
                     <textarea class="form-control" name="notes" id="note" cols="30" rows="4"></textarea>
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
@endsection