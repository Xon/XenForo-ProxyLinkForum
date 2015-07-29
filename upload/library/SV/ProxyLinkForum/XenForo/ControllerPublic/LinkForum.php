<?php
class SV_ProxyLinkForum_XenForo_ControllerPublic_LinkForum extends XFCP_SV_ProxyLinkForum_XenForo_ControllerPublic_LinkForum
{
    protected function _getLinkOrError($linkId)
    {
        $link = parent::_getLinkOrError($linkId);

        if (!!empty($link['sv_proxy_node_id']) && is_numeric($link['sv_proxy_node_id']))
        {
            $link['link_url'] = XenForo_Link::buildPublicLink('forums', array('node_id' => $link['sv_proxy_node_id']));
        }

        return $link;
    }
}
