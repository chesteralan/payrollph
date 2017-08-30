<?php

define('BASEPATH', '');
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
switch(ENVIRONMENT) {
    case 'development':
        require_once("application/config/database.php");
        require_once("application/config/config.php");
    break;
    default:
        require_once("application/config/".ENVIRONMENT."/database.php");
        require_once("application/config/".ENVIRONMENT."/config.php");
    break;
}
$dbconn = $db[$active_group];

// set Timezone
if( ! ini_get('date.timezone') )
{
   date_default_timezone_set('Asia/Manila');
} 

function compress($filename, $dir, $files){ 
    $zip = new ZipArchive();

    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        return false;
    }

    foreach($files as $file) {
        $zip->addFile($file, str_replace($dir . '\\', '', $file));
    }

    $zip->close();

    return true;
} 

function table_sql($link, $table, $showDropCreateTable=false) {
    $return='';

    $result = mysqli_query($link,'SELECT * FROM '.$table);
    $num_fields = mysqli_num_fields($result);

    if( $showDropCreateTable ) {
        $return.= 'DROP TABLE '.$table.';';
        $row2 = mysqli_fetch_row(mysqli_query($link,'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
    }

    $fields = array();
    $attrs = array();
    $attrs_query = mysqli_query($link,'SHOW COLUMNS FROM '.$table);
    while($attr = mysqli_fetch_row($attrs_query)) {
        $attrs[] = $attr; 
        $fields[] = "`{$attr[0]}`";   
    }

    for ($i = 0; $i < $num_fields; $i++) 
    {
        while($row = mysqli_fetch_row($result))
        {
            $return .= 'INSERT INTO '.$table.'';
            $values = ' VALUES(';
            for($j=0; $j<$num_fields; $j++) 
            {
                $row[$j] = addslashes($row[$j]);
                $row[$j] = str_replace("\n","\\n",$row[$j]);
                if (isset($row[$j])) { 
                    if( $row[$j]=="" ) { 
                        if( $attrs[$j][2] == 'YES' ) {
                            $values .= 'NULL'; 
                        } else {
                            $values .= '""'; 
                        }
                    } else {
                        $values .= '"'.$row[$j].'"'; 
                    }
                } else {
                    if( $attrs[$j][2] == 'YES' ) {
                        $values .= 'NULL'; 
                    } else {
                        $values .= '""'; 
                    }
                }
                if ($j<($num_fields-1)) { 
                    $values .= ','; 
                }
            }
            $values .= ");\n";
            $return .= " (" . implode(",", $fields) . ") ";
            $return .= $values;
        }
    }

    $return.= "\n";
    return $return;
}

function php_backup_tables_single($dbconn, $dir = "backups")
{
    $link = mysqli_connect($dbconn['hostname'],$dbconn['username'],$dbconn['password']);
    mysqli_select_db($link, $dbconn['database']);
    mysqli_query($link,"SET NAMES 'utf8'");


    $tables = array();
    $result = mysqli_query($link,'SHOW TABLES');
    while($row = mysqli_fetch_row($result))
    {
        $tables[] = $row[0];
    }

    $return='';
    $filename = $dir . DIRECTORY_SEPARATOR . $dbconn['database'] . "-" . date('Y-m-d-H-i-s') . '.sql';
    $handle = fopen($filename,'w+');

    foreach($tables as $table)
    {
        $return .= table_sql($link, $table);        
    }
    
    fwrite($handle,$return);
    fclose($handle);

    compress($dir . DIRECTORY_SEPARATOR . $dbconn['database'] . "-" . date('Y-m-d-H-i-s') . "-php-single.sql.zip", $dir, array($filename) );
    unlink($filename);

}

function php_backup_tables_multiple($dbconn, $dir="backups")
{
    $dir = "backups";
    $link = mysqli_connect($dbconn['hostname'],$dbconn['username'],$dbconn['password']);
    mysqli_select_db($link, $dbconn['database']);
    mysqli_query($link,"SET NAMES 'utf8'");


	$tables = array();
	$result = mysqli_query($link,'SHOW TABLES');
	while($row = mysqli_fetch_row($result))
	{
		$tables[] = $row[0];
	}

    $files = array();
    foreach($tables as $table)
    {
        $filename = $dir . DIRECTORY_SEPARATOR . $table . "-" . date('Y-m-d-H-i-s') . '.sql';
        $files[] = $filename;
        $handle = fopen($filename,'w+');
    
        $return = table_sql($link, $table);

        fwrite($handle,$return);
        fclose($handle);
    }
    compress($dir . DIRECTORY_SEPARATOR . $dbconn['database'] . "-" . date('Y-m-d-H-i-s') . "-php-multiple.sql.zip", $dir, $files );
    foreach($files as $source) {
        unlink($source);
    }

}

function win_backup_mysqldump_single($dbconn, $dir="backups")
{    
    $filename = $dbconn['database'] . "-" . date('Y-m-d-H-i-s') . '-win-single.sql';
    
    $cmd = 'D:\wamp\bin\mysql\mysql5.6.17\bin\mysqldump.exe ';
    $cmd .= ' -u ' . $dbconn['username'];
    $cmd .= ' --password="' . $dbconn['password'] . '"';
    $cmd .= ' ' . $dbconn['database'];
    $cmd .= ' > ' . $dir . DIRECTORY_SEPARATOR . $filename;

    exec($cmd);
    compress($dir . DIRECTORY_SEPARATOR . $filename . ".zip", $dir, array( $dir . DIRECTORY_SEPARATOR . $filename ) );
    unlink($dir . DIRECTORY_SEPARATOR . $filename);
}

function win_backup_mysqldump_multiple($dbconn, $dir="backups")
{    
    
    $link = mysqli_connect($dbconn['hostname'],$dbconn['username'],$dbconn['password']);
    mysqli_select_db($link, $dbconn['database']);
    mysqli_query($link,"SET NAMES 'utf8'");


    $tables = array();
    $result = mysqli_query($link,'SHOW TABLES');
    while($row = mysqli_fetch_row($result))
    {
        $filename = $dbconn['database'] . "-" . $row[0] . "-" . date('Y-m-d-H-i-s') . '-dump.sql';
        $cmd = 'D:\wamp\bin\mysql\mysql5.6.17\bin\mysqldump.exe ';
        $cmd .= ' -u ' . $dbconn['username'];
        $cmd .= ' --password="' . $dbconn['password'] . '"';
        $cmd .= ' ' . $dbconn['database'];
        $cmd .= ' ' . $row[0];
        $cmd .= ' > ' . $dir . DIRECTORY_SEPARATOR . $filename;

        exec($cmd);
        $files[] = $dir . DIRECTORY_SEPARATOR . $filename;
    }

    
    compress($dir . DIRECTORY_SEPARATOR . $dbconn['database'] . '-' . date('Y-m-d-H-i-s') . "-win-multiple.sql.zip", $dir, $files );
    foreach($files as $source) {
        unlink($source);
    }
}

function linux_backup_mysqldump_single($dbconn, $dir="backups")
{    
    $filename = $dbconn['database'] . "-" . date('Y-m-d-H-i-s') . '-linux-single.sql';
    
    $cmd = 'mysqldump ';
    $cmd .= ' -u ' . $dbconn['username'];
    $cmd .= ' --password="' . $dbconn['password'] . '"';
    $cmd .= ' ' . $dbconn['database'];
    $cmd .= ' > ' . $dir . DIRECTORY_SEPARATOR . $filename;

    exec($cmd);
    compress($dir . DIRECTORY_SEPARATOR . $filename . ".zip", $dir, array( $dir . DIRECTORY_SEPARATOR . $filename ) );
    unlink($dir . DIRECTORY_SEPARATOR . $filename);
}

function linux_backup_mysqldump_multiple($dbconn, $dir="backups")
{    
    
    $link = mysqli_connect($dbconn['hostname'],$dbconn['username'],$dbconn['password']);
    mysqli_select_db($link, $dbconn['database']);
    mysqli_query($link,"SET NAMES 'utf8'");


    $tables = array();
    $result = mysqli_query($link,'SHOW TABLES');
    while($row = mysqli_fetch_row($result))
    {
        $filename = $dbconn['database'] . "-" . $row[0] . "-" . date('Y-m-d-H-i-s') . '-dump.sql';
        $cmd = 'mysqldump ';
        $cmd .= ' -u ' . $dbconn['username'];
        $cmd .= ' --password="' . $dbconn['password'] . '"';
        $cmd .= ' ' . $dbconn['database'];
        $cmd .= ' ' . $row[0];
        $cmd .= ' > ' . $dir . DIRECTORY_SEPARATOR . $filename;

        exec($cmd);
        $files[] = $dir . DIRECTORY_SEPARATOR . $filename;
    }

    
    compress($dir . DIRECTORY_SEPARATOR . $dbconn['database'] . '-' . date('Y-m-d-H-i-s') . "-linux-multiple.sql.zip", $dir, $files );
    foreach($files as $source) {
        unlink($source);
    }
}

if( isset($_GET['type']) ) {
    switch($_GET['type']) {
        case 'php_single':
            php_backup_tables_single($dbconn);
        break;
        case 'php_multiple':
            php_backup_tables_multiple($dbconn);
        break;
        case 'win_mysqldump_single':
            win_backup_mysqldump_single($dbconn);
        break;
        case 'win_mysqldump_multiple':
            win_backup_mysqldump_multiple($dbconn);
        break;
        case 'linux_mysqldump_single':
            linux_backup_mysqldump_single($dbconn);
        break;
        case 'linux_mysqldump_multiple':
            linux_backup_mysqldump_multiple($dbconn);
        break;
    }
}

$backup_url = $config['base_url'] . (($config['index_page']!='') ? $config['index_page'] . "/" : '') . "system_backup";
header('location: ' . $backup_url);
exit;