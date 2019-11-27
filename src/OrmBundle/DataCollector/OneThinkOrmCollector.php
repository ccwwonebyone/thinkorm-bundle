<?php
namespace OneThink\OrmBundle\DataCollector;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class OneThinkOrmCollector extends DataCollector
{
    protected static $sql_infos = [];

    public function collect(\Exception $exception = null)
    {
        $connect = reset(static::$sql_infos);
        $this->data['connect'] = $connect;
        $this->data['sql'] = array_slice(static::$sql_infos, 1);
        $this->data['querycount'] = count($this->data['sql']);
        $this->data['grouped_query_count'] = count(array_unique(array_column($this->data['sql'], 'sql')));
        $this->data['time'] = array_sum(array_column($this->data['sql'], 'runtime'));
    }

    public function reset()
    {
        static::$sql_infos = [];
        $this->data = [];
    }

    public function getName()
    {
        return 'thinkorm';
    }

    public function connect()
    {
        return $this->data['connect'];
    }

    public static function setSqlInfo($sql, $runtime, $master)
    {
        static::$sql_infos[] = [
            'sql' =>  $sql,
            'runtime' => $runtime,
            'master' => $master
        ];
    }

    /**
     * @return int
     */
    public function querycount()
    {
        return $this->data['querycount'];
    }

    public function getTime()
    {
        return $this->data['time'];
    }

    public function groupedQueryCount()
    {
        return $this->data['grouped_query_count'];
    }

    public function queries()
    {
        return $this->data['sql'];
    }

}
