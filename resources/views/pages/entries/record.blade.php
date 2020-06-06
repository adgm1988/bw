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
          <button  class="btn btn-info btn-submit" id="agregar_pagos">
            Agregar Pagos
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
              <div>E-{{$entry->id_entry}}</div>
              <div>{{$entry->cost}}</div>
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
            <div class="col-3">
              <label for="date">Peso (gr):</label>
              <h4>{{ $total_weight}}</h4>
            </div>
            <div class="col-3">
              <label for="date">Costo:</label>
              <h4>$ {{ $total_cost }}</h4>
            </div>
            <div class="col-3">
              <label for="payments">Pagos:</label>
              <h4>$ {{ $entry->payments->sum('amount') }}</h4>
            </div>
            <div class="col-3">
              <label for="balance">Saldo:</label>
              <h4>$ {{ $balance }}</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-12">
              <ul class="list-group list-group-flush">
                @foreach($entry->payments as $payment)
                <li class="list-group-item col-12 p-0">
                  <div class="row">
                    <div class="col-5 ">{{$payment->payment_type->payment_type}}</div>
                    <div class="col-5 ">$ {{$payment->amount}}</div>
                    <div class="col-2 "><a href={{ url('entries/deletePayment/'. $payment->id_entry_payment)}}><i class="fas fa-minus-circle text-danger"></i></a></div>
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
                  <div style="background-color:{{ $product->color ? $product->color : "#d9534f" }}"class="btn products m-2 col-5" data-id_product="{{$product->id_product}}" data-product="{{$product->product}}" data-category="{{$product->id_product_category}}" style="width:100%">{{$product->product}}</div>
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
                              <div class="col-5 pl-5">00{{$entry_detail->inventory->id_inventory}} - {{$entry_detail->inventory->product->product}} </div>
                              <div class="col-3 ">{{$entry_detail->inventory->weight}} gr</div> 
                              <div class="col-3 ">${{$entry_detail->inventory->cost}}</div> 
                              <div class="col-1 "><a href={{ url('entries/deleteEntryDetail/'. $entry_detail->id_entry_detail)}}><i class="fas fa-minus-circle text-danger"></i></a></div>
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


//*Registrar pagos*/
$('#agregar_pagos').click(function(){
  $('#modal_pago').modal('show');
});

$('#guardar_pago').click(function(){
  var id_entry = {{$entry->id_entry}};
  var amount =  $("input[name=amount]").val();
  var date =  $("input[name=date]").val();
  var id_payment_type = $( "select#id_payment_type option:checked" ).val();

  $.ajax({
       dataType: 'json',
       type:'POST',
       url:'{{ url("entries/savePayment") }}',
       data:{id_entry:id_entry, amount:amount, date:date, id_payment_type: id_payment_type},

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