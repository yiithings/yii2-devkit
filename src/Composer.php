<?php

namespace yiithings\devkit;

use Composer\Script\Event;

class Composer
{
    public static function postAutoloadDump(Event $event)
    {
        if ($event->isDevMode()) {
            exec(dirname($event->getComposer()->getConfig()->get('vendor-dir')) . '/yii devkit/ide-helper', $out,
                $exitCode);
            array_walk($out, function (&$line) use ($exitCode) {
                $line = $exitCode == 0 ? "<info>{$line}</info>" : "<error>{$line}</error>";
            });
            $event->getIO()->write($out, true);
        } else {
            $event->getIO()->write('Skip generate ide helper code.', true);
        }
    }
}