<!-- Modal Tambah Data user -->
<div class="modal fade bd-example-modal-md" id="addUser" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Tambah Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="" id="form" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md">
                            <input type="hidden" value="" name="id" />
                            <div class="form-group">
                                <label for="name">Nama :</label>
                                <input type="text" id="name" class="form-control" name="name">
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Email :</label>
                                <input type="email" class="form-control" name="email">
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Password :</label>
                                <input type="password" class="form-control" name="password" >
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Re-Password :</label>
                                <input type="password" class="form-control" name="password2">
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Hak Akses :</label>
                                <select class="custom-select" name="role">
                                  <option value="">Pilih...</option>
                                  <?php foreach ($role as $r) : ?>
                                    <option value="<?php echo $r['id'] ?>"><?php echo $r['role'] ?></option>
                                  <?php endforeach; ?>
                                </select>
                                <span class="help-block" style="color: red"></span>
                            </div>
                            <div class="form_group">
                              <input type="file" name="userfile" style="display:block" />
                              <span class="help-block" style="color: red"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" type="button" id="btnSave" onclick="save()">Simpan</button>
            </div>

        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
      </div>
    </div>
  </div>
</div>
