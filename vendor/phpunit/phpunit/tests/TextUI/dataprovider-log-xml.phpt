<?php

namespace XdgBaseDir;

/**
 * Simple implementation of the XDG standard http://standards.freedesktop.org/basedir-spec/basedir-spec-latest.html
 *
 * Based on the python implementation https://github.com/takluyver/pyxdg/blob/master/xdg/BaseDirectory.py
 *
 * Class Xdg
 * @package ShopwareCli\Application
 */
class Xdg
{
    const S_IFDIR = 040000; // directory
    const S_IRWXO = 00007;  // rwx other
    const S_IRWXG = 00056;  // rwx group
    const RUNTIME_DIR_FALLBACK = 'php-xdg-runtime-dir-fallback-';

    /**
     * @return string
     */
    public function getHomeDir()
    {
        return getenv('HOME') ?: (getenv('HOMEDRIVE') . DIRECTORY_SEPARATOR . getenv('HOMEPATH'));
    }

    /**
     * @return string
     */
    public function getHomeConfigDir()
    {
        $path = getenv('XDG_CONFIG_HOME') ?: $this->getHomeDir() . DIRECTORY_SEPARATOR . '.config';

        return $path;
    }

    /**
     * @return string
     */
    public function getHomeDataDir()
    {
        $path = getenv('XDG_DATA_HOME') ?: $this->getHomeDir() . DIRECTORY_SEPARATOR . '.local' . DIRECTORY_SEPARATOR . 'share';

        return $path;
    }

    /**
     * @return array
     */
    public function getConfigDirs()
    {
        $configDirs = getenv('XDG_CONFIG_DIRS') ? explode(':', getenv('XDG_CONFIG_DIRS')) : array('/etc/xdg');

        $paths = array_merge(array($this->getHomeConfigDir()), $configDirs);

        return $paths;
    }

    /**
     * @return array
     */
    public function getDataDirs()
    {
        $dataDirs = getenv('XDG_DATA_DIRS') ? explode(':', getenv('XDG_DATA_DIRS')) : array('/usr/local/share', '/usr/share');

        $paths = array_merge(array($this->getHomeDataDir()), $dataDirs);

        return $paths;
    }

    /**
     * @return string
     */
    public function getHomeCacheDir()
    {
        $path = getenv('XDG_CACHE_HOME') ?: $this->getHomeDir() . DIRECTORY_SEPARATOR . '.cache';

        return $path;

    }

    public fu