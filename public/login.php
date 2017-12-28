<?php
/**
 * Includes initialiation files at startup so that we have every thing that we
 * are going to include in this whole.
 */
require_once('../includes/initialize.php'); ?>

<!--Header Start-->
<!--
Including Page Headers that include all of the design for this website-->
<?php
  require_once('layouts/login/header.php');
?>
<!--Header End-->

<!--Body Start-->
<!--.inner-page-login-->
  <div id="inner-page-login">
      <div id="login-container">
        <form action="#" method="post">
            <label class="main-heading">Login</label>
            <div class="form-group input-group">
                <span class="input-group-addon">USERNAME </span>
                <input class="form-control" type="text" placeholder="Username" required="required">
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon">PASSWORD </span>
                <input class="form-control" type="password" placeholder="Password" required="required">
            </div>
            <div class="row" style="margin-bottom: 5px">
                <a href="#" class="btn-link" id="forgot-password" style="margin-left: 70%;">Forgot Password?</a>
            </div>
            <div class="form-group input-group" style="margin: auto;">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <button class="btn btn-default" style="margin-left: 15px;" type="reset">Reset</button>
            </div>
        </form>
      </div>
  </div>
  <!--./inner-page-login-->
<!--Start End-->

<!--Footer Start-->
<!--Including Footer to add in this page-->
<?php
  require_once('layouts/login/footer.php');
?>
<!--Footer End-->
