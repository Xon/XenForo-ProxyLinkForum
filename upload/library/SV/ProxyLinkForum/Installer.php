<?php

class SV_ProxyLinkForum_Installer
{
    public static function install($existingAddOn, $addOnData)
    {
        $version = isset($existingAddOn['version_id']) ? $existingAddOn['version_id'] : 0;
        $required = '5.4.0';
        $phpversion = phpversion();
        if (version_compare($phpversion, $required, '<'))
        {
            throw new XenForo_Exception(
                "PHP {$required} or newer is required. {$phpversion} does not meet this requirement. Please ask your host to upgrade PHP",
                true
            );
        }
        if (XenForo_Application::$versionId < 1030070)
        {
            throw new Exception('XenForo 1.3.0+ is Required!');
        }

        SV_Utils_Install::addColumn("xf_link_forum", "sv_proxy_node_id", "INT NOT NULL DEFAULT 0");

        return true;
    }

    public static function uninstall()
    {
        SV_Utils_Install::dropColumn("xf_link_forum", "sv_proxy_node_id");

        return true;
    }
}
