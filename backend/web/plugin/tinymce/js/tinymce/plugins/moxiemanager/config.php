<?php
$moxieManagerConfig["authenticator"] = "";
// Single path
$moxieManagerConfig['filesystem.rootpath'] = "/var/www/htdocs/mysite.com/files";

// Multiple named paths
$moxieManagerConfig['filesystem.rootpath'] = "Myfiles=../myfiles;YourFiles=../yourfiles";
