@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Venta</h1>
      </div>
      <div class="col-sm-6 text-right">
        <a href="{{url('sales')}}">
          <button type="button" class="btn btn-secondary">
            Cancelar
          </button>
        </a>
        <a href="#">
          <button  class="btn btn-info btn-submit" id="agregar_pagos">
            Agregar Pagos
          </button>
        </a>
        <a href="#">
          <button type="submit"  form="sale_form" class="btn btn-success btn-submit" >
            Guardar
          </button>
        </a>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Modal agregar producto-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row" style="width:100%">
          <div class="col-6">
            <h4 class="modal-title" id="titulo_modal"></h4>
          </div>
          <div class="col-6">
            <h4 class id="precio_modal"></h4>
          </div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="post">
          <meta name="csrf-token" content="{{ csrf_token() }}"> <!--LO PONGO ASI POR SER EN AJAX-->
          <div class="form-group row mb-0">
            <div class="col-2" >
              <label for="id_sale">Venta:</label>
            </div>
            <div class="col-5" >
              <label for="weight">Peso:</label>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-2" >
              <input type="text" class="form-control" id="id_sale" name="id_sale" value="{{ $sale->id_sale }}" disabled>
              <input type="text" class="form-control d-none" id="id_product" name="id_product" value="" disabled>
            </div>
            <div class="col-5">
              <input type="number" class="form-control" id="weight" name="weight" onkeyup="actualizar_lista()" >
            </div>
          </div>
          <div class="form-group row">
            <div class="col-1">
            </div>
            <div class="col-10">
            <table class="table table-hover">
              <thead>
              <tr>
                <th>Inventario</th>
                <th>Peso</th>
                <th>Precio</th>
              </tr>
              </thead>
              <tbody id="inventory_options">
                
              </tbody>
            </table>
            </div>
            <div class="col-1">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal agregar pago-->
