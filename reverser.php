<?php
set_time_limit(0);
 
function getmicrotime() {
   list($usec, $sec) = explode(" ",microtime());
   return ((float)$usec + (float)$sec);
} 
 
$time_start = getmicrotime();
 
// algorithm of hash
// see http://php.net/hash_algos for available algorithms
define('HASH_ALGO', 'md5');

// max length of password to try
define('PASSWORD_MAX_LENGTH', 800);
 
$charset = 'abcdefghijklmnopqrstuvwxyz';
$charset .= '0123456789';
//$charset .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
//$charset .= '~`!@#$%^&*()-_\/\'";:,.+=<>? ';
$str_length = strlen($charset);
// Get MD5 checksum from command line
$count = 0;
$loopcount = 0;
$hash_password = "827ccb0eea8a706c4c34a16891f84e7b";
$timenow = time();
 
function checkwaktu(){
        global $timenow, $loopcount, $count;
        if($timenow == time()){
            $loopcount = $loopcount + 1;
            
        }else{
            $timenow = time();
            echo "HASH PER DETIK : " . $loopcount . PHP_EOL;
            echo "jumlah percobaan : " . $count . PHP_EOL;
            $loopcount = 0;
        }
}
function check($password)
{
	
        global $hash_password, $time_start, $count, $timenow, $loopcount;   
		$hashings = hash(HASH_ALGO, $password);
			//echo "> " .  $password . " == " . $count . PHP_EOL;
			
//        checkwaktu();
        if($timenow == time()){
            $loopcount = $loopcount + 1;
            
        }else{
            $timenow = time();
            echo "HASH PER DETIK : " . $loopcount . "\r";
            echo "jumlah percobaan : " . $count . " | " . $loopcount . " / detik" . "\r";
            $loopcount = 0;
        }
        if ($hashings == $hash_password) {
                echo "\n";
                echo "===========\n";
                echo  $password.PHP_EOL;
                $time_end = getmicrotime();
                $time = $time_end - $time_start; 
                
                echo "\n* ditemukan dalam waktu " . $time . " detik\n";
                echo "* Percobaan ke " . $count . " kali\n";
                exit;
        }
        $count = $count + 1;
}
 
 
function recurse($width, $position, $base_string)
{
        global $charset, $str_length;
 
        for ($i = 0; $i < $str_length; ++$i) {
                if ($position  < $width - 1) {
                        recurse($width, $position + 1, $base_string . $charset[$i]);
                }
                check($base_string . $charset[$i]);
        }
}
 
for ($i = 1; $i < PASSWORD_MAX_LENGTH + 1; ++$i) {
        $time_check = getmicrotime();
        $time = $time_check - $time_start;
        recurse($i, 0, '');
}
 
echo "Algoritma tidak bisa menemukan hasil Dekripsi\r\n";
?>
