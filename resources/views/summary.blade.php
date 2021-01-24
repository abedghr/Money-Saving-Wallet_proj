@extends('layouts.app')
@section('content')
<script src="https://raw.githubusercontent.com/nnnick/Chart.js/master/dist/Chart.bundle.js"></script>
<script>
    var year = ['Incomes','expenses'];
    var inc_daily = <?php echo $incomes; ?>;
    var exp_daily = <?php echo $expenses; ?>;
    var inc_monthly = <?php echo $incomesMonth; ?>;
    var exp_monthly = <?php echo $expensesMonth; ?>;
    var inc_yearly = <?php echo $incomesYear; ?>;
    var exp_yearly = <?php echo $expensesYear; ?>;


    


    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            showTooltips: true,
            type: 'bar',
    data: {
      labels: ["Incomes", "Expenses"],
      datasets: [
        {
          label: "Total",
          backgroundColor: ["#3e95cd", "#8e5ea2"],
          data: [
            inc_daily,
            exp_daily]
        }
      ]
    },
    options: {
      legend: { display: false },
      
      scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    },title: {
        display: true,
        text: 'Daily Incomes & Expenses'
      }
    }
        });



        var ctx = document.getElementById("canvas2").getContext("2d");
        window.myBar = new Chart(ctx, {
            showTooltips: true,
            type: 'bar',
    data: {
      labels: ["Incomes", "Expenses"],
      datasets: [
        {
          label: "Total",
          backgroundColor: ["#3e95cd", "#8e5ea2"],
          data: [
            inc_monthly,
            exp_monthly]
        }
      ]
    },
    options: {
      legend: { display: false },
      
      scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    },title: {
        display: true,
        text: 'Monthly Incomes & Expenses'
      }
    }
        });

        var ctx = document.getElementById("canvas3").getContext("2d");
        window.myBar = new Chart(ctx, {
            showTooltips: true,
            type: 'bar',
    data: {
      labels: ["Incomes", "Expenses"],
      datasets: [
        {
          label: "Total",
          backgroundColor: ["#3e95cd", "#8e5ea2"],
          data: [
            inc_yearly,
            exp_yearly]
        }
      ]
    },
    options: {
      legend: { display: false },
      
      scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    },title: {
        display: true,
        text: 'Yearly Incomes & Expenses'
      }
    }
        });


    };

</script>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <canvas id="canvas" height="380" width="600"></canvas>
        </div>
        <script>
            </script>
        <div class="col-md-4">
            <canvas id="canvas2" height="380" width="600"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="canvas3" height="380" width="600"></canvas>
        </div>  
    </div>
    <div class="justify-content-center">
            <div class="card">
                <div class="card-header">
                    
                    <div id="cont">
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            List of transactions
                        </div>
                        <div class="col-md-8 text-center">
                            <span class="mr-5" style="display: inline-block">Total Incomes: {{$total_incomes}} {{Auth::user()->wallet}}</span>
                            <span class="mr-5" style="display: inline-block">Total Expenses: {{$total_expenses}} {{Auth::user()->wallet}}</span>
                            <span style="display: inline-block">Wallet Balance: {{$wallet_balance}} {{Auth::user()->wallet}}</span>
                        </div>
                    </div>
                    
                </div>

                <div class="card-body">
                    <table class="table text-center">
                        <thead>
                          <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Note</th>
                            <th scope="col">Created At</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $trans)
                                <tr>
                                    <td>{{$trans->cate->cat_name}}</td>
                                    <td>{{$trans->amount}}</td>
                                    <td>{{$trans->note}}</td>
                                    <td>{{$trans->created_at}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
    </div>
    <canvas id="visitors-chart" height="200"></canvas>
</div>
@endsection

<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('chart.js/Chart.min.js')}}"></script>
