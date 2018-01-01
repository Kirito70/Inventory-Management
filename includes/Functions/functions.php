<?php

function strip_zeros_from_date( $marked_string="" ) {
    // first remove the marked zeros
    $no_zeros = str_replace('*0', '', $marked_string);
    // then remove any remaining marks
    $cleaned_string = str_replace('*', '', $no_zeros);
    return $cleaned_string;
}

function redirect_to( $location = NULL ) {
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

function output_error_message($message="") {
    $output = "";
    if (!empty($message)) {
        $output = "<div class=\"row\">";
        $output .= " <div class=\"col-md-8\">";
        $output .= "<div class=\"panel panel-danger\">";
        $output .= "<div class=\"panel-heading\">";
        $output .= "Error!";
        $output .= "</div>";
        $output .= "<div class=\"panel-body\">";
        $output .= "<div class=\"row\">";
        $output .= "<div class=\"col-lg-8\">";
        $output .= "<ul class=\"alert-danger\">";

        foreach ($message as $key => $value)
        {
            $output .= "<li>{$value}</li>";
        }

        $output .= "</ul>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";

        return $output;
    } else {
        return "";
    }
}

function output_message($message="") {
    $output = "";
    if (!empty($message)) {
        $output = "<div class=\"row\">";
        $output .= " <div class=\"col-md-8\">";
        $output .= "<div class=\"panel panel-info\">";
        $output .= "<div class=\"panel-heading\">";
        $output .= "System Message";
        $output .= "</div>";
        $output .= "<div class=\"panel-body\">";
        $output .= "<div class=\"row\">";
        $output .= "<div class=\"col-lg-8\">";
        $output .= "<ul class=\"text-info\">";

        foreach ($message as $key => $value)
        {
            $output .= "<li>{$value}</li>";
        }

        $output .= "</ul>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";

        return $output;
    } else {
        return "";
    }
}

function __autoload($class_name) {
    $class_name = strtolower($class_name);
    $path = LIB_PATH.DS."{$class_name}.php";
    if(file_exists($path)) {
        require_once($path);
    } else {
        die("The file {$class_name}.php could not be found.");
    }
}

function include_layout_template($template="") {
    include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}

function log_action($action, $message="") {
    $logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
    $new = file_exists($logfile) ? false : true;
    if($handle = fopen($logfile, 'a')) { // append
        $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
        $content = "{$timestamp} | {$action}: {$message}\n";
        fwrite($handle, $content);
        fclose($handle);
        if($new) { chmod($logfile, 0755); }
    } else {
        echo "Could not open log file for writing.";
    }
}

function datetime_to_text($datetime="") {
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

?>