<?php
global $mediaFiles;
?>

<?php include_once 'views/layout/' . $this->layout . 'header.php';?>
<section class="bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Chang Password</h2>

              <form id="register_form" method="post" enctype="multipart/form-data" action="<?php echo html_helpers::url(array('ctl'=>'menu', 'act'=>'register')); ?>">
                <div class="form-outline mb-4 mx-2">
                  <input placeholder="current Password" type="password" id="current-password" class="form-control form-control-lg " />
                </div>
                
                <div class="form-outline mb-4 mx-2">
                  <input placeholder="New password" type="password" id="password" class="form-control form-control-lg " />
                </div>

                <div class="form-outline mb-4 mx-2">
                  <input name="password" placeholder="Repeat your new password" type="password" id="repeat-password" class="form-control form-control-lg " />
                </div>

                <div class="d-flex justify-content-center">
                  <button name="btn_submit" type="submit" id="register" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php array_push($mediaFiles['js'],RootREL."media/js/register.js"); ?>
<?php include_once 'views/layout/' . $this->layout . 'footer.php';?>
