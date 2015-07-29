<?php
class SV_ProxyLinkForum_XenForo_ControllerAdmin_LinkForum extends XFCP_SV_ProxyLinkForum_XenForo_ControllerAdmin_LinkForum
{
    public function actionSave()
    {
        SV_ProxyLinkForum_Globals::$sv_proxy_node_id = $this->_input->filterSingle('sv_proxy_node_id', XenForo_Input::UINT);
        return parent::actionSave();
    }
}
