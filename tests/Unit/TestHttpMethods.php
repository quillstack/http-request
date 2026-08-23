<?php

declare(strict_types=1);

namespace Quillstack\HttpRequest\Tests\Unit;

use Quillstack\HttpRequest\HttpRequest;
use Quillstack\UnitTests\AssertEqual;
use Quillstack\UnitTests\Types\AssertBoolean;

/**
 * A package which only names things has little to get wrong, but it does have one thing: the
 * list has to hold every method, and a method has to be in the list.
 */
class TestHttpMethods
{
    public function __construct(
        private AssertEqual $assertEqual,
        private AssertBoolean $assertBoolean
    ) {
        //
    }

    /**
     * Every constant naming a method is in the list. One added and left out of it is a method
     * the router will not offer and a 405 which will not mention it.
     */
    public function everyMethodIsInTheList()
    {
        $constants = (new \ReflectionClass(HttpRequest::class))->getConstants();
        $methods = [];

        foreach ($constants as $name => $value) {
            if (str_starts_with($name, 'METHOD_')) {
                $methods[] = $value;
            }
        }

        sort($methods);
        $available = HttpRequest::AVAILABLE_METHODS;
        sort($available);

        $this->assertEqual->equal($methods, $available);
    }

    /**
     * And nothing is in the list which is not one of them.
     */
    public function nothingElseIsInIt()
    {
        foreach (HttpRequest::AVAILABLE_METHODS as $method) {
            $this->assertBoolean->isTrue(
                defined(HttpRequest::class . '::METHOD_' . $method)
            );
        }
    }

    /**
     * The names are the ones HTTP uses, upper case and spelled the usual way.
     */
    public function theNamesAreTheOnesHttpUses()
    {
        $this->assertEqual->equal(
            ['GET', 'POST', 'HEAD', 'PUT', 'DELETE', 'PATCH', 'OPTIONS'],
            HttpRequest::AVAILABLE_METHODS
        );
    }
}
