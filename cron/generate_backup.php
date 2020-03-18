<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://teamioss.in/cfrmms/cron/generate_backup');
$store = curl_exec($ch);
curl_close($ch);
?>