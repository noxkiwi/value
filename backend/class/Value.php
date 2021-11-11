<?php declare(strict_types = 1);
namespace noxkiwi\value;

use Exception;
use JetBrains\PhpStorm\Immutable;
use noxkiwi\core\Exception\InvalidArgumentException;
use noxkiwi\validator\Validator;
use noxkiwi\value\Interfaces\ValueInterface;
use function class_exists;
use const E_ERROR;
use const E_WARNING;

/**
 * I am the base value object.
 * I will only be constructed successfully with a valid $value.
 * If $value conflicts against the Validator, I will throw an InvalidArgumentException.
 * I am immutable. If ever constructed, the value that I hold is not writeable anymore.
 *
 * @package      noxkiwi\value
 * @example      Once created, you can use Value objects as method parameters and skip validation:
 *     private function createUser(UsernameValue $userName, EmailValue $email) : UseridValue
 *     {
 *         // MAGIC
 *         return new UseridValue($userId)
 *     }
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2016 - 2021 noxkiwi
 * @version      1.2.1
 * @link         https://nox.kiwi/
 */
#[Immutable] abstract class Value implements ValueInterface
{
    /** @var mixed I contain the validated value. */
    #[Immutable]
    private mixed $value;

    /**
     * I will create the instance and fill in the value.
     * <br />If the value is invalid, I will throw an InvalidArgumentException containing the errors that occured.
     * <br />Once the content is set, it will be immutable inside this instance.
     *
     * @param mixed      $value
     * @param array|null $options
     *
     * @throws \noxkiwi\core\Exception\InvalidArgumentException
     */
    final public function __construct(mixed $value, array $options = null)
    {
        $options ??= [];
        $errors  = self::getValidator()->validate($value, $options);
        if (! empty($errors)) {
            throw new InvalidArgumentException('EXCEPTION_CONSTRUCT_INVALID_DATA', E_WARNING, $errors);
        }
        $this->value = $value;
    }

    /**
     * I will solely create the validator instance and return it.
     * @throws \noxkiwi\core\Exception\InvalidArgumentException
     * @return \noxkiwi\validator\Validator
     */
    private static function getValidator(): Validator
    {
        $validatorName = str_replace(['Value', 'value'], ['Validator', 'validator'], static::class);
        if (! class_exists($validatorName)) {
            throw new InvalidArgumentException("Validator $validatorName was not found.", E_ERROR);
        }
        try {
            /** @var \noxkiwi\validator\Validator $validatorName */
            return $validatorName::get()->reset();
        } catch (Exception) {
            throw new InvalidArgumentException("Validator $validatorName was not found.", E_ERROR);
        }
    }

    /**
     * @inheritDoc
     */
    final public function get(): mixed
    {
        return $this->value;
    }
}
