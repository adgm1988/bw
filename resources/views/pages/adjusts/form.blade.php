@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajuste de :  00{{$inventory->id_inventory}} {{$inventory->product->product}} {{$inventory->weight}} gr</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{url('inventories')}}">
              <button type="button" class="btn btn-secondary">
                Cancelar
              </button>
            </a>
            <a href="#">
              <button type="submit"  form="adjust_detail_form" class="btn btn-success" >
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
              <form id="adjust_detail_form" action="{{url('/adjust_details/store/'.$inventory->id_inventory)}}" method="post">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-5">
                    <label  for="reason">Razón:</label>
                    <select class="form-control" name="reason" id="reason">
                      <option value="merma">Merma</option>
                      <option value="muestra">Muestra</option>
                      <option value="promoción">Promoción</option>
                      <option value="otro">Otro</option>

                    </select>
                  </div>
                  <div class="col-7">
                    <label for="note">Nota:</label>
                    <textarea class="form-control" id="note" name="note" rows="3"></textarea>
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