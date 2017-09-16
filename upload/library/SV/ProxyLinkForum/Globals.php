<?php

// This class is used to encapsulate global state between layers without using $GLOBAL[] or
// relying on the consumer being loaded correctly by the dynamic class autoloader
class SV_ProxyLinkForum_Globals
{
    public static $sv_proxy_node_id = null;

    private function __construct() { }
}
