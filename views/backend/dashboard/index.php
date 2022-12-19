<?php

use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Post;
use App\Models\Product;
use App\Models\Reviews;
use App\Models\User;

$orders = Order::get()->count();
$users = User::get()->count();
$reviews = Reviews::get()->count();
$products = Product::get()->count();
$posts = Post::get()->count();

require_once('../views/backend/header.php');

?>
<div class="content-wrapper">
  <section class="content-header">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Bài viết</p>
                      <h5 class="font-weight-bolder mb-0">
                        <span class="text-success text-sm font-weight-bolder">+ <?php echo $posts ?></span>
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Người dùng hôm nay</p>
                      <h5 class="font-weight-bolder mb-0">

                        <span class="text-success text-sm font-weight-bolder">+ <?php echo $users; ?></span>
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Đánh giá</p>
                      <h5 class="font-weight-bolder mb-0">
                        <span class="text-success text-sm font-weight-bolder">+ <?php echo $reviews ?></span>
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Doanh thu</p>
                      <h5 class="font-weight-bolder mb-0">
                        <?php $orderss = Order::with('products')->get(); ?>
                        <?php
                        foreach ($orderss as $od) {
                          $totalMoney = 0;
                          $sum = 0;
                          foreach ($od->products as $product) {
                            $totalMoney += $product->pivot->Amount;
                            $sum = ($totalMoney * $orders);
                          }
                        }
                        ?>
                        <?php echo '+ ' . (number_format($sum, 0, ',', '.')) . "<sup>đ</sup>"; ?>
                        <span class="text-success text-sm font-weight-bolder">+ <?php echo $orders ?>%</span>
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="d-flex flex-column h-100">
                      <div id="curve_chart" style="width: 900px; height: 500px"></div>
                    </div>
                  </div>
                  <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                    <div class=" border-radius-lg h-100">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="card p-3">
              <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100">
                <div id="piechart" style="width: 900px; height: 500px;"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-5 mb-lg-0 mb-4">
            <div class="card z-index-2">
              <div class="card-body p-3">
                <div class="chart">
                  <div id="columnchart_values"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="card z-index-2">
              <div class="card-header">
                <div id="chart_div" style="width: 900px; height: 408px;"></div>
              </div>
            </div>
          </div>
        </div>
    </main>
  </section>
</div>
<?php require_once('../views/backend/footer.php'); ?>


<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var orders = $('#orders').val();
    var users = $('#users').val();
    var reviews = $('#reviews').val();
    var products = $('#products').val();

    var data = google.visualization.arrayToDataTable([
      ['Năm', 'Doanh thu', 'Chi phí'],
      ['2004', 1000, 400],
      ['2005', 1170, 460],
      ['2006', 660, 1120],
      ['2007', 1030, 540]
    ]);

    var options = {
      title: 'Biểu đồ doanh thu',
      curveType: 'function',
      legend: {
        position: 'bottom'
      }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }
</script>
<script type="text/javascript">
  google.charts.load("current", {
    packages: ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ["Thành phần", "Tỉ trọng", {
        role: "style"
      }],
      ["Đồng", 8.94, "#b87333"],
      ["Bạc", 10.49, "silver"],
      ["Vàng", 19.30, "gold"],
      ["Bạch kim", 21.45, "color: #e5e4e2"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
      {
        calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation"
      },
      2
    ]);

    var options = {
      title: "Biểu đồ đánh giá",
      width: 600,
      height: 400,
      bar: {
        groupWidth: "95%"
      },
      legend: {
        position: "none"
      },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
    chart.draw(view, options);
  }
</script>
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Danh mục', 'Sản phẩm'],
      ['Iphone', 11],
      ['Samsung', 2],
      ['Oppo', 2],
      ['Xiaomi', 2],
      ['Vivo', 7],
      ['Nokia', 7]
    ]);

    var options = {
      title: 'Biểu đồ sản phẩm'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script>
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Người dùng', 'Tham gia'],
      [8, 12],
      [4, 5.5],
      [11, 14],
      [4, 5],
      [3, 3.5],
      [6.5, 7]
    ]);

    var options = {
      title: 'Biểu đồ người dùng',
      hAxis: {
        title: 'Người dùng',
        minValue: 0,
        maxValue: 15
      },
      vAxis: {
        title: 'Tham gia',
        minValue: 0,
        maxValue: 15
      },
      legend: 'none'
    };

    var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

    chart.draw(data, options);
  }
</script>