@extends('templates.app')
@section('content')
    <body>
      <div class="container">
        <div class="page-inner">
          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
          >
            <div>
              <h3 class="fw-bold mb-3">Dashboard</h3>
            </div>
          </div>
        
          <div class="row row-card-no-pd">
            @foreach ($comparisonData as $data)
            <div class="col-12 col-sm-6 col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                          <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <h6><b>Invoice</b></h6>
                                <p class="text-muted">Laporan Data, {{ $data['nama_pt'] }}</p>
                            </div>
                            <div class="col-7 text-end">
                                <h4 class="text-{{ $data['percentageChange'] >= 0 ? 'success' : 'danger' }} fw-bold">
                                    Rp{{ number_format($data['changeDifference'], 2, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div
                                class="progress-bar bg-{{ $data['percentageChange'] >= 0 ? 'success' : 'danger' }}"
                                role="progressbar"
                                style="width: {{ abs($data['percentageChange']) }}%"
                                aria-valuenow="{{ abs($data['percentageChange']) }}"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            ></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="text-muted mb-0">Evaluasi Bulanan</p>
                            <p class="text-muted mb-0">{{ round($data['percentageChange'], 2) }}%</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-head-row">
                    <div class="card-title">Invoice Statistics</div>
                    {{-- <div class="card-tools">
                      <a
                        href="#"
                        class="btn btn-label-success btn-round btn-sm me-2"
                      >
                        <span class="btn-label">
                          <i class="fa fa-pencil"></i>
                        </span>
                        Export
                      </a>
                      <a href="#" class="btn btn-label-info btn-round btn-sm">
                        <span class="btn-label">
                          <i class="fa fa-print"></i>
                        </span>
                        Print
                      </a>
                    </div> --}}
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-container" style="min-height: 375px">
                    <canvas id="ptChart"></canvas>
                    {{-- <canvas id="invoiceChart"></canvas> --}}
                  </div>
                  {{-- <div id="myChartLegend"></div> --}}
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="row">
                      <div class="col-md-4">
                          <div class="card">
                              <div class="card-body pb-0">
                                  <div class="h1 fw-bold float-end text-primary">+5%</div>
                                  <h2 class="mb-2">17</h2>
                                  <p class="text-muted">Users online</p>
                                  <div class="pull-in sparkline-fix">
                                      <div id="lineChart"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="card">
                              <div class="card-body pb-0">
                                  <div class="h1 fw-bold float-end text-danger">-3%</div>
                                  <h2 class="mb-2">27</h2>
                                  <p class="text-muted">New Users</p>
                                  <div class="pull-in sparkline-fix">
                                      <div id="lineChart2"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="card">
                              <div class="card-body pb-0">
                                  <div class="h1 fw-bold float-end text-warning">+7%</div>
                                  <h2 class="mb-2">213</h2>
                                  <p class="text-muted">Transactions</p>
                                  <div class="pull-in sparkline-fix">
                                      <div id="lineChart3"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
          </div> -->
          <!-- <div class="row">
                      <div class="col-md-4">
                          <div class="card">
                              <div class="card-header">
                                  <div class="card-title">Top Products</div>
                              </div>
                              <div class="card-body pb-0">
                                  <div class="d-flex">
                                      <div class="avatar">
                                          <img src="assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                                      </div>
                                      <div class="flex-1 pt-1 ms-2">
                                          <h6 class="fw-bold mb-1">CSS</h6>
                                          <small class="text-muted">Cascading Style Sheets</small>
                                      </div>
                                      <div class="d-flex ms-auto align-items-center">
                                          <h4 class="text-info fw-bold">+$17</h4>
                                      </div>
                                  </div>
                                  <div class="separator-dashed"></div>
                                  <div class="d-flex">
                                      <div class="avatar">
                                          <img src="assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                                      </div>
                                      <div class="flex-1 pt-1 ms-2">
                                          <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                                          <small class="text-muted">The Best Donuts</small>
                                      </div>
                                      <div class="d-flex ms-auto align-items-center">
                                          <h4 class="text-info fw-bold">+$300</h4>
                                      </div>
                                  </div>
                                  <div class="separator-dashed"></div>
                                  <div class="d-flex">
                                      <div class="avatar">
                                          <img src="assets/img/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
                                      </div>
                                      <div class="flex-1 pt-1 ms-2">
                                          <h6 class="fw-bold mb-1">Ready Pro</h6>
                                          <small class="text-muted">Bootstrap 5 Admin Dashboard</small>
                                      </div>
                                      <div class="d-flex ms-auto align-items-center">
                                          <h4 class="text-info fw-bold">+$350</h4>
                                      </div>
                                  </div>
                                  <div class="separator-dashed"></div>
                                  <div class="pull-in">
                                      <canvas id="topProductsChart"></canvas>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="card">
                              <div class="card-body">
                                  <div class="card-title fw-mediumbold">Suggested People</div>
                                  <div class="card-list">
                                      <div class="item-list">
                                          <div class="avatar">
                                              <img src="assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle">
                                          </div>
                                          <div class="info-user ms-3">
                                              <div class="username">Jimmy Denis</div>
                                              <div class="status">Graphic Designer</div>
                                          </div>
                                          <button class="btn btn-icon btn-primary btn-round btn-xs">
                                              <i class="fa fa-plus"></i>
                                          </button>
                                      </div>
                                      <div class="item-list">
                                          <div class="avatar">
                                              <img src="assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle">
                                          </div>
                                          <div class="info-user ms-3">
                                              <div class="username">Chad</div>
                                              <div class="status">CEO Zeleaf</div>
                                          </div>
                                          <button class="btn btn-icon btn-primary btn-round btn-xs">
                                              <i class="fa fa-plus"></i>
                                          </button>
                                      </div>
                                      <div class="item-list">
                                          <div class="avatar">
                                              <img src="assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
                                          </div>
                                          <div class="info-user ms-3">
                                              <div class="username">Talha</div>
                                              <div class="status">Front End Designer</div>
                                          </div>
                                          <button class="btn btn-icon btn-primary btn-round btn-xs">
                                              <i class="fa fa-plus"></i>
                                          </button>
                                      </div>
                                      <div class="item-list">
                                          <div class="avatar">
                                              <img src="assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle">
                                          </div>
                                          <div class="info-user ms-3">
                                              <div class="username">John Doe</div>
                                              <div class="status">Back End Developer</div>
                                          </div>
                                          <button class="btn btn-icon btn-primary btn-round btn-xs">
                                              <i class="fa fa-plus"></i>
                                          </button>
                                      </div>
                                      <div class="item-list">
                                          <div class="avatar">
                                              <img src="assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
                                          </div>
                                          <div class="info-user ms-3">
                                              <div class="username">Talha</div>
                                              <div class="status">Front End Designer</div>
                                          </div>
                                          <button class="btn btn-icon btn-primary btn-round btn-xs">
                                              <i class="fa fa-plus"></i>
                                          </button>
                                      </div>
                                      <div class="item-list">
                                          <div class="avatar">
                                              <img src="assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle">
                                          </div>
                                          <div class="info-user ms-3">
                                              <div class="username">Jimmy Denis</div>
                                              <div class="status">Graphic Designer</div>
                                          </div>
                                          <button class="btn btn-icon btn-primary btn-round btn-xs">
                                              <i class="fa fa-plus"></i>
                                          </button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="card card-primary bg-primary-gradient">
                              <div class="card-body">
                                  <h5 class="mt-3 b-b1 pb-2 mb-4 fw-bold">Active user right now</h5>
                                  <h1 class="mb-4 fw-bold">17</h1>
                                  <h5 class="mt-3 b-b1 pb-2 mb-5 fw-bold">Page view per minutes</h5>
                                  <div id="activeUsersChart"></div>
                                  <h5 class="mt-5 pb-3 mb-0 fw-bold">Top active pages</h5>
                                  <ul class="list-unstyled">
                                      <li class="d-flex justify-content-between pb-1 pt-1"><small>/product/readypro/index.html</small> <span>7</span></li>
                                      <li class="d-flex justify-content-between pb-1 pt-1"><small>/product/kaiadmin/demo.html</small> <span>10</span></li>
                                  </ul>
                              </div>
                          </div>
                      </div>
          </div> -->
          {{-- <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Page visits</div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center mb-0">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">Page name</th>
                          <th scope="col">Visitors</th>
                          <th scope="col">Unique users</th>
                          <th scope="col">Bounce rate</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">/kaiadmin/</th>
                          <td>4,569</td>
                          <td>340</td>
                          <td>
                            <i class="fas fa-arrow-up text-success me-3"></i>
                            46,53%
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">/kaiadmin/index.html</th>
                          <td>3,985</td>
                          <td>319</td>
                          <td>
                            <i
                              class="fas fa-arrow-down text-warning me-3"
                            ></i>
                            46,53%
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">/kaiadmin/charts.html</th>
                          <td>3,513</td>
                          <td>294</td>
                          <td>
                            <i
                              class="fas fa-arrow-down text-warning me-3"
                            ></i>
                            36,49%
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">/kaiadmin/tables.html</th>
                          <td>2,050</td>
                          <td>147</td>
                          <td>
                            <i class="fas fa-arrow-up text-success me-3"></i>
                            50,87%
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">/kaiadmin/profile.html</th>
                          <td>1,795</td>
                          <td>190</td>
                          <td>
                            <i class="fas fa-arrow-down text-danger me-3"></i>
                            46,53%
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">/kaiadmin/</th>
                          <td>4,569</td>
                          <td>340</td>
                          <td>
                            <i class="fas fa-arrow-up text-success me-3"></i>
                            46,53%
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">/kaiadmin/index.html</th>
                          <td>3,985</td>
                          <td>319</td>
                          <td>
                            <i
                              class="fas fa-arrow-down text-warning me-3"
                            ></i>
                            46,53%
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Top Products</div>
                </div>
                <div class="card-body pb-0">
                  <div class="d-flex">
                    <div class="avatar">
                      <img
                        src="assets/img/logoproduct.svg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <div class="flex-1 pt-1 ms-2">
                      <h6 class="fw-bold mb-1">CSS</h6>
                      <small class="text-muted">Cascading Style Sheets</small>
                    </div>
                    <div class="d-flex ms-auto align-items-center">
                      <h4 class="text-info fw-bold">+$17</h4>
                    </div>
                  </div>
                  <div class="separator-dashed"></div>
                  <div class="d-flex">
                    <div class="avatar">
                      <img
                        src="assets/img/logoproduct.svg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <div class="flex-1 pt-1 ms-2">
                      <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                      <small class="text-muted">The Best Donuts</small>
                    </div>
                    <div class="d-flex ms-auto align-items-center">
                      <h4 class="text-info fw-bold">+$300</h4>
                    </div>
                  </div>
                  <div class="separator-dashed"></div>
                  <div class="d-flex">
                    <div class="avatar">
                      <img
                        src="assets/img/logoproduct3.svg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <div class="flex-1 pt-1 ms-2">
                      <h6 class="fw-bold mb-1">Ready Pro</h6>
                      <small class="text-muted"
                        >Bootstrap 5 Admin Dashboard</small
                      >
                    </div>
                    <div class="d-flex ms-auto align-items-center">
                      <h4 class="text-info fw-bold">+$350</h4>
                    </div>
                  </div>
                  <div class="separator-dashed"></div>
                  <div class="pull-in">
                    <canvas id="topProductsChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </body>
    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    {{-- <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script> --}}
    
    {{-- <script>
      // Data untuk grafik
      const invoiceData = {
        labels: [
          'January', 'February', 'March', 'April', 'May', 'June', 
          'July', 'August', 'September', 'October', 'November', 'December'
        ],
        datasets: [
          {
            label: 'MPA',
            data: [5, 10, 8, 6, 9, 15, 12, 11, 13, 10, 14], // Data MPA
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
          },
          {
            label: 'Dataset 1',
            data: [7, 11, 9, 5, 6, 12, 10, 15, 9, 7, 11, 13], // Dataset tambahan
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
          },
          {
            label: 'Dataset 2',
            data: [6, 8, 7, 12, 10, 8, 9, 11, 14, 13, 10, 12], // Dataset tambahan
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          },
          {
            label: 'Dataset 3',
            data: [9, 7, 11, 10, 8, 6, 5, 14, 13, 12, 9, 8], // Dataset tambahan
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
          },
          {
            label: 'Dataset 4',
            data: [12, 15, 10, 8, 6, 7, 9, 10, 11, 13, 14, 15], // Dataset tambahan
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1
          },
          {
            label: 'Dataset 5',
            data: [10, 9, 12, 15, 14, 13, 11, 7, 6, 5, 8, 9], // Dataset tambahan
            backgroundColor: 'rgba(201, 203, 207, 0.2)',
            borderColor: 'rgba(201, 203, 207, 1)',
            borderWidth: 1
          },
        ]
      };
    
      // Konfigurasi grafik
      const config = {
        type: 'line', // Jenis grafik: 'line', 'bar', 'pie', dll.
        data: invoiceData,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'Invoice Statistics - 1 Year'
            }
          },
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      };
    
      // Inisialisasi grafik
      const ctx = document.getElementById('invoiceChart').getContext('2d');
      new Chart(ctx, config);
    </script>     --}}

    <script>
      const chartData = @json($chartData);
  
      const labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  
      const datasets = chartData.map(data => ({
          label: data.nama_pt,
          data: data.monthlyData,
          borderColor: getRandomColor(),
          backgroundColor: getRandomColor(0.2),
          // backgroundColor: getRandomColor(0.7), //setting untuk bar
          borderWidth: 2,
      }));
  
      function getRandomColor(opacity = 1) {
          const r = Math.floor(Math.random() * 255);
          const g = Math.floor(Math.random() * 255);
          const b = Math.floor(Math.random() * 255);
          return `rgba(${r}, ${g}, ${b}, ${opacity})`;
      }
  
      const ctx = document.getElementById('ptChart').getContext('2d');
      new Chart(ctx, {
          type: 'line', // Bisa diganti 'bar', 'radar', dll.
          data: {
              labels: labels,
              datasets: datasets
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top'
                  },
                  title: {
                      display: true,
                      text: 'Grafik Jumlah Harga Per Bulan Berdasarkan PT'
                  }
              },
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
  </script>

@endsection