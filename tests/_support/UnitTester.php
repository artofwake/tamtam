<?php

use Codeception\Stub;
use GuzzleHttp\Client;


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class UnitTester extends \Codeception\Actor
{
    use _generated\UnitTesterActions;

   /**
    * Define custom actions here
    */

    /**
     * @param callable $callable
     * @return Client
     * @throws \Exception
     */
    public function buildClient(callable $callable) : Client
    {
        /**
         * @var Client $stub
         */
        $stub = Stub::make(Client::class, ['request' => $callable]);
        return $stub;
    }
}
