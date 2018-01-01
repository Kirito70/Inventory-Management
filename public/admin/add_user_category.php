
<?php
    /*Including Initialization file so that page has all the required files...*/
    require_once ("../../includes/initialize/admin_initialize.php");
?>

<?php //if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>

<?php

    $message = "";
    if(isset($_POST["add_user_category"]))
    {
        $category_name = trim($_POST["category-name"]);
        $category_description = trim($_POST["category-description"]);

        $category = new UserCategory();
        $category->category_description = $category_description;
        $category->category_name = $category_name;
        if($category->save())
        {
            $message = "User Category added Successfully";
            $session->message->add_message($message);
        }else
        {
            $message = "User category cannot be added due to some problem.";
            $session->error_msg->add_message($message);
        }

        //$session->message = $message;

    }
?>


<?php
    /*Including ADMIN HEADER in the website page*/
    require_once ("layouts/admin/header/admin_header.php");
?>

    <!-- Making Form to add new user in the system. -->
    <!--Display Error Message...-->
<?php
    echo output_error_message($session->error_msg->error_message());
?>

<?php
    echo output_message($session->message->message_info());
?>


    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    User Category Management
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2>Add User Category</h2>

                            <form role="form" action="add_user_category.php" method="post">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input class="form-control" type="text" name="category-name" required="required" placeholder="Category Name" maxlength="100"/>
                                </div>

                                <div class="form-group">
                                    <label>Category Description</label>
                                    <input class="form-control" type="text" name="category-description" placeholder="Category Description" maxlength="100"/>
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
               

