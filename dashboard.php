<?php include('db_connect.php') ?>
<!-- Info boxes -->
<?php if($_SESSION['login_type'] == 1): ?>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pengguna</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM users where type = 3")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-poll-h"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Survey</span>
                 <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM survey_set")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-money-bill"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Poin Yang Dimiliki</span>
                <span class="info-box-number">
                  <?php
                  $user = $conn->query("SELECT poin_user FROM users where id = {$_SESSION['login_id']}");
                  $row_user = $user->fetch_assoc();
                  $poin_u= $row_user['poin_user']; 
                  
                  echo $poin_u; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-poll"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Survey Yang Dibuat</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT id FROM survey_set where user_id = {$_SESSION['login_id']}")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-poll"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Survey Report Yang Diambil</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT survey_id FROM riwayat  where user_id = {$_SESSION['login_id']} AND keterangan = 'Mengambil report survey'")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
      </div>

<?php else: ?>
	 <div class="col-12">
          <div class="card">
          	<div class="card-body">
          		Selamat Datang, <?php echo $_SESSION['login_name'] ?>!
          	</div>
          </div>
      </div>
      <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-poll-h"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Mengisi Survey</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT distinct(survey_id) FROM answers  where user_id = {$_SESSION['login_id']}")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-money-bill"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Poin Yang Dimiliki</span>
                <span class="info-box-number">
                  <?php
                  $user = $conn->query("SELECT poin_user FROM users where id = {$_SESSION['login_id']}");
                  $row_user = $user->fetch_assoc();
                  $poin_u= $row_user['poin_user']; 
                  
                  echo $poin_u; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-poll"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Survey Yang Dibuat</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT id FROM survey_set where user_id = {$_SESSION['login_id']}")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-poll"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Survey Report Yang Diambil</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT survey_id FROM riwayat  where user_id = {$_SESSION['login_id']} AND keterangan = 'Mengambil report survey'")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
      </div>
          
<?php endif; ?>
