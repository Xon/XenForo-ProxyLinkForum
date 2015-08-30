<?php

class SV_ProxyLinkForum_Installer
{
    public static function install($existingAddOn, $addOnData)
    {
        $version = isset($existingAddOn['version_id']) ? $existingAddOn['version_id'] : 0;

        SV_Utils_Install::addColumn("xf_link_forum", "sv_proxy_node_id", "INT NOT NULL DEFAULT 0");

        return true;
    }

    public static function uninstall()
    {
        SV_Utils_Install::dropColumn("xf_link_forum", "sv_proxy_node_id");

        return true;
    }
}