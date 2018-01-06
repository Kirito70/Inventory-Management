
<?php
    /*Including Initialization file so that page has all the required files...*/
    require_once ("../../includes/initialize/admin_initialize.php");
?>

<?php
    $user_categories = UserCategory::find_all();
    //var_dump($user_categories);
?>

<?php
    /*Including ADMIN HEADER in the website page*/
    require_once ("layouts/admin/header/admin_header.php");
?>

    <!-- Making Form to add new user in the system. -->
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                User Category Management
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-8">
                        <h2>Add New User</h2>

                        <form role="form" action="add_user_category.php" method="post">
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="first-name" required="required" placeholder="First Name" maxlength="50"/>
                            </div>

                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="last-name" placeholder="Last Name" required="required" maxlength="50"/>
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" type="text" name="username" required="required" placeholder="Username" maxlength="50"/>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" required="required" placeholder="Email" maxlength="100"/>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Password" maxlength="500" required="required"/>
                            </div>

                            <div class="form-group">
                                <label>User Category</label>
                               <select class="form-control" >
                                    <?php foreach($user_categories as $category) { ?>


                                        <option><?php  echo htmlentities($category->category_name) ?></option>

                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Picture</label>
                                <input class="form-control" type="file" name="user-picture" placeholder="User Image" />
                            </div>

                            <input class="btn-primary" type="submit" name="add_user_category" value="Submit"/>
                            <input class="btn-default" type="reset" name="reset" value="Reset"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    /*Including ADMIN FOOTER in the website page*/
    require_once ("layouts/admin/footer/admin_footer.php");
    ?>
               

