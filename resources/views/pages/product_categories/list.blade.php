@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categorías de producto</h1>
          </div>
          <div class="col-sm-6 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              Agregar
            </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Agregar categoría de producto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form action="{{url('product_categories/store')}}" method="post">
              {{ csrf_field() }}
              <div class="form-group row">
                <div class="col-12">
                  <label for="product_category">Categoría de producto:</label>
                  <input type="text" class="form-control" id="product_category" name="product_category">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" >Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

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
                    <th>Categoría</th>
                </thead>
                <tbody>
                @foreach($product_categories as $product_category)
                <tr>
                  <td>{{$product_category->id_product_category}}</td>
                  <td>{{$product_category->product_category}}</td>
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