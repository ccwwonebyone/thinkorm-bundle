<?php
namespace OneThink\OrmBundle;

use OneThink\OrmBundle\DataCollector\OneThinkOrmCollector;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use think\facade\Db;

class OneThinkOrmBundle extends Bundle
{
    public function boot()
    {
        parent::boot();
        $defalut = $this->container->getParameter('think_orm.default');
        $connections = $this->container->getParameter('think_orm.connections');
        $this->setThinkOrmDbConfig($defalut, $connections);
    }

    /**
     * 设置数据库信息
     * @param string $defalut
     * @param array $connections
     * @return void
     */
    public function setThinkOrmDbConfig(string $defalut, array $connections)
    {
        Db::setConfig([
            'defalut' => $defalut,
            'connections' => $connections
        ]);
        $this->setDbListen($defalut, $connections);
    }

    /**
     * 设置数据库信息监听
     * @param string $defalut
     * @param array $connections
     * @param void
     */
    public function setDbListen(string $defalut, array $connections)
    {
        if(isset($connections[$defalut]['trigger_sql']) && (bool)$connections[$defalut]['trigger_sql']){
            Db::listen(function($sql, $runtime, $master){
                OneThinkOrmCollector::setSqlInfo($sql, $runtime, $master);
            });
        }
    }
}
