<?php

use Foolz\FoolFrame\Model\Autoloader;
use Foolz\FoolFrame\Model\Context;
use Foolz\Plugin\Event;

class HHVM_RandomAnon
{
    public function run()
    {
        Event::forge('Foolz\Plugin\Plugin::execute#foolz/foolfuuka-plugin-randomanon')
            ->setCall(function($result) {

                /* @var Context $context */
                $context = $result->getParam('context');
                /** @var Autoloader $autoloader */
                $autoloader = $context->getService('autoloader');

                $autoloader->addClass('Foolz\FoolFuuka\Plugins\RandomAnon\Model\RandomAnon', __DIR__.'/classes/model/randomanon.php');
                Event::forge('Foolz\FoolFuuka\Model\Comment::getNameProcessed#var.processedName')
                    ->setCall('Foolz\FoolFuuka\Plugins\RandomAnon\Model\RandomAnon::process')
                    ->setPriority(4);

                Event::forge('Foolz\FoolFuuka\Model\RadixCollection::structure#var.structure')
                    ->setCall(function($result) {
                        $structure = $result->getParam('structure');
                        $structure['plugin_randomanon_enable'] = [
                            'database' => true,
                            'boards_preferences' => true,
                            'type' => 'checkbox',
                            'help' => _i('Enable randomized names')
                        ];
                        $result->setParam('structure', $structure)->set($structure);
                    })->setPriority(4);
            });
    }
}
(new HHVM_RandomAnon())->run();
