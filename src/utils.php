<?php

/*
 * utils.php for embassy
 * by lenormf
 */

function getVar($in, $predicate, $default) {
    return $predicate === true ? $default : $in;
}

function getNonEmptyVar($in, $default) {
    return getVar($in, empty($in), $default);
}

function hasAccess() {
    if (isset($_SESSION[SESSION_PREFIX . 'id'])) {
        if ($_SESSION[SESSION_PREFIX . 'admin'] == 0)
            header("Location: index.php");
    }
    else
        header("Location: index.php");
}

function getLinkPage($page) {
    return ("index.php?page=" . $page . ".php");
}

function connexion() {
    $con = mysqli_connect("localhost", "root", "", "embassy");
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    return ($con);
}

function deconexion($con) {
    mysqli_close($con);
}


function autoLoadClasses()
{
    $dir_load = "classes";
   $dir = new DirectoryIterator($dir_load);
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        include ($dir_load."/".$fileinfo->getFilename());
    }
} 
}

function autoLoadCSSFile()
{
    $dir_load = "css";
   $dir = new DirectoryIterator($dir_load);
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        ?><link href="<?php echo $dir_load."/".$fileinfo->getFilename() ?>" rel="stylesheet"> <?php
    }
} 
}


function autoload()
{
 autoLoadClasses();  
 autoLoadCSSFile();
}