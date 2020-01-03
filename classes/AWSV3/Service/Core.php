<?php defined('SYSPATH') OR die('No direct script access.');

require_once AWSV3_AUTOLOAD;

class AWSV3_Service_Core {
    public static $_resource = null;
    protected static $_instances = array();

    /**
     * Create instance of an AWS resource
     */
    public static function instance($type = null)
    {
        if (empty($type))
        {
            $class = get_called_class();
            $type = $class::$_resource;
        }

        if (empty(self::$_instances[$type]))
        {
            self::$_instances[$type] = AWS::factory($type);
        }

        return self::$_instances[$type];
    }

    /**
     * Creates alias to all native methods of the resource.
     *
     * @param   string  $method  method name
     * @param   mixed   $args    arguments
     * @return  mixed
     */
    public function __call($method, $args)
    {
        $class = get_called_class();
        $obj = $class::instance();

        $method = new ReflectionMethod($obj, $method);
        return $method->invokeArgs($obj, $args);
    }
}