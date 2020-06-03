@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Productos</h1>
          </div>
          <div class="col-sm-6 text-right">
            <button type="button" class="btn btn-primary" onclick="showmodal()">
              Agregar
            </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!--modal agregar-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-t
        itle" id="myModalLabel">Agregar Producto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="{{url('products/store')}}" method="post">
          {{ csrf_field() }}

          <div class="form-group row">
            <div class="col-6">
              <label for="id_product_category">Categoría:</label>
              <select class="form-control"  id="id_product_category" name="id_product_category">
                @foreach($product_categories as $product_category)
                  <option value="{{$product_category->id_product_category}}">{{$product_category->product_category}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-6">
              <label for="product">Producto:</label>
              <input type="text" class="form-control" id="product" name="product">
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <label for="costo">Costo:</label>
              <input type="number" class="form-control" id="cost" name="cost">
            </div>
            <div class="col-6">
              <label for="price">Precio:</label>
              <input type="number" class="form-control" id="price" name="price">
            </div>
          </div>

          <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!--modal editar-->
<div class="modal fade" id="myModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-t
        itle" id="myModalLabel">Agregar Producto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="{{url('products/update')}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" id="id_product" name="e_id_product" >
          <div class="form-group row">
            <div class="col-6">
              <label for="id_product_category">Categoría:</label>
              <select class="form-control"  id="e_id_product_category" name="e_id_product_category">
                @foreach($product_categories as $product_category)
                  <option value="{{$product_category->id_product_category}}">{{$product_category->product_category}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-6">
              <label for="product">Producto:</label>
              <input type="text" class="form-control" id="product" name="e_product">
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <label for="costo">Costo:</label>
              <input type="number" class="form-control" id="cost" name="e_cost">
            </div>
            <div class="col-6">
              <label for="price">Precio:</label>
              <input type="number" class="form-control" id="price" name="e_price">
            </div>
          </div>

          <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

    <section class="content">
      <div class="row">
        <div class="col-12">
        
          <div class="card">
            <div class="card-body">
              <table width="100%" id="listado" class="display table table-bordered table-striped" width="100%">
                <thead>
                  <tr>
                    <th></th>
                    <th>id</th>
                    <th>Categoría</th>
                    <th>Producto</th>
                    <th>Costo</th>
                    <th>Precio</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                <tr>
                  <td> 
                    <div class="text-primary" onclick="edit({{$product->id_product}})"><i class="fas fa-edit"></i></a>
                  </td>
                  <td>{{$product->id_product}}</td>
                  <td>{{$product->product_category->product_category}}</td>
                  <td>{{$product->product}}</td>
                  <td>${{$product->cost}}</td>
                  <td>${{$product->price}}</td>
                </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    
@endsection

@section('script')
   @include('generals.general_list_script')
   <script>
    var edit = function(id){
      var url_dir = "products/ajaxget/"+id;
      $.ajax({
       dataType: 'json',
       type:'GET',
       url:url_dir,

       success:function(data){       
        if(!data){
          alert('Error');
        }else{
          console.log(data.id_product_category);
          $('input[name=e_id_product]').val(data.id_product);
          $('input[name=e_product]').val(data.product);
          $('input[name=e_cost]').val(data.cost);
          $('input[name=e_price]').val(data.price);
          $("#e_id_product_category").val(data.id_product_category);
        }
        }
      });

      $('#myModaledit').modal('show');
    }

    var showmodal = function(){
      $('input[name=product]').val("");
      $('input[name=cost]').val("");
      $('input[name=price]').val("");
      $("#id_product_category").val("");
      $('#myModal').modal('show');
    }

   </script>
@endsection


