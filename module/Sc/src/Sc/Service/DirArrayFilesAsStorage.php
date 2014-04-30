<?php
namespace Sc\Service;

/**
 * There is a storage dir (passed to constructor)
 * THen there are subdirectories that add some taxonomy
 * to each data
 * Ex : /storage_dir/something
 * The something directory contains each data item
 * which is represented by a file with the item identifier
 * Ex : /storage_dir/some_taxonomy/i_am_that_thing.php
 * i_am_that_thing is used as identifier.
 *
 * Each file should return the data that should
 * be mapped to that identifier.
 * Ex: 
 * `<?php
 * return array('this' => 'is some data');
 * `
 * 
 * What this class does is to try to get all items
 * in some taxonomy dir (ex:some_taxonomy). And it
 * caches all the items in $cache. Each item
 * has its identifier as key, and each collection
 * of items is grouped under the taxonomy key.
 * Ex: 
 * `$this->cache = array(
 *     'some_taxonomy' => array(
 *         'i_am_that_thing' => array('this' => 'is some data')
 *         ...
 *     ),
 *     'some_other_taxonomy' => array(
 *         'i_am_another_thing' => array('that' => 'some data')
 *         'i_am' => array('this' => 'is some other data', ...)
 *         ...
 *     ),
 *     ...
 * );`
 */
class DirArrayFilesAsStorage
{
    /**
     * strlen('.php')
     */
    const DOT_PHP_LEN = 4; 

    protected $storageDir;

    protected $cache;

    public function __construct($storageDir)
    {
        $this->storageDir = $storageDir;
    }

    public function __call($method, $params)
    {
        $isGetter = ('get' === substr($method, 0, 3));
        if (!$isGetter) {
            throw new \Exception( $method . ' not implemented' );
        }

        $what = strtolower(substr($method, 3));
        if (isset($this->cache[$what])) {
            return $this->cache[$what];
        }
        $this->cache[$what] = array();
        $dirIterator        = new \DirectoryIterator($this->storageDir . '/' . $what);

        foreach ($dirIterator as $item) {
            if (!$item->isFile()) continue;
            $fileBasename = $item->getBasename();
            $filePath     = $item->getPath();
            $identifier   = substr($fileBasename, 0, -self::DOT_PHP_LEN);
            $this->cache[$what][$identifier] = include $filePath . '/' . $fileBasename;
        }
        return $this->cache[$what];
    }
}
