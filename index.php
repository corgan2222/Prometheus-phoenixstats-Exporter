<?php

require_once 'docker-conf.php';
require_once 'json_parser.class.php';

$parser = new json_parser();
$parser->server_list = $server_list;
$parser->wait_timeout = $wait_timeout;
$parser->gpu_temp_yellow = $gpu_temp_yellow;
$parser->gpu_temp_red = $gpu_temp_red;
$parser->gpu_fan_yellow = $gpu_fan_yellow;
$parser->gpu_fan_red = $gpu_fan_red;
$parser->parse_all_json_rpc_calls();

// echo  $parser->miner_count . "\r";
// echo  $parser->global_hashrate . "\r";

// foreach ($parser->miner_data_results as $name => $miner) 
// { 
        // echo $name . "\r";
        // echo $parser->miner_status->{$name}. "\r";
        // echo $miner->coin. "\r";
        // echo $miner->version. "\r";
        // echo $miner->uptime. "\r";
        // echo $miner->uptime_raw. "\r";
        // echo $miner->pool. "\r";
        // echo $miner->hostname. "\r";
        // echo $miner->port. "\r";
        // echo number_format($miner->stats->shares, 0). "\r";
        // echo number_format($miner->stats->rejected, 0) . "\r";
        // echo number_format($miner->stats->stale, 0). "\r";

        // foreach ($miner->card_stats as $key => $stat) 
        // { 
        //     echo $key . "\r";
        //     echo number_format($stat->hashrate, 2) . "\r";
        //     echo $stat->temp . "\r";
        //     echo $stat->fan . "\r";
        // } 
// }

echo "<pre>";

foreach ($parser->miner_data_results as $name => $miner) 
{ 

    echo "# HELP miner_total_hashrate Total miner process hashrate across all devices (hashes/sec). \r";
    echo "# TYPE miner_total_hashrate gauge \r";
    echo 'miner_total_hashrate{host="'.$name.'",version="'.$miner->version.'"} '.$parser->global_hashrate ." \r";
    
    echo "# HELP miner_process_runtime Number of seconds miner process has been running. \r";
    echo "# TYPE miner_process_runtime gauge \r";
    echo 'miner_process_runtime{host="'.$name.'",version="'.$miner->version.'"} '.$miner->uptime_raw." \r";

    echo "# HELP miner_shares_total Total number of shares across all devices. \r";
    echo "# TYPE miner_shares_total counter \r";
    echo 'miner_shares_total{host="'.$name.'",version="'.$miner->version.'",status="found"} ' . $miner->stats->shares ." \r";
    echo 'miner_shares_total{host="'.$name.'",version="'.$miner->version.'",status="rejected"} ' . $miner->stats->rejected ." \r";
    echo 'miner_shares_total{host="'.$name.'",version="'.$miner->version.'",status="failed"} ' . $miner->stats->stale ." \r";

    foreach ($miner->card_stats as $key => $stat) 
    { 
        echo "# HELP miner_device_hashrate Device hash rate in hashes/sec. \r";
        echo "# TYPE miner_device_hashrate gauge \r";
        echo 'miner_device_hashratehost{host="'.$name.'",version="'.$miner->version.'",id="'.$key.'"} ' . number_format($stat->hashrate, 2) . " \r";

        echo "# HELP miner_device_temp_celsius Device temperature in degrees celsius \r";
        echo "# TYPE miner_device_temp_celsius gauge \r";        
        echo 'miner_device_temp_celsius{host="'.$name.'",version="'.$miner->version.'",id="'.$key.'"}' . $stat->temp . " \r";


        echo "# HELP miner_device_fanspeed Device fanspeed (percentage 0-100). \r";
        echo "# TYPE miner_device_fanspeed gauge \r";
        echo 'miner_device_fanspeed{host="'.$name.'",version="'.$miner->version.'",id="'.$key.'"}' . $stat->fan . "\r";
     } 
}

echo "# EOF </pre>";





?>