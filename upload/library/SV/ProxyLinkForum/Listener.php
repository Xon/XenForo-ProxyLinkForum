<?php

class SV_ProxyLinkForum_Listener
{
    const AddonNameSpace = 'SV_ProxyLinkForum_';

    public static function load_class($class, array &$extend)
    {
        $extend[] = self::AddonNameSpace.$class;
    }
}

