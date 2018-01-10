
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
            //echo $category->id;
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

<script>
    $(Document).ready(function () {
        $('#category-name').focusout(function () {

            var cname =$('#category-name').val();

            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: { category_name: cname },
                success: function (result) {
                    if(result)
                    {

                        $('#category-exist').text("User Category already exists.");
                        $(':input[type="submit"]').prop('disabled',true);
                    }
                    else
                    {
                        $('#category-exist').text("");
                        $(':input[type="submit"]').prop('disabled',false);
                    }
                }
            });
        });
    });

</script>

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
                                    <input class="form-control" type="text" id="category-name" name="category-name" required="required" placeholder="Category Name" maxlength="100" />
                                    <div class="label-danger" id="category-exist"></div>
                                </div>

                                <div class="form-group">
                                    <label>Category Description</label>
                                    <textarea class="form-control" maxlength="500" name="category-description" placeholder="Category Description"></textarea>
                                </div>

                                <input class="btn-primary" id="btsubmit" type="submit" name="add_user_category" value="Submit"/>
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
               

