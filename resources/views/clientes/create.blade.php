@extends('layouts.app')

@section('content')
  <cliente-crear></cliente-crear>
@endsection


<script type="text/javascript">

  function calcular(){
      var num1 = document.getElementById("prestamo").value;
      var num2 = document.getElementById("interes").value;
      var valor1 = num1 / 100;
      var valor2 = valor1 * num2;
      var total_a_pagar = parseFloat(valor2) + parseFloat(num1);
      document.getElementById("total").value = total_a_pagar;
      document.getElementById("deuda").value = total_a_pagar;
      console.log("valor1: " + valor1);
      console.log("Num1: " + num1);
      console.log("Num2: " + num2);
  };

  function pago_por_dia(){
      var num3 = document.getElementById("total").value;
      var num4 = document.getElementById("dias").value;
      var total_dias = parseFloat(num3) / parseFloat(num4);
      // console.log("Total Dias: " + total_dias);
      document.getElementById("totaldias").value = total_dias.toFixed(2);
  };
</script>