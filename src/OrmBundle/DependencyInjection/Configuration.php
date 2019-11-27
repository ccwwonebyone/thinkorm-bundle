<?php
namespace OneThink\OrmBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('think_orm');
        $node = $treeBuilder->getRootNode();
        $node->children()
                ->scalarNode('default')->end()
                ->end();
        $node->fixXmlConfig('connection')
                ->children()
                    ->arrayNode('connections')
                        ->useAttributeAsKey('name')
                        ->arrayPrototype()
                            ->children()
                                ->enumNode('type')
                                    ->values(['mysql', 'sqlite', 'pgsql', 'sqlsrv', 'mongodb', 'oracle'])
                                    ->info('连接类型')
                                ->end()
                                ->scalarNode('hostname')->defaultValue('127.0.0.1')->end()
                                ->scalarNode('username')->end()
                                ->scalarNode('database')->end()
                                ->scalarNode('hostport')->end()
                                ->scalarNode('password')->end()
                                ->scalarNode('dsn')->end()
                                ->scalarNode('params')->end()
                                ->scalarNode('charset')->defaultValue('utf8')->end()
                                ->scalarNode('prefix')->defaultValue('')->end()
                                ->scalarNode('debug')->defaultFalse(false)->end()
                                ->enumNode('deploy')
                                    ->values([0, 1])
                                    ->defaultValue(0)
                                    ->info('数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)')
                                ->end()
                                ->booleanNode('rw_separate')
                                    ->defaultFalse()
                                    ->info('数据库读写是否分离 主从式有效')
                                ->end()
                                ->integerNode('master_num')
                                    ->defaultValue(1)
                                    ->info('读写分离后 主服务器数量')
                                ->end()
                                ->scalarNode('slave_no')->end()
                                ->booleanNode('fields_strict')
                                    ->defaultTrue()
                                    ->info('是否严格检查字段是否存在')
                                ->end()
                                ->scalarNode('auto_timestamp')
                                    ->defaultFalse()
                                    ->info('自动写入时间戳字段')
                                ->end()
                                ->booleanNode('break_reconnect')
                                    ->defaultFalse()
                                    ->info('是否开启断线重连')
                                ->end()
                                ->booleanNode('fields_cache')
                                    ->defaultFalse()
                                    ->info('是否开启字段缓存')
                                ->end()
                                ->scalarNode('schema_cache_path')
                                    ->info('字段缓存目录')
                                ->end()
                                ->booleanNode('trigger_sql')
                                    ->defaultTrue()
                                    ->info('是否开启SQL监听（日志）')
                                ->end()
                            ->end()
                        ->end()
                ->end();
        return $treeBuilder;
    }
}
