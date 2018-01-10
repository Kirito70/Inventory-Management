<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 09/01/2018
 * Time: 10:55 PM
 */

    require_once(LIB_PATH.DS."database".DS."database.php");
    require_once(LIB_PATH.DS."database".DS."DatabaseObject.php");
    require_once (LIB_PATH.DS.'Functions'.DS.'functions.php');

    class user_picture extends DatabaseObject
    {
        protected static $table_name = "user_images";
        protected static $db_fields = array('id','image_name','image_type','size','user_id');

        public $id = 0;
        public $image_name;
        public $image_type;
        public $size;
        public $user_id;

        private $temp_path;
        protected $upload_dir="uploads".DS."user_img";
        public $errors=array();

        protected $upload_errors = array(
            // http://www.php.net/manual/en/features.file-upload.errors.php
            UPLOAD_ERR_OK 				=> "No errors.",
            UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
            UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
            UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
            UPLOAD_ERR_NO_FILE 		=> "No file.",
            UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
            UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
            UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
        );

        public static function make($id,$image_name="",$image_type="",$size="",$user_id="")
        {
            $new_image = new user_picture();

            $new_image->id = $id;
            $new_image->image_name = $image_name;
            $new_image->image_type = $image_type;
            $new_image->size = $size;
            $new_image->user_id = $user_id;

            return $new_image;
        }

        public static function get_image($id = 0)
        {
            return DatabaseObject::find_by_field(self::$table_name,$id);
        }

        // Pass in $_FILE(['uploaded_file']) as an argument
        public function attach_file($file,$user_id) {
            // Perform error checking on the form parameters
            if(!$file || empty($file) || !is_array($file)) {
                // error: nothing uploaded or wrong argument usage
                $this->errors[] = "No file was uploaded.";
                return false;
            } elseif($file['error'] != 0) {
                // error: report what PHP says went wrong
                $this->errors[] = $this->upload_errors[$file['error']];
                return false;
            } else {
                // Set object attributes to the form parameters.
                $this->temp_path = $file['tmp_name'];
                $this->image_name = basename($file['name']);
                $this->image_type = pathinfo($file['name'],PATHINFO_EXTENSION);
                $this->size = $file['size'];
                $this->user_id = $user_id;
                // Don't worry about saving anything to the database yet.
                return true;

            }
        }

        public function save() {
            /* A new record won't have an id yet.*/
            if(isset($this->id) && $this->id != 0) {
                /* To just update picture in case entry already exists to avoid
                    Duplication of primary key
                */
                $this->update();
            } else {
                /* Make sure there are no errors*/

                /* Can't save if there are pre-existing errors*/
                if(!empty($this->errors)) { return false; }

                /* Can't save without filename and temp location*/
                if(empty($this->image_name) || empty($this->temp_path)) {
                    $this->errors[] = "The file location was not available.";
                    return false;
                }

                /* Save a corresponding entry to the database*/
                if($this->create())
                {
                    //Set Picture Name
                    $this->image_name = $this->id;
                    $this->image_name .= ".".$this->image_type;
                    $this->update();
                }
                else{
                    $this->errors[] = "Picture Information cannot be saved in database.";
                    return false;
                }

                /* Determine the target_path*/
                $target_path = SITE_ROOT .DS.$this->upload_dir .DS. $this->image_name;

                /*To Make sure a file doesn't already exist in the target location*/
                if(file_exists($target_path)) {
                    $this->errors[] = "The file {$this->image_name} already exists.";
                    return false;
                }


                /* Attempt to move the file*/
                if(move_uploaded_file($this->temp_path, $target_path)) {
                    /* Success
                    * We are done with temp_path, the file isn't there anymore
                    */
                    unset($this->temp_path);
                    return true;
                }
                else {
                    // File was not moved.
                    $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
                    return false;
                }
            }
        }

        public function image_path() {
            return $this->upload_dir.DS.$this->image_name;
        }

        public function size_as_text() {
            if($this->size < 1024) {
                return "{$this->size} bytes";
            } elseif($this->size < 1048576) {
                $size_kb = round($this->size/1024);
                return "{$size_kb} KB";
            } else {
                $size_mb = round($this->size/1048576, 1);
                return "{$size_mb} MB";
            }
        }

        public function destroy() {
            // First remove the database entry
            if($this->delete()) {
                // then remove the file
                // Note that even though the database entry is gone, this object
                // is still around (which lets us use $this->image_path()).
                $target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
                return unlink($target_path) ? true : false;
            } else {
                // database delete failed
                return false;
            }
        }
    }

?>