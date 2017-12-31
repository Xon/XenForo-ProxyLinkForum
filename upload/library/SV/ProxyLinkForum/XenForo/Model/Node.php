<?php

class SV_ProxyLinkForum_XenForo_Model_Node extends XFCP_SV_ProxyLinkForum_XenForo_Model_Node
{
    public function getNodeTotalItemCounts(array $parentNode = null)
    {
        SV_ProxyLinkForum_Globals::$disableLinkProxy = true;
        return parent::getNodeTotalItemCounts($parentNode);
    }
}
