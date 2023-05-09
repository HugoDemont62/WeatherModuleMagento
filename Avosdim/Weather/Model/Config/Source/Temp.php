<?php
namespace Avosdim\Weather\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Temp implements ArrayInterface
{
    /**
     * Return array of options as value-label pairs, eg. value => label
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            'Celsius' => 'Celsius C°',
            'Fahrenheit' => 'Fahrenheit F°',
        ];
    }
}
