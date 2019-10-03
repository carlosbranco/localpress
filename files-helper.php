<?php
function remove_accent($str)
{
    $a = array(
        'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í',
        'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß',
        'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï',
        'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A',
        'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E',
        'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G',
        'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?',
        '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N',
        'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r',
        'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't',
        'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w',
        'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A',
        'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?',
        '?', '?', '?', '?', '?'
    );
    $b = array(
        'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I',
        'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's',
        'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i',
        'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A',
        'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E',
        'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G',
        'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ',
        'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N',
        'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r',
        'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't',
        'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w',
        'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A',
        'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A',
        'a', 'AE', 'ae', 'O', 'o'
    );
    return str_replace($a, $b, $str);
}

function slugify($str)
{
    return strtolower(preg_replace(
        array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
        array('', '-', ''),
        remove_accent(name($str))
    ));
}

function recurse_copy($src, $dst)
{
    shell_exec("cp -R $src $dst");
    return true;
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                recurse_copy($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

function getProjects()
{
    if (!file_exists(PROJECTS_FOLDER)) {
        mkdir(PROJECTS_FOLDER, 0777, true);
    }
    if (!file_exists(TRASH_FOLDER)) {
        mkdir(TRASH_FOLDER, 0777, true);
    }
    if (!file_exists(DATA_FOLDER)) {
        mkdir(DATA_FOLDER, 0777, true);
    }
    $files = glob(PROJECTS_FOLDER . "/*.txt");
    return $files;
}

function createProject()
{
    if (!isset($_POST['project_name'])) {
        return false;
    }

    $name = $_POST['project_name'];
    
    if (file_exists(PROJECTS_FOLDER . '/' . basename($name) . '.txt')) {
        define('ERROR', 'Already exists a project with the name you provide.');
        return true;
    }
    //CREATE PROJECT BASE
    file_put_contents(PROJECTS_FOLDER . '/' . basename($name) . '.txt', '');

    //BACKUP DATA FROM CURRENT WORDPRESS
    if ($_POST['action'] == 'current') {
        mkdir(DATA_FOLDER . '/' . slugify( basename( $name )), 0777, true);
        recurse_copy(THEMES_FOLDER, DATA_FOLDER . '/' . slugify( basename( $name )) . '/themes' );
        recurse_copy(PLUGINS_FOLDER, DATA_FOLDER . '/' . slugify( basename( $name )) . '/plugins' );
        file_put_contents(DATA_FOLDER . '/' . slugify( basename( $name )) . '/themes/project.txt', $name );
    } else {
        //BACKUP FROM OTHER PROJECT
    }
}

function backupProject()
{
    # code...
}

function restoreProject()
{
    # code...
}

function isProjectEmpty($project_name)
{
    if( !file_exists( DATA_FOLDER . '/' . slugify( basename($project_name )) . '/plugins' ) ){
        return true;
    }

    if( !file_exists( DATA_FOLDER . '/' . slugify( basename($project_name )) . '/themes' ) ){
        return true;
    }

    return false;
}

function getBackupSize($project_name)
{
    if( !file_exists( DATA_FOLDER . '/' . slugify( basename($project_name )) )) {
        return 0;
    }

    return format_size( foldersize(  DATA_FOLDER . '/' . slugify( basename($project_name ))  ));
}

function name($project_name)
{
    return str_replace('.txt','', $project_name);
}

function currentProject()
{
    if( !file_exists( THEMES_FOLDER . '/project.txt' ) ){
        return "None...";
    }

    return file_get_contents(THEMES_FOLDER . '/project.txt');
}

function isCurrentProject($current_project, $project)
{
    return $current_project == name(basename($project));
}

function moveToTrash()
{
   if( !isset($_GET['trash'] ) ){
        return false;
   }

   if( file_exists( PROJECTS_FOLDER . '/' . $_GET['trash'] . '.txt') ){
        
   }
}