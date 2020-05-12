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
          <button type="submit"  form="entry_form" class="btn btn-success btn-submit" >
            Guardar
          </button>
        </a>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Modal agregar-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="titulo_modal"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="post">
          <meta name="csrf-token" content="{{ csrf_token() }}"> <!--LO PONGO ASI POR SER EN AJAX-->
          <div class="form-group row">
            <div class="col-3" >
              <label for="id_productroduct">Folio:</label>
              <input type="text" class="form-control hide" id="id_product" name="id_product" disabled>
            </div>
            <div class="col-9">
              <label for="weight">Peso:</label>
              <input type="number" class="form-control" id="weight" name="weight">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="save_entry_detail()">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





<!-- Main content -->
<section class="content" >
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <label for="date">Folio:</label>
              <div>E-{{$entry->id_entry}}</div>
            </div>
            <div class="col-4">
              <label for="date">Fecha:</label>
              <div>{{$entry->date}}</div>
            </div>
            <div class="col-4">
              <label for="note">Nota:</label>
              <div>{{$entry->note}}</div>
            </div>
          </div>
          <br>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <label for="date">Peso:</label>
              <h3>1,395.34 gr</h3>
            </div>
            <div class="col-6">
              <label for="date">Subtotal:</label>
              <h3>$297.24</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-5">
              <label>Categorías</label>
              <div class="btn btn-info product_categories "  data-category="0" style="width:100%" >Todos</div><br><br>
              @foreach($product_categories as $product_category)
              <div class="btn btn-default product_categories " data-category="{{$product_category->id_product_category}}" style="width:100%">{{$product_category->product_category}}</div><br><br>
              @endforeach
            </div>
            <div class="col-7">
              <div class="col-sm">
                <label>Productos</label>
                <div class="row">
                  @foreach($products as $product)
                  <div class="btn btn-danger products m-2 col-5" data-id_product="{{$product->id_product}}" data-product="{{$product->product}}" data-category="{{$product->id_product_category}}" style="width:100%">{{$product->product}}</div>
                @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12">

              @foreach($products_detail as $product)
                  <div class="card">
                    <div class="card-header bg-light font-weight-bold p-1">
                      <div class="row ">
                        <div class="col-8">{{$product->product}}</div>
                        <div class="col-2"></div>
                        <div class="col-2"></div>
                      </div>
                    </div>
                    <ul class="list-group list-group-flush">
                      @foreach($entry_details as $entry_detail)
                        @if($product->id_product == $entry_detail->inventory->id_product)
                          <li class="list-group-item col-12 p-0">
                            <div class="row">
                              <div class="col-9 pl-5">00{{$entry_detail->inventory->id_inventory}} - {{$entry_detail->inventory->product->product}} </div>
                              <div class="col-3 ">{{$entry_detail->inventory->weight}} gr</div>
                            </div>
                          </li>
                        @endif
                      @endforeach
                      
                    </ul>
                  </div>
              @endforeach

              

            </div>
          </div>
        </div>
      </div>
    </div>


  </section>
  <!-- /.content -->

  @endsection

  @section('script')
  <script>
    var products = $(".products");
    var categories = $(".product_categories");

    categories.click(function() {
      ocultar_productos($(this).data('category'));

      categories.each(function(){
        $(this).removeClass("btn-info");
        $(this).addClass("btn-default");
      });
      $(this).removeClass("btn-default");
      $(this).addClass("btn-info");
    });

    var ocultar_productos = function(id_category){
      if(id_category==0){
        products.each(function(){
          $(this).show();
        })
      }else{
        products.each(function(){
          if($(this).data('category')!=id_category){
            $(this).hide();
          }else{
            $(this).show();
          }
        });
      }
    }

    products.click(function(){
      $('#id_product').val($(this).data('id_product'));
      $('#titulo_modal').text($(this).data('product'));
      $('#myModal').modal('show');
    })


    /***EMPIEZA EL SAVE DE DETALLE**/
    $.ajaxSetup({
      headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    var save_entry_detail = function(){

      var id_product = $("input[name=id_product]").val();
      var weight = $("input[name=weight]").val();
      var id_entry = {{$entry->id_entry}};

      $.ajax({
       dataType: 'json',
       type:'POST',
       url:'{{ url("entries/saveEntryDetail") }}',
       data:{id_product:id_product, weight:weight, id_entry:id_entry},

       success:function(data){

        if(!data.response){
          alert('Error al guardar');
        }else{
          location.reload();
        }
      }

    });



    };
  /**TERMINA SAVE DE DETALLE**/



  </script>

@endsection