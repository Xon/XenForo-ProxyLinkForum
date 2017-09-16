<?php

class SV_ProxyLinkForum_XenForo_DataWriter_LinkForum extends XFCP_SV_ProxyLinkForum_XenForo_DataWriter_LinkForum
{
    protected function _getFields()
    {
        $fields = parent::_getFields();
        $fields['xf_link_forum']['sv_proxy_node_id'] = ['type' => self::TYPE_UINT_FORCED, 'default' => 0];

        return $fields;
    }

    protected function _preSave()
    {
        if (SV_ProxyLinkForum_Globals::$sv_proxy_node_id !== null)
        {
            $this->set('sv_proxy_node_id', SV_ProxyLinkForum_Globals::$sv_proxy_node_id);
        }
        parent::_preSave();
    }
}
