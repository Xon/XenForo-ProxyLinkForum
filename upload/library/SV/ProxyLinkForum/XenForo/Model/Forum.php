<?php
class SV_ProxyLinkForum_XenForo_Model_Forum extends XFCP_SV_ProxyLinkForum_XenForo_Model_Forum
{
    public function getExtraForumDataForLinkNodes(array $nodeIds, array $fetchOptions = array())
    {
        if (!$nodeIds)
        {
            return array();
        }

        $joinOptions = $this->prepareForumJoinOptions($fetchOptions);

        return $this->fetchAllKeyed('
            SELECT forum.*, link_forum.node_id, link_forum.sv_proxy_node_id
                ' . $joinOptions['selectFields'] . '
            FROM xf_forum AS forum
            INNER JOIN xf_link_forum AS link_forum on link_forum.sv_proxy_node_id = forum.node_id
            INNER JOIN xf_node AS node ON (node.node_id = forum.node_id)
            ' . $joinOptions['joinTables'] . '
            WHERE link_forum.node_id IN (' . $this->_getDb()->quote($nodeIds) . ') and link_forum.sv_proxy_node_id <> 0
        ', 'node_id');
    }
}
