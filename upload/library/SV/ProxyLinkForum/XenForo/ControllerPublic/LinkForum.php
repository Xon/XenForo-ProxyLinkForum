<?php
class SV_ProxyLinkForum_XenForo_ControllerPublic_LinkForum extends XFCP_SV_ProxyLinkForum_XenForo_ControllerPublic_LinkForum
{
	protected function _getLinkOrError($linkId)
	{        
		$link = parent::_getLinkOrError($linkId);
        
        if (isset($link['sv_is_proxy']) && is_numeric($link['link_url']))
        {
            $link['link_url'] = XenForo_Link::buildPublicLink('forums', array('node_id' => $link['link_url']));
        }

		return $link;
	}
}
