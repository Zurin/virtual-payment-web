
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
                  <?php if ($jmlTopUp == 0) {
                    echo "
                      <div class='error-page'>
                        <h1 class='headline text-yellow'>0</h1>

                        <div class='error-content'>
                          <h3><i class='fa fa-warning text-yellow'></i> Anda tidak memiliki top up pending!</h3>
                          <p>
                            Kami tidak menemukan transaksi top up yang sedang pending pada akun Anda.
                            Anda dapat melakukan transaksi top up melalui <a href='topup'>Halaman ini</a>.
                          </p>
                        </div>
                      </div>
                    ";
                    } else {
                  ?>
                  <thead>
                  <tr>
                    <th>ID Top Up</th>
                    <th>Pengirim</th>
                    <th>Jumlah Top Up</th>
                    <th>Rekening Tujuan</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach ($tampil as $key => $value) { ?>
                  <tr>
                    <td><?php echo $value->id_topup; ?></td>
                    <td><?php echo $value->pengirim; ?></td>
                    <td>
                      <?php
                        $jml = $value->jumlah_topup;
                        $jumlah = number_format($jml, 2, ", ", ".");
                        echo "Rp ".$jumlah;
                      ?>
                    </td>
                    <td>
                      <?php
                        $tujuan = strtoupper($value->rek_tujuan);
                        echo $tujuan;
                      ?>
                    </td>
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
