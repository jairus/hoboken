<?php
if(isset($_GET['clear'])){
$contents = "";
}
else{
$contents = 
"######### auto generated ###########
RewriteEngine On
#RewriteCond %{REQUEST_FILENAME} !-f
#RewriteCond %{REQUEST_FILENAME} !-d

RewriteCond %{HTTP_HOST} ^tingoglocal.ph$
RewriteRule .* tingog/index.php [L]

RewriteCond %{HTTP_HOST} ^tab.tingoglocal.ph$
RewriteRule .* tab.tingog/index.php [L]

RewriteCond %{HTTP_HOST} ^ads.tingoglocal.ph$
RewriteRule .* _app/index.php [L]
";
}
//file_put_contents(dirname(__FILE__)."/../.htaccess", $contents);
//echo "htaccess modified!";
echo "app here..";
