# PhoenixStats for PhoenixMiner-AMD
This is a containerised version of `claymore-phoenixminer-web-stats`, a simple PHP web stats page that utilises the remote monitoring ports (JSON-RPC API) available on PhoenixMiner. It was containerised for use on Unraid but should work on other hosts as well. This container allows you to view the following stats pulled from your miners:

* Global hash rate for all miners
* Miner uptime
* Miner version
* Connected pool and port
* Submitted, stale and invalid shares
* Per GPU hash rates
* Per GPU temperatures
* Per GPU fan percentages
* Auto Refreshing
   
## Support the original developer

All I did was containerise a web-app made by someone else and customise it a little to work with my PhoenixMiner-AMD container. You can support the original developer by clicking [here](https://github.com/osmankuzucu/claymore-phoenixminer-web-stats#how-can-i-help).

## Final notes
If you notice any bugs, feel free to open an Issue or a pull request. For support with using this on Unraid, you can reach me best via the [support thread](https://forums.unraid.net/topic/104589-support-lnxd-phoenixminer-amd/) on the Unraid Community Forums.