<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Caster;

use Symfony\Component\VarDumper\Cloner\Stub;

/**
 * Casts SPL related classes to array representation.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class SplCaster
{
    private static $splFileObjectFlags = array(
        \SplFileObject::DROP_NEW_LINE => 'DROP_NEW_LINE',
        \SplFileObject::READ_AHEAD => 'READ_AHEAD',
        \SplFileObject::SKIP_EMPTY => 'SKIP_EMPTY',
        \SplFileObject::READ_CSV => 'READ_CSV',
    );

    public static function castArrayObject(\ArrayObject $c, array $a, Stub $stub, $isNested)
    {
        return self::castSplArray($c, $a, $stub, $isNested);
    }

    public static function castArrayIterator(\ArrayIterator $c, array $a, Stub $stub, $isNested)
    {
        return self::castSplArray($c, $a, $stub, $isNested);
    }

    public static function castHeap(\Iterator $c, array $a, Stub $stub, $isNested)
    {
        $a += array(
            Caster::PREFIX_VIRTUAL.'heap' => iterator_to_array(clone $c),
        );

        return $a;
    }

    public static function castDoublyLinkedList(\SplDoublyLinkedList $c, array $a, Stub $stub, $isNested)
    {
        $prefix = Caster::PREFIX_VIRTUAL;
        $mode = $c->getIteratorMode();
        $c->setIteratorMode(\SplDoublyLinkedList::IT_MODE_KEEP | $mode & ~\SplDoublyLinkedList::IT_MODE_DELETE);

        $a += array(
            $prefix.'mode' => new ConstStub((($mode & \SplDoublyLinkedList::IT_MODE_LIFO) ? 'IT_MODE_LIFO' : 'IT_MODE_FIFO').' | '.(($mode & \SplDoublyLinkedList::IT_MODE_DELETE) ? 'IT_MODE_DELETE' : 'IT_MODE_KEEP'), $mode),
            $prefix.'dllist' => iterator_to_array($c),
        );
        $c->setIteratorMode($mode);

        return $a;
    }

    public static function castFileInfo(\SplFileInfo $c, array $a, Stub $stub, $isNested)
    {
        static $map = array(
            'path' => 'getPath',
            'filename' => 'getFilename',
            'basename' => 'getBasename',
            'pathname' => 'getPathname',
            'extension' => 'getExtension',
            'realPath' => 'getRealPath',
            'aTime' => 'getATime',
            'mTime' => 'getMTime',
            'cTime' => 'getCTime',
            'inode' => 'getInode',
            'size' => 'getSize',
            'perms' => 'getPerms',
            'owner' => 'getOwner',
            'group' => 'getGroup',
            'type' => 'getType',
            'writable' => 'isWritable',
            'readable' => 'isReadable',
            'executable' => 'isExecutable',
            'file' => 'isFile',
            'dir' => 'isDir',
            'link' => 'isLink',
            'linkTarget' => 'getLinkTarget',
        );

        $prefix = Caster::PREFIX_VIRTUAL;

        foreach ($map as $key => $accessor) {
            try {
                $a[$prefix.$key] = $c->$accessor();
            } catch (\Exception $e) {
            }
        }

        if (isset($a[$prefix.'realPath'])) {
            $a[$prefix.'realPath'] = new LinkStub($a[$prefix.'realPath']);
        }

        if (isset($a[$prefix.'perms'])) {
         