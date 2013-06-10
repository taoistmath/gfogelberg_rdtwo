<!DOCTYPE html>
<?php
$branch = $_GET['gitBranch'];
$environment = $_GET['environment'];
$browser = $_GET['browser'];
if ($branch == NULL)
    $branch = 'INFRASYS-1913-Stable'; //Set to same branch as repository.
$github_loc = 'https://github.com/dandb/helios/blob/'.$branch.'/tools/regression/features/dandb'; //Set url to github folder that contains features
$behat_loc = '/var/www/helios/tools/regression'; //Set to location of behat.yml file
$local_repo = $behat_loc.'/features/dandb'; //Set to local repo folder that contains features
echo($environment);
echo($browser);
echo($branch);
//var_dump($checked);
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHERRET</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="#">PHp Engineering Repository REgression Tool (PHERRET)</a>

            <div class="nav-collapse collapse">
                <ul class="nav">
                    <!--                    <li class="active"><a href="#">Home</a></li>-->
                    <!--                    <li><a href="#about">About</a></li>-->
                    <!--                    <li><a href="#contact">Contact</a></li>-->
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">

    <h1>Bootstrap starter template</h1>

    <form name="branchFilter" method="GET" action="pherret.php">
        <div class="controls controls-row">
            <div class="span1">
                <p>Environment</p>
                <select class="span1" id="environment" name="environment">
                    <option <?php if ($_GET['environment'] == 'DEV') { ?>selected="true" <?php }; ?>value="DEV">DEV
                    </option>
                    <option <?php if ($_GET['environment'] == 'QA') { ?>selected="true" <?php }; ?>value="QA">QA
                    </option>
                    <option <?php if ($_GET['environment'] == 'STG') { ?>selected="true" <?php }; ?>value="STG">STG
                    </option>
                    <option <?php if ($_GET['environment'] == 'PRD') { ?>selected="true" <?php }; ?>value="PRD">PRD
                    </option>
                </select>
            </div>

            <div class="span2 offset1">
                <p>Browser</p>
                <select class="span2" id="brower" name="browser">
                    <option <?php if ($_GET['browser'] == 'Firefox') { ?>selected="true" <?php }; ?>value="Firefox">
                        Firefox
                    </option>
                    <option <?php if ($_GET['browser'] == 'Chrome') { ?>selected="true" <?php }; ?>value="Chrome">
                        Chrome
                    </option>
                </select>
            </div>

            <div class="span2">
                <label>Branch</label>
                <!--Changing the branch changes where the link points on GitHub.
                This does not change which files are shown in the table-->
                <input type="text" value="<?PHP print $branch; ?>" name="gitBranch">
            </div>
        </div>

        <!--    This is for the listFolderFilesTable-->
        <!--    <table class="table table-hover table-bordered">-->
        <!--        <thead>-->
        <!--        <tr>-->
        <!--            <th></th>-->
        <!--            <th>Directory</th>-->
        <!--            <th>Feature</th>-->
        <!--        </tr>-->
        <!--        </thead>-->
        <!--        --><?php
//        listFolderFilesTable($local_repo, array('index.php', 'edit_page.php', 'pages', 'full', 'sanity'));
//        ?>
        <!--    </table>-->
        <?php listFolderFiles($local_repo, array('index.php', 'edit_page.php', 'pages', 'full', 'sanity')); ?>
        <div class="span2">
            <label></label>
            <button class="btn btn-primary span2 offset4" type="submit">Start Features</button>
        </div>
    </form>

</div>

<?php
function listFolderFiles($dir, $exclude)
{
    global $github_loc;
    $files = scandir($dir);
    $folder = end(explode('/', $dir));
    foreach ($files as $file) {
        if (is_array($exclude) and !in_array($file, $exclude)) {
            if ($file != '.' && $file != '..') {
                if (is_dir($dir . '/' . $file)) {
                    echo '<br /><strong>'.$file . '</strong><br />';
                } else {
                    //Will open GitHub repo location for branch entered
                    echo '<input type="checkbox" name="checkbox[]"/>
                        <a href="' . ltrim($github_loc . '/' . $folder . '/' . $file, './') . '">' . $file . '</a><br />';
                }
                if (is_dir($dir . '/' . $file)) listFolderFiles($dir . '/' . $file, $exclude);
            }
        }
    }
}
?>

<!--function listFolderFilesTable($dir, $exclude)-->
<!--{-->
<!--    global $github_loc;-->
<!--    $files = scandir($dir);-->
<!--    $folder = end(explode('/', $dir));-->
<!--    echo '<tr class="trth">';-->
<!--    foreach ($files as $file) {-->
<!--        if (is_array($exclude) and !in_array($file, $exclude)) {-->
<!--            if ($file != '.' && $file != '..') {-->
<!--                if (!is_dir($dir.'/'.$file)) {-->
<!--                    echo '<tr><th>-->
<!--                        <label class="checkbox">-->
<!--                            <input type="checkbox" name="checkbox" formmethod="post">-->
<!--                        </label>-->
<!--                        </th>';-->
<!--                    echo '<th>'.$folder.'</th><th><a href="'.ltrim($github_loc.'/'.$folder.'/'.$file, './').'">'.$file.'</a>'; //Will open GitHub repo location for branch entered-->
<!--//                    echo '<th>'.$folder.'</th><th><a href="path=/'.ltrim($dir.'/'.$file, './').'">'.$file.'</a>'; //Will open-->
<!--                }-->
<!--                if (is_dir($dir.'/'.$file)) listFolderFiles($dir.'/'.$file, $exclude);-->
<!--                echo '</th></tr>';-->
<!--            }-->
<!--        }-->
<!--    }-->
<!--    echo '</tr>';-->
<!--}-->

<!-- /container -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap-transition.js"></script>
<script src="../assets/js/bootstrap-alert.js"></script>
<script src="../assets/js/bootstrap-modal.js"></script>
<script src="../assets/js/bootstrap-dropdown.js"></script>
<script src="../assets/js/bootstrap-scrollspy.js"></script>
<script src="../assets/js/bootstrap-tab.js"></script>
<script src="../assets/js/bootstrap-tooltip.js"></script>
<script src="../assets/js/bootstrap-popover.js"></script>
<script src="../assets/js/bootstrap-button.js"></script>
<script src="../assets/js/bootstrap-collapse.js"></script>
<script src="../assets/js/bootstrap-carousel.js"></script>
<script src="../assets/js/bootstrap-typeahead.js"></script>

</body>
</html>
