<?php
set_time_limit(0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('PLUGINS_FOLDER', __DIR__ . '/../wp-content/plugins');
define('THEMES_FOLDER', __DIR__ . '/../wp-content/themes');
define('PROJECTS_FOLDER', __DIR__ . '/projects');
define('DATA_FOLDER', __DIR__ . '/data');
define('TRASH_FOLDER', __DIR__ . '/trash');

if (!file_exists(PLUGINS_FOLDER)) {
    die("PLUGINS FOLDER NOT FOUNT. THIS FOLDER SHOULD BE ON WORDPRESS ROOT FOLDER");
}

if (!file_exists(THEMES_FOLDER)) {
    die("THEMES FOLDER NOT FOUNT. THIS FOLDER SHOULD BE ON WORDPRESS ROOT FOLDER");
}

if (!file_exists(__DIR__ . '/../wp-config.php')) {
    die("wp-config.php file not found. THIS FOLDER SHOULD BE ON WORDPRESS ROOT FOLDER.");
}
require_once __DIR__ . '/../wp-config.php';
require_once __DIR__ . '/files-helper.php';
#require_once __DIR__ . '/myphp-backup.php';
#require_once __DIR__ . '/myphp-restore.php';
createProject();
$projects = getProjects();
$current_project = currentProject();
?>
  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css">
    <style>
      .error {
        background: #e0455e;
        color: #fff;
      }
      
      .warning {
        background: #ffba00;
        color: #121212;
        border-color: #ffba00;
      }
      
      .success {
        background: #15CD72;
        color: #fff;
        padding: 5px;
        border-radius: 5px;
      }
    </style>
  </head>

  <body>
    <div class="container">
      Local<strong>Press</span>
<hr>
<form method="POST" action="index.php">
<fieldset>
<div class="row">
<div class="column"> <label for="nameField">Project Name</label>
<input required type="text" placeholder="Name..." id="nameField" name="project_name"></div>
<div class="column">
<label for="action">Based on</label>
<select id="action" name="action">
<option value="current">Current Wordpress State</option>
<?php
foreach ($projects as $project) {
    if (isProjectEmpty($project)) {
        continue;
    }
    ?>
    <option value="<?php echo $project ?>">Project: <?php echo name(basename($project)) ?></option>
<?php } ?>
</select></div>
<div class="column">
<label for="test">&nbsp;</label><input class="button-primary" type="submit" value="Create New Project"></div>
</div>
</fieldset>
</form>
<hr>
<?php if (empty($projects)) {  ?>
    <blockquote class="warning">
    <p><em>You don't have any project created. You can create a new project with the configuration you have right now in your Wordpress.</em></p>
    </blockquote>
<?php } ?>
<?php if (defined('SUCCESS')) {  ?>
    <blockquote class="warning">
    <p><em><?php echo SUCCESS ?></em></p>
    </blockquote>
<?php } ?>
<?php if (defined('ERROR')) {  ?>
    <blockquote class="error">
    <p><em><?php echo ERROR ?></em></p>
    </blockquote>
<?php } ?>
<table>
<thead>
<tr>
<th>Name</th>
<th>Backup</th>
<th>Restore</th>
<th></th>
</tr>
</thead>
<tbody>
<?php foreach ($projects as $project) { ?>
    <tr>
    <td><span class="<?php echo isCurrentProject($current_project, $project) ? 'success' : ''; ?>"><?php echo name(basename($project)) ?></span></td>
    <td>
    <?php
    if (isCurrentProject($current_project, $project)) {
        echo '<button class="button button-outline">Backup Now</button>';
    } ?>
    </td>
    <td><?php
    if (!isProjectEmpty($project)) {
        if (isCurrentProject($current_project, $project)) {
            echo '<button class="button button-outline">Restore Backup</button>';
        } else {
            echo '<button class="button button-outline">Change to This Project</button>';
        }
    } else {
        echo '<small>Empty</small>';
    } ?></td>
    <td><button class="button button-clear float-right">Delete</button></td>
    </tr>
<?php } ?>
</tbody>
</table>
</div>
</body>
</html>