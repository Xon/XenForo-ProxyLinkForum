<?php

class SV_ProxyLinkForum_XenForo_NodeHandler_LinkForum extends XFCP_SV_ProxyLinkForum_XenForo_NodeHandler_LinkForum
{
    public function renderNodeForTree(XenForo_View $view, array $node, array $permissions, array $renderedChildren, $level)
    {
        if (empty($node['sv_proxy_node_id']))
        {
            return parent::renderNodeForTree($view, $node, $permissions, $renderedChildren, $level);
        }

        $templateLevel = ($level <= 2 ? $level : 'n');

        return $view->createTemplateObject(
            'node_forum_level_' . $templateLevel, [
            'level'            => $level,
            'forum'            => $node,
            'renderedChildren' => $renderedChildren
        ]
        );
    }

    public function getPushableDataForNode(array $node, array $childPushable, array $permissions)
    {
        if (empty($node['sv_proxy_node_id']))
        {
            return parent::getPushableDataForNode($node, $childPushable, $permissions);
        }

        return $this->_getForumLikePushableData($node, $childPushable);
    }

    /**
     * @param int[] $nodeIds
     * @return array
     */
    public function getExtraDataForNodes(array $nodeIds)
    {
        if (SV_ProxyLinkForum_Globals::$disableLinkProxy)
        {
            return [];
        }
        $userId = XenForo_Visitor::getUserId();
        $permissionCombinationId = XenForo_Visitor::getPermissionCombinationId();
        $forumFetchOptions = ['readUserId' => $userId, 'permissionCombinationId' => $permissionCombinationId];

        $nodes = $this->_getForumModel()->getExtraForumDataForLinkNodes($nodeIds, $forumFetchOptions);
        foreach ($nodes as $key => &$node)
        {
            $proxyPermissions = XenForo_Permission::unserializePermissions($node['node_permission_cache']);
            unset($node['node_permission_cache']);
            if (!XenForo_Permission::hasContentPermission($proxyPermissions, 'viewOthers'))
            {
                unset($nodes[$key]);
            }
        }

        return $nodes;
    }

    public function prepareNode(array $node)
    {
        if (empty($node['sv_proxy_node_id']))
        {
            return parent::prepareNode($node);
        }

        return $this->_getForumModel()->prepareForum($node);
    }


    /** @var SV_ProxyLinkForum_XenForo_Model_Forum|null  */
    protected $_forumModel = null;

    /**
     * @return SV_ProxyLinkForum_XenForo_Model_Forum|XenForo_Model
     */
    protected function _getForumModel()
    {
        if ($this->_forumModel === null)
        {
            $this->_forumModel = XenForo_Model::create('XenForo_Model_Forum');
        }

        return $this->_forumModel;
    }
}
