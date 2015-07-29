<?php
class SV_ProxyLinkForum_XenForo_ControllerAdmin_LinkForum extends XFCP_SV_ProxyLinkForum_XenForo_ControllerAdmin_LinkForum
{
    public function actionSave()
    {
        SV_ProxyLinkForum_Globals::$sv_is_proxy = $this->_input->filterSingle('sv_is_proxy', XenForo_Input::BOOLEAN);
        return parent::actionSave();
    }
}
