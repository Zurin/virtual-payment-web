
<section class="content">
<!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">TOP UP PENDING</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin table-hover table-bordered">
                  <?php if ($jmlWd == 0) {
                    echo "
                      <div class='error-page'>
                        <h1 class='headline text-yellow'>0</h1>

                        <div class='error-content'>
                          <h3><i class='fa fa-warning text-yellow'></i> Anda tidak memiliki withdraw pending!</h3>
                          <p>
                            Kami tidak menemukan transaksi withdraw yang sedang pending pada akun Anda.
                            Anda dapat melakukan transaksi withdraw melalui <a href='req_wd'>Halaman ini</a>.
                          </p>
                        </div>
                      </div>
                    ";
                    } else {
                  ?>
                  <thead>
                  <tr>
                    <th>ID Withdraw</th>
                    <th>Jumlah Withdraw</th>
                    <th>No rekening</th>
                    <th>Atas nama bank</th>
                    <th>Bank</th>
                    <th>Cabang</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach ($tampil as $key => $value) { ?>
                  <tr>
                    <td><?php echo $value->id_wd; ?></td>
                    <td>
                      <?php
                        $jml = $value->jumlah_wd;
                        $jumlah = number_format($jml, 2, ", ", ".");
                        echo "Rp ".$jumlah;
                      ?>
                    </td>
                    <td><?php echo $value->no_rekening; ?></td>
                    <td><?php echo $value->atas_nama; ?></td>
                    <td><?php echo $value->nama_bank; ?></td>
                    <td><?php echo $value->cabang; ?></td>
                    <td><span class="label label-warning"><?php echo $value->status; ?></span></td>
                  </tr>
                  <?php
                      }
                    }
                  ?>

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-footer -->
          </div>
</section>
