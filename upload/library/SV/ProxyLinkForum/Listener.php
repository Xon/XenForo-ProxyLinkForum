<?php

class SV_ProxyLinkForum_Listener
{
    const AddonNameSpace = 'SV_ProxyLinkForum';

    public static function install($existingAddOn, $addOnData)
    {
        $version = isset($existingAddOn['version_id']) ? $existingAddOn['version_id'] : 0;

        SV_ProxyLinkForum_Install::addColumn("xf_link_forum", "sv_is_proxy", "TINYINT(3) NOT NULL DEFAULT 0");

        return true;
    }

    public static function uninstall()
    {
        SV_ProxyLinkForum_Install::dropColumn("xf_link_forum", "sv_is_proxy");

        return true;
    }
    
    public static function load_class($class, array &$extend)
    {
        $extend[] = self::AddonNameSpace.'_'.$class;
    }
}
