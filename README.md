# Value - Ensuring Valid Data Across Your Project
## It Began With a Mistake

In 2016, during the hectic initial phase of our startup, we made a critical mistake that impacted several months of invoice provisions for our sales managers. We mistakenly applied the netToGross tax calculation for sales tax multiple times, even on already gross values, leading to significant errors.
This issue went unnoticed for several months, causing considerable trouble. As a result, we developed two separate libraries to ensure valid values across all our platforms.

The first commitment was to ensure valid parameters across the entire projects by creating the Value library. Then, as a logical conclusion, the next step was to implement a standard on how data has to be validated.

```php
// The scenario is real, but this example is much simplified, of course.
function netToGross(float $net): float {
    return $net * 1.15;
}
```

# Validator 💘 Value
### Validator
- Checks input for integrity.
- Returns one or more detailed pieces of information on why an input is problematic.

### Value
- Can only be constructed with valid input.
- Once constructed, the input is immutable, ensuring integrity during runtime.

## Just an Example
Once constructed, our Value objects are immutable. This immutability allows us to use them confidently as parameters and return types, relying on their integrity throughout our application. We replaced standard types like int, float, and string with our Value objects to enhance data integrity and validation.
Example Value Objects:

    NetValue
    GrossValue
    EmailValue
    IbanValue
    And many more...

Here’s how you can use these Value objects:

```php
class Taxes {
    private const SALES_TAX = 0.15; // Correcting to decimal representation for percentage

    /**
     * Converts a NetValue to a GrossValue by applying the sales tax.
     *
     * @param NetValue $netValue The net value object.
     * @return GrossValue The gross value object.
     */
    public static function getGrossFromNet(NetValue $netValue): GrossValue {
        return new GrossValue($netValue->get() * (1 + self::SALES_TAX));
    }
}
```

In this example:
`NetValue` and `GrossValue` both are immutable objects representing net and gross monetary values, respectively.
The `getGrossFromNet` method converts a net value to a gross value by applying the sales tax, ensuring that the calculation is accurate and reliable.

By using these Value objects, we ensure that our data is validated and consistent across our application, preventing errors like the ones we experienced in the past.


## Let's Connect!
If you're excited about the possibility of working together or simply want to discuss innovative ideas, I'd love to hear from you.
Don't hesitate to reach out via [email](mailto:jan.nox@pm.me).

Let's create something ***amazing*** together!
