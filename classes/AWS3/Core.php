<?php defined('SYSPATH') OR die('No direct script access.');

require_once AWSV3_AUTOLOAD;

class AWS3_Core {
    /**
     * Default configuration path.
     */
    const DEFAULT_CONFIG_PATH = 'aws';

    /**
     * Configuration group to be used.
     */
    protected static $_config_group = 'default';

    /**
     * @param string $group configuration group to be used.
     * @param string $global_params
     */
    public static function factory($service = null, $group = null, array $global_params = array())
    {
        if (empty($group))
        {
            $group = self::$_config_group;
        }

        if (is_string($group))
        {
            $config = Kohana::$config->load(self::DEFAULT_CONFIG_PATH)->as_array();

            // load configuration from kohana config file.
            if (empty($config[$group]))
            {
                throw new Kohana_Exception('Cannot find :class configuration group `:group` on file `:file`',
                    array(':class' => __CLASS__, ':group' => $group, ':file' => self::DEFAULT_CONFIG_PATH));

                return false;
            }

            $group = $config[$group];
        }

        $sharedConfig['version'] = 'default';
        $sharedConfig['region'] = $group['region'];
        if (isset($group['key']) && isset($group['secret'])) {
            $sharedConfig['credentials'] = new Aws\Credentials\Credentials($group['key'], $group['secret']);
        }

        // Create an SDK class used to share configuration across clients.
        $sdk = new Aws\Sdk($sharedConfig);
        if (!empty($service)) {
            return $sdk->createClient($service);
        }

        return $sdk;
    }
}