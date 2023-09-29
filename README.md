# PluralConverter

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://opensource.org/licenses/MIT)

PluralConverter is a PHP class that provides functionality for converting singular nouns to their plural form. It handles both regular and irregular nouns using a set of predefined rules.

## Installation

You can install the PluralConverter class using Composer. Run the following command in your project directory:

```
composer require bmt/noun-converter
```

## Usage

To use the NounConverter class, first import the namespace:

```php
use Bmt\NounConverter\NounConverter;
```

Then, create an instance of the class:

```php
$converter = new NounConverter();
```

You can now use the `convertToPlural` method to convert a singular noun to its plural form:

```php
$plural = $converter->convertToPlural('dog');
echo $plural; // Outputs "dogs"
```

If the noun is irregular and has a predefined plural form, it will be returned as is:

```php
$plural = $converter->convertToPlural('mouse');
echo $plural; // Outputs "mice"
```

## Irregular Nouns

The PluralConverter class includes a list of irregular nouns and their plural forms. You can add more irregular nouns to the `$irregulars` property as needed.

```php
private $irregulars = [
    'man' => 'men',
    'woman' => 'women',
    // Add more irregular nouns here
];
```

## Pluralization Patterns

The class also uses a set of pluralization patterns and their replacements to convert regular nouns. These patterns are defined in the `$patterns` property.

```php
private $patterns = [
    '/(s|ss|sh|ch|x|z)$/i' => '\1es', // Ends with s, ss, sh, ch, x, or z
    '/([^aeiou])y$/i' => '\1ies', // Ends with a consonant + y
    '/(o)$/i' => '\1es', // Ends with o
    '/(f|fe)$/i' => 'ves', // Ends with f or fe
    '/(us)$/i' => 'uses', // Ends with us
    '/(is)$/i' => 'es', // Ends with is
];
```

You can modify or add more patterns to suit your specific needs.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contributing

Contributions are welcome! If you find a bug or want to add a new feature, please open an issue or submit a pull request.
