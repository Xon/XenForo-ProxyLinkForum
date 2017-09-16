<?php

class SV_ProxyLinkForum_XenForo_ControllerAdmin_LinkForum extends XFCP_SV_ProxyLinkForum_XenForo_ControllerAdmin_LinkForum
{
    public function actionSave()
    {
        SV_ProxyLinkForum_Globals::$sv_proxy_node_id = $this->_input->filterSingle(
            'sv_proxy_node_id', XenForo_Input::UINT
        );

        return parent::actionSave();
    }

    public function actionEdit()
    {
        $response = parent::actionEdit();
        if ($response instanceof XenForo_ControllerResponse_View)
        {
            $this->addLinkProxyBits($response);
        }

        return $response;
    }

    public function actionDeleteConfirm()
    {
        $response = parent::actionDeleteConfirm();
        if ($response instanceof XenForo_ControllerResponse_View)
        {
            $this->addLinkProxyBits($response);
        }

        return $response;
    }

    protected function addLinkProxyBits(XenForo_ControllerResponse_View $response)
    {
        $nodeModel = $this->_getNodeModel();
        $link = $response->params['link'];
        if (!isset($link['sv_proxy_node_id']) || !is_numeric($link['sv_proxy_node_id']))
        {
            $link['sv_proxy_node_id'] = 0;
        }
        $nodes = $nodeModel->getPossibleParentNodes($link);
        $nodes[0]['title'] = new XenForo_Phrase("sv_do_not_proxy");
        $response->params['proxyNodeOptions'] = $nodeModel->getNodeOptionsArray(
            $nodes, $link['sv_proxy_node_id'], true
        );
    }
}
