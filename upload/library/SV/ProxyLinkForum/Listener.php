<?php

class SV_ProxyLinkForum_Listener
{
    public static function load_class($class, array &$extend)
    {
        $extend[] = 'SV_ProxyLinkForum_' . $class;
    }
}

