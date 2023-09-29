<?php

namespace Bmt\NounConverter;

/**
 * Class NounConverter
 *
 * A class for converting singular nouns to their plural form or inverse.
 */
class NounConverter
{
    /**
     * A list of irregular nouns and their plural forms.
     *
     * @var array
     */
    private $irregulars = [
        'man' => 'men',
        'woman' => 'women',
        'child' => 'children',
        'tooth' => 'teeth',
        'foot' => 'feet',
        'person' => 'people',
        'mouse' => 'mice',
        'goose' => 'geese',
        'datum' => 'data',
        'analysis' => 'analyses',
        'ox' => 'oxen',
        'sheep' => 'sheep',
        'fish' => 'fish',
        // Add more irregular nouns as needed
    ];

    /**
     * A list of pluralization patterns and their replacements.
     *
     * @var array
     */
    private $patterns = [
        '/(s|ss|sh|ch|x|z)$/i' => '\1es', // Ends with s, ss, sh, ch, x, or z
        '/([^aeiou])y$/i' => '\1ies', // Ends with a consonant + y
        '/(o)$/i' => '\1es', // Ends with o
        '/(f|fe)$/i' => 'ves', // Ends with f or fe
        '/(us)$/i' => 'uses', // Ends with us
        '/(is)$/i' => 'es', // Ends with is
    ];

    /**
     * Converts a singular noun to its plural form.
     *
     * @param string $noun The singular noun to be converted.
     * @return string The plural form of the noun.
     */
    public function convertToPlural($noun)
    {
        if (isset($this->irregulars[$noun])) {
            return $this->irregulars[$noun];
        }

        foreach ($this->patterns as $pattern => $replacement) {
            if (preg_match($pattern, $noun)) {
                return preg_replace($pattern, $replacement, $noun);
            }
        }

        return $noun . 's';
    }

    /**
     * Converts a plural noun to its singular form.
     *
     * @param string $noun The plural noun to be converted.
     * @return string The singular form of the noun.
     */
    public function convertToSingular($noun)
    {
        // First, check for irregular plurals
        $irregularsFlip = array_flip($this->irregulars);
        if (isset($irregularsFlip[$noun])) {
            return $irregularsFlip[$noun];
        }

        // Reverse the patterns for singular to plural conversion
        $singularPatterns = [
            '/(s|ss|sh|ch|x|z)es$/i' => '\1', // Ends with s, ss, sh, ch, x, or z followed by es
            '/([^aeiou])ies$/i' => '\1y', // Ends with a consonant + ies
            '/(oes)$/i' => 'o', // Ends with oes
            '/(ves)$/i' => '\1f', // Ends with ves
            '/(uses)$/i' => '\1us', // Ends with uses
            '/(es)$/i' => '\1is', // Ends with es
        ];

        foreach ($singularPatterns as $pattern => $replacement) {
            if (preg_match($pattern, $noun)) {
                return preg_replace($pattern, $replacement, $noun);
            }
        }

        // If no match, assume it's a regular plural and remove 's'
        return rtrim($noun, 's');
    }
}