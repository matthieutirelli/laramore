<?php
/**
 * Define a char field.
 *
 * @author Samy Nastuzzi <samy@nastuzzi.fr>
 *
 * @copyright Copyright (c) 2019
 * @license MIT
 */

namespace Laramore\Fields;

use Illuminate\Support\Facades\Schema;
use Laramore\Facades\TypeManager;
use Laramore\Type;

class Char extends Text
{
    protected $length;

    /**
     * Set of rules.
     * Common to all string fields.
     *
     * @var integer
     */

    // Except if the length is longer than allowed
    public const RESPECT_LENGTH = 1024;

    // If the string is too long, auto cut at the defined length
    public const CARACTERE_RESIZE = 2048;

    // If the string is too long, auto cut at the last word before the defined length
    public const WORD_RESIZE = 4096;

    // If the string is too long, auto cut at the last sentence before the defined length
    public const SENTENCE_RESIZE = 8192;

    // If the string is too long, auto cut and add dots
    public const DOTS_ON_RESIZING = 16384;

    // Default rules
    public const DEFAULT_CHAR = self::DEFAULT_TEXT;

    protected static $defaultRules = self::DEFAULT_CHAR;

    protected function __construct($rules=null)
    {
        parent::__construct($rules);

        $this->length = Schema::getFacadeRoot()::$defaultStringLength;
    }

    public function getType(): Type
    {
        return TypeManager::char();
    }

    public function getPropertyKeys(): array
    {
        return array_merge([
            'length'
        ], parent::getPropertyKeys());
    }

    protected function locking()
    {
        parent::locking();

        if ($this->hasRule(self::RESPECT_LENGTH) && is_null($this->length)) {
            throw new \Exception('No length set for '.$this->name);
        }
    }

    public function length(int $length)
    {
        $this->needsToBeUnlocked();

        if ($length <= 0) {
            throw new \Exception('The length must be a positive number');
        }

        $this->defineProperty('length', $length);

        return $this;
    }

    public function setValue($model, $value)
    {
        $value = parent::setValue($model, $value);

        if ($this->length < strlen($value) && !is_null($value)) {
            $dots = $this->hasRule(self::DOTS_ON_RESIZING) ? '...' : '';

            if ($this->hasRule(self::RESPECT_LENGTH, self::STRICT)) {
                throw new \Exception('The value must respect the defined length for the field '.$this->name);
            }

            if ($this->hasRule(self::CARACTERE_RESIZE)) {
                $value = $this->resizeValue($value, $this->length, '', $dots);
            } else if ($this->hasRule(self::WORD_RESIZE)) {
                $value = $this->resizeValue($value, $this->length, ' ', $dots);
            } else if ($this->hasRule(self::SENTENCE_RESIZE)) {
                $value = $this->resizeValue($value, $this->length, '.', $dots);
            }
        }

        return $value;
    }

    public function resizeValue($value, $length, $delimiter='', $toAdd='...')
    {
        $parts = $delimiter === '' ? str_split($value) : explode($delimiter, $value);
        $valides = [];
        $length -= strlen($toAdd);

        foreach ($parts as $part) {
            if (strlen($part) <= $length) {
                $length -= strlen($part);
                $valides[] = $part;
            } else {
                break;
            }
        }

        return implode($delimiter, $valides).$toAdd;
    }
}
