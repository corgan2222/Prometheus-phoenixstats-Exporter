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

// echo  $parser->miner_count . "\n";
// echo  $parser->global_hashrate . "\n";

// foreach ($parser->miner_data_results as $name => $miner) 
// { 
        // echo $name . "\n";
        // echo $parser->miner_status->{$name}. "\n";
        // echo $miner->coin. "\n";
        // echo $miner->version. "\n";
        // echo $miner->uptime. "\n";
        // echo $miner->uptime_raw. "\n";
        // echo $miner->pool. "\n";
        // echo $miner->hostname. "\n";
        // echo $miner->port. "\n";
        // echo number_format($miner->stats->shares, 0). "\n";
        // echo number_format($miner->stats->rejected, 0) . "\n";
        // echo number_format($miner->stats->stale, 0). "\n";

        // foreach ($miner->card_stats as $key => $stat) 
        // { 
        //     echo $key . "\n";
        //     echo number_format($stat->hashrate, 2) . "\n";
        //     echo $stat->temp . "\n";
        //     echo $stat->fan . "\n";
        // } 
// }
#curl http://192.168.2.254:9192/metrics/ | promtool check metrics
#echo "<pre>";

foreach ($parser->miner_data_results as $name => $miner) 
{ 

    echo "# HELP miner_total_hashrate Total miner process hashrate across all devices (hashes/sec). \n";
    echo "# TYPE miner_total_hashrate gauge\n";
    echo 'miner_total_hashrate{host="'.$name.'",version="'.$miner->version.'"} '.$parser->global_hashrate ." ".(time()*1000)."\n";
    
    echo "# HELP miner_process_runtime Number of seconds miner process has been running. \n";
    echo "# TYPE miner_process_runtime gauge\n";
    echo 'miner_process_runtime{host="'.$name.'",version="'.$miner->version.'"} '.$miner->uptime_raw." ".(time()*1000)."\n";

    echo "# HELP miner_shares_total Total number of shares across all devices. \n";
    echo "# TYPE miner_shares_total counter\n";
    echo 'miner_shares_total{host="'.$name.'",version="'.$miner->version.'",status="found"} ' . $miner->stats->shares ." ".(time()*1000)."\n";
    echo 'miner_shares_total{host="'.$name.'",version="'.$miner->version.'",status="rejected"} ' . $miner->stats->rejected ." ".(time()*1000)."\n";
    echo 'miner_shares_total{host="'.$name.'",version="'.$miner->version.'",status="failed"} ' . $miner->stats->stale ." ".(time()*1000)."\n";

    foreach ($miner->card_stats as $key => $stat) 
    { 
        echo "# HELP miner_device_hashratehost Device hash rate in hashes/sec. \n";
        echo "# TYPE miner_device_hashratehost gauge\n";
        echo 'miner_device_hashratehost{host="'.$name.'",version="'.$miner->version.'",id="'.$key.'"} ' . number_format($stat->hashrate, 2) ." ".(time()*1000)."\n";

        echo "# HELP miner_device_temp_celsius Device temperature in degrees celsius \n";
        echo "# TYPE miner_device_temp_celsius gauge\n";        
        echo 'miner_device_temp_celsius{host="'.$name.'",version="'.$miner->version.'",id="'.$key.'"}' . $stat->temp ." ".(time()*1000)."\n";


        echo "# HELP miner_device_fanspeed Device fanspeed (percentage 0-100). \n";
        echo "# TYPE miner_device_fanspeed gauge\n";
        echo 'miner_device_fanspeed{host="'.$name.'",version="'.$miner->version.'",id="'.$key.'"}' . $stat->fan ." ".(time()*1000)."\n";
     } 
}

echo "#EOF"."\n";





