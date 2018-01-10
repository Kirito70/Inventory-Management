
<?php
    /*Including Initialization file so that page has all the required files...*/
    require_once ("../../includes/initialize/admin_initialize.php");
?>

<?php
    $user_categories = UserCategory::find_all();
    //var_dump($user_categories);
?>

<?php

$message = "";
if(isset($_POST["add_user"]))
{
    $first_name = trim($_POST["first-name"]);
    $last_name = trim($_POST["last-name"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $user_category = $_POST['category-id'];
    if(isset($_FILES['user-picture']))
    {
        $user_pic =$_FILES['user-picture'];
    }

    $user_to_add = new User();
    $user_to_add->first_name = $first_name;
    $user_to_add->last_name = $last_name;
    $user_to_add->username = $username;
    $user_to_add->email = $email;
    $user_to_add->password = password_hash($password,PASSWORD_BCRYPT);

    if($user_to_add->save())
    {
        $assigned_categories = array();
        foreach ($user_category as $id)
        {
            $assigned_category = new assigned_user_category();
            $assigned_category->user_id = $user_to_add->id;
            $assigned_category->user_category_id = $id;
            //$assigned_category->
            $assigned_categories[] = $assigned_category;
            if(!$assigned_category->save())
            {

                $user_to_add->delete();
                $message = "Error in Assigning Categories Revoking User Transaction.";
                $session->error_msg->add_message($message);
                return;
            }
        }

        //Adding User Image on the server
        if(isset($_FILES['user-picture']))
        {
            $user_image = new user_picture();
            if(!$user_image->attach_file($user_pic, $user_to_add->id))
            {
                $message = $user_image->errors;
                $session->error_msg->add_message($message);
                return;
            }
            else
            {
                if(!$user_image->save())
                {
                    $user_to_add->delete();
                    unset($user_to_add);
                    unset($user_image);

                    $message = "Error in Uploading User Image Transaction Revoked.";
                    $session->error_msg->add_message($message);
                }
            }
        }

        //Adding user Category in the system.

        $message = "User added Successfully";
        $session->message->add_message($message);
    }else
    {
        $message = "User cannot be added due to some problem.";
        $session->error_msg->add_message($message);
    }

    //$session->message = $message;

}
?>

<?php
    /*Including ADMIN HEADER in the website page*/
    require_once ("layouts/admin/header/admin_header.php");
?>
<!--Display Error Message...-->
<?php
echo output_error_message($session->error_msg->error_message());
?>

<?php
echo output_message($session->message->message_info());
?>
<script>
    $(document).ready(function() {

        $("#user-password").pwstrength();
        $('#confirm-Password').focusout(function () {
            var pass = $('#user-password').val();
            if(pass != $('#confirm-Password').val())
            {
                $('#password-mismatch').text("Password Mismatch.");
                $(':input[type="submit"]').prop('disabled',true);
            }
            else
            {
                $('#password-mismatch').text("");
                $(':input[type="submit"]').prop('disabled',false);
            }
        });

        $('#first-name').focusout(function () {
           if(/^[A-Za-z ]+$/.test($('#first-name').val()))
           {
               $('#wrong-firstname').text("");
               $(':input[type="submit"]').prop('disabled',false);
           }
           else
           {
               $('#wrong-firstname').text("Name must contain alphabets only");
               $(':input[type="submit"]').prop('disabled',true);
           }
        });

        $('#last-name').focusout(function () {
            if(/^[A-Za-z ]+$/.test($('#last-name').val()))
            {
                $('#wrong-lastname').text("");
                $(':input[type="submit"]').prop('disabled',false);
            }
            else
            {
                $('#wrong-lastname').text("Name must contain alphabets only");
                $(':input[type="submit"]').prop('disabled',true);
            }
        });

        $('#username').focusout(function () {

            var cname =$('#username').val();

            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: { username: cname },
                success: function (result) {
                    if(result)
                    {
                        $('#username-exist').text("Username already exists.");
                        $(':input[type="submit"]').prop('disabled',true);
                    }
                    else
                    {
                        $('#username-exist').text("");
                        $(':input[type="submit"]').prop('disabled',false);
                    }

                }
            });
        });
    });
</script>

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

                        <form role="form" action="add_user.php" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control name" id="first-name" type="text" pattern="[a-zA-Z][a-zA-Z ]{2,}" name="first-name" required="required" placeholder="First Name" maxlength="50"/>
                                <div class="label-danger" id="wrong-firstname"></div>
                            </div>

                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control name" id="last-name" type="text" pattern="[a-zA-Z][a-zA-Z ]{2,}" name="last-name" placeholder="Last Name" required="required" maxlength="50"/>
                                <div class="label-danger" id="wrong-lastname"></div>
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" id="username" type="text" name="username" required="required" placeholder="Username" maxlength="50"/>
                                <div class="label-danger" id="username-exist"></div>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" required="required" placeholder="Email" maxlength="100"/>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" id="user-password" type="password" name="password" placeholder="Password" maxlength="500" required="required"/>
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" id="confirm-Password" type="password" name="confirm-password" placeholder="Password" maxlength="500" required="required"/>
                                <div class="label-danger" id="password-mismatch"></div>
                            </div>

                            <div class="form-group">
                                <label>User Category</label>
                               <select multiple id="getCountry" name="category-id[]" style="width:300px">
                                    <?php foreach($user_categories as $category) { ?>
                                        <option value="<?php echo $category->id ?>" > <?php  echo htmlentities($category->category_name ) ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Picture</label>
                                <input type="hidden" name="picture_size" value="12000000"/>
                                <input class="form-control" type="file" name="user-picture" placeholder="User Image" />
                            </div>

                            <input class="btn-primary" type="submit" name="add_user" value="Submit"/>
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
               