<div class="modal fade" id="modal_pago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row" style="width:100%">
          <div class="col-6">
            <h4 class="modal-title" id="titulo_modal"></h4>
          </div>
          <div class="col-6">
            <h4 class id="precio_modal"></h4>
          </div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="post">
          <meta name="csrf-token" content="{{ csrf_token() }}"> <!--LO PONGO ASI POR SER EN AJAX-->
          <div class="form-group row mb-0">
            <div class="col-4" >
              <label for="id_sale">Forma de pago</label>
            </div>
            <div class="col-4" >
              <label for="id_sale">Fecha</label>
            </div>
            <div class="col-4" >
              <label for="amount">Monto</label>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
              <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-4" >
              <select class="form-control" name="id_payment_type" id="id_payment_type">
                @foreach($payment_types as $payment_type)
                  <option value="{{$payment_type->id_payment_type}}">{{$payment_type->payment_type}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-4">
              <input type="number" class="form-control" id="amount" name="amount">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" data-dismiss="modal" id="guardar_pago">Guardar</button>
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
              <div>V-{{$sale->id_sale}}</div>
            </div>
            <div class="col-4">
              <label for="date">Fecha:</label>
              <div>{{$sale->date}}</div>
            </div>
            <div class="col-4">
              <label for="note">Nota:</label>
              <div>{{$sale->note}}</div>
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
            <div class="col-4">
              <label for="date">Peso:</label>
              <h3>{{ $total_weight }} gr</h3>
            </div>
            <div class="col-4">
              <label for="date">Subtotal:</label>
              <h3>${{ number_format($sale->sale_details->sum('sale_price')) }}</h3>
            </div>
            <div class="col-4">
              <label for="date">Pendiente:</label>
              <h3>${{ number_format($sale->sale_details->sum('sale_price') - $sale->payments->sum('amount')) }}</h3>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-12">
              <ul class="list-group list-group-flush">
                @foreach($payments as $payment)
                <li class="list-group-item col-12 p-0">
                  <div class="row">
                    <div class="col-5 ">{{$payment->payment_type->payment_type}}</div>
                    <div class="col-5 ">$ {{$payment->amount}}</div>
                    <div class="col-2 "><a href={{ url('sales/deletePayment/'. $payment->id_payment)}}><i class="fas fa-minus-circle text-danger"></i></a></div>
                  </div>
                </li>
                @endforeach

              </ul>
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
                  <div class="btn btn-danger products m-2 col-5" data-id_product="{{$product->id_product}}" data-product="{{$product->product}}"  data-price="{{$product->price}}" data-category="{{$product->id_product_category}}" style="width:100%">{{$product->product}}</div>
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
                      @foreach($sale_details as $sale_detail)
                        @if($product->id_product == $sale_detail->inventory->id_product)
                          <li class="list-group-item col-12 p-0">
                            <div class="row">
                              <div class="col-5 pl-5">00{{$sale_detail->inventory->id_inventory}} - {{$sale_detail->inventory->product->product}}</div>
                              <div class="col-3 ">{{$sale_detail->inventory->weight}} gr</div>
                              <div class="col-3 ">$ {{$sale_detail->sale_price}}</div>
                              <div class="col-1 "><a href={{ url('sales/deleteSaleDetail/'. $sale_detail->id_sale_details)}}><i class="fas fa-minus-circle text-danger"></i></a></div>
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



        var actualizar_lista = function(){
         var weight = $("input[name=weight]").val();
         var opciones = $(".option_row");
         

         if (weight == 0){

          opciones.each(function(){
             $(this).parent().show();
           });

         }else{

           opciones.each(function(){

                if(((this.innerHTML*1)> (1.1*weight)) || ((this.innerHTML*1)< (.9*weight))){
                  $(this).parent().hide();
                }else{
                  $(this).parent().show();
                }
          });


       }
     }


     $.ajaxSetup({
      headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });


     products.click(function(){
      $('#inventory_options').empty();
      $('#id_product').val($(this).data('id_product'));
      $('#titulo_modal').text($(this).data('product'));
      $('#precio_modal').text($(this).data('price'));

       var id_product = $(this).data('id_product');
       var price = $(this).data('price');


      $.ajax({
       dataType: 'json',
       type:'POST',
       url:'{{ url("sales/getDetailOptions") }}',
       data:{id_product:id_product},

       success:function(data){

        if(!data){
          alert('Error al guardar');
        }else{
          var filas_opciones;

          $.each(data, function() {

              filas_opciones += "<tr style='cursor:pointer;' onclick='save_sale_detail("+this.id_inventory+","+this.weight*price/1000+")'><td>"+this.id_inventory+"</td><td class='option_row'>"+this.weight+"</td><td>$ "+(this.weight*price/1000).toFixed(2)+"</td></tr>";
          });

          $('#inventory_options').append(filas_opciones);       
        }
      }

    });

      $('#myModal').modal('show');
    })


    /***EMPIEZA EL SAVE DE DETALLE**/
    

    var save_sale_detail = function(id_inventory,sale_price){

      var price = $('#precio_modal').text();
      var id_sale = {{$sale->id_sale}};

      $.ajax({
       dataType: 'json',
       type:'POST',
       url:'{{ url("sales/saveSaleDetail") }}',
       data:{id_inventory:id_inventory, id_sale:id_sale, sale_price:sale_price},

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


//*Registrar pagos*/
$('#agregar_pagos').click(function(){
  $('#modal_pago').modal('show');
});

$('#guardar_pago').click(function(){
  var id_sale = {{$sale->id_sale}};
  var amount =  $("input[name=amount]").val();
  var date =  $("input[name=date]").val();
  var id_payment_type = $( "select#id_payment_type option:checked" ).val();

  $.ajax({
       dataType: 'json',
       type:'POST',
       url:'{{ url("sales/savePayment") }}',
       data:{id_sale:id_sale, amount:amount, date:date, id_payment_type: id_payment_type},

       success:function(data){

        if(!data.response){
          alert('Error al guardar');
        }else{
          location.reload();
        }
      }

    });


})

  </script>

@endsection