<?php declare(strict_types = 1);
namespace noxkiwi\value\Interfaces;

/**
 * I am the interface for every value object.
 *
 * @package      noxkiwi\value\Interfaces
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2016 - 2018 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
interface ValueInterface
{
    /**
     * I will releive the contents of the value object instance.
     *
     * @return       mixed
     */
    public function get() : mixed;
}
