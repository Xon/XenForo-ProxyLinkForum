<?php
class SV_ProxyLinkForum_XenForo_DataWriter_LinkForum extends XFCP_SV_ProxyLinkForum_XenForo_DataWriter_LinkForum
{
    protected function _getFields()
    {
        $fields = parent::_getFields();
        $fields['xf_link_forum']['sv_is_proxy'] = array('type' => self::TYPE_UINT_FORCED, 'default' => 0);
        return $fields;
    }

    protected function _preSave()
    {
        if (SV_ProxyLinkForum_Globals::$sv_is_proxy !== null)
        {
            $this->set('sv_is_proxy', SV_ProxyLinkForum_Globals::$sv_is_proxy);
        }
        parent::_preSave();
    }
}
