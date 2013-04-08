<html>
    <head>        
        <title>Test File</title>
    </head>
    <body>
<?php

# Enable Error Reporting and Display:
error_reporting(~0);
ini_set('display_errors', 1);

$url = "https://api.github.com/repos/Glowstrontium/JSTR_MC-1.4.7/git/trees/master?recursive=1";
echo '<p>'.$url.'</p>';

$jsonData = file_get_contents($url);

print '<p>', var_dump($jsonData), '</p>';

# Output information about allow_url_fopen:
if (ini_get('allow_url_fopen') == 1) {
    echo '<p style="color: #0A0;">fopen is allowed on this host.</p>';
} else {
    echo '<p style="color: #A00;">fopen is not allowed on this host.</p>';
}


# Decide what to do based on return value:
if ($jsonData === FALSE) {
    echo "Failed to open the URL ", htmlspecialchars($url);
} elseif ($jsonData === NULL) {
    echo "Function is disabled.";
} else {
   echo $jsonData;
}

?>

<?php
echo "=================================================";
phpinfo();
?>
    </body>
</html>
