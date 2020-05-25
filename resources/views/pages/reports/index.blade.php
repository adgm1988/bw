@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Reportes</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>




<!-- Main content -->
<section class="content" >
  <h4>Ventas</h4>
  <div class="row">
    <div id="monthly_sale_by_product" class="col-md-6" style="height:300px;"></div>
    <div id="monthly_total_sale" class="col-md-6" style="height:300px;"></div>
  </div>
  <br>
  <div class="row">
    <div id="monthly_sale_by_product_kg" class="col-md-6" style="height:300px;"></div>
    <div id="monthly_total_sale_kg" class="col-md-6" style="height:300px;"></div>
  </div>
  <br>
</section>
  <!-- /.content -->

@endsection

@section('script')
  <script>
   document.addEventListener('DOMContentLoaded', function () {
    var monthly_sale_by_product = Highcharts.chart('monthly_sale_by_product', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Ventas mensuales MXN'
      },
      xAxis: {
        categories: [
        @foreach($months as $month)
        "{{$month->month}}",
        @endforeach
        ]
      },
      yAxis: {
        title: {
          text: '$ MXN'
        }
      },
      series: [
      @foreach($products as $product)
      {
        name: '{{$product->product}}',
        data: [
          @foreach($months as $month)
            @php ($val = 0)
            @foreach($datas as $data)
              @if($data->product == $product->product)
                @if($data->month == $month->month)
                  @php ($val = $data->total_sales)
                @endif
              @endif
            @endforeach
          {{$val}},
          @endforeach
        ]},
      @endforeach
      ]

    });

    var monthly_total_sale = Highcharts.chart('monthly_total_sale', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Ventas mensuales MXN'
      },
      xAxis: {
        categories: [
        @foreach($months as $month)
        "{{$month->month}}",
        @endforeach
        ]
      },
      yAxis: {
        title: {
          text: '$ MXN'
        }
      },
      series: [
      {
        name: 'Venta',
        data: [
          @foreach($total_mensual as $total)
            {{$total->total_sales}},
          @endforeach
        ]},
      ]

    });


     var monthly_sale_by_product_kg = Highcharts.chart('monthly_sale_by_product_kg', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Ventas mensuales KG'
      },
      xAxis: {
        categories: [
        @foreach($months as $month)
        "{{$month->month}}",
        @endforeach
        ]
      },
      yAxis: {
        title: {
          text: 'KG'
        }
      },
      series: [
      @foreach($products as $product)
      {   
        name: '{{$product->product}}',
        data: [
          @foreach($months as $month)
            @php ($val = 0)
            @foreach($datas_kg as $data)
              @if($data->product == $product->product)
                @if($data->month == $month->month)
                  @php ($val = $data->total_sales)
                @endif
              @endif
            @endforeach
          {{$val}},
          @endforeach
        ]},
      @endforeach
      ]

    });

     var monthly_total_sale_kg = Highcharts.chart('monthly_total_sale_kg', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Ventas mensuales KG'
      },
      xAxis: {
        categories: [
        @foreach($months as $month)
        "{{$month->month}}",
        @endforeach
        ]
      },
      yAxis: {
        title: {
          text: 'KG'
        }
      },
      series: [
      {
        name: 'Venta',
        data: [
          @foreach($total_mensual_kg as $total)
            {{$total->total_sales}},
          @endforeach
        ]},
      ]

    });

  });

  </script>

@endsection