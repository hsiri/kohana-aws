<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * You can share the same configuration file with what the instance is currently using
 * via environment variables.
 *
 * return parse_ini_file($_SERVER['AWS_CONFIG']);
 *
 * Remember to set the proper permission to the config file.
 */
$DEFAULT = array(
    'key'    => null,
    'secret' => null,

    // http://docs.aws.amazon.com/general/latest/gr/rande.html
    'region' => 'ap-southeast-1'
);

/**
 * Load from environments
 */
if (!empty($_SERVER['AWS_CONFIG']))
{
    $aws    = parse_ini_file($_SERVER['AWS_CONFIG']);

    // Your Access Key Id
    if (!empty($aws['AWSAccessKeyId']))
    {
        $DEFAULT['key'] = $aws['AWSAccessKeyId'];
        unset($aws['AWSAccessKeyId']);
    }

    // Your Access Key Id
    if (!empty($aws['AWSSecretKey']))
    {
        $DEFAULT['secret'] = $aws['AWSSecretKey'];
        unset($aws['AWSSecretKey']);
    }

    $DEFAULT = Arr::merge($DEFAULT, $aws);
}

/**
 * Copyright 2010-2013 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 * http://aws.amazon.com/apache2.0
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

return array(
    'default' => $DEFAULT,
);