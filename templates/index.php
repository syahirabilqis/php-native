<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<div class="row">

  <!-- Total Paket -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
          Total Paket
        </div>
        <div class="h5 mb-0 font-weight-bold text-gray-800">
          <?= $totalPaket['total']; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Paket Tersedia -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
          Paket Tersedia
        </div>
        <div class="h5 mb-0 font-weight-bold text-gray-800">
          <?= $tersedia['total']; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Paket Habis -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
          Paket Habis
        </div>
        <div class="h5 mb-0 font-weight-bold text-gray-800">
          <?= $habis['total']; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Harga -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
          Total Nilai Paket
        </div>
        <div class="h5 mb-0 font-weight-bold text-gray-800">
          Rp <?= number_format($totalHarga['total']); ?>
        </div>
      </div>
    </div>
  </div>

</div>


                </div>
                <!-- /.container-fluid -->