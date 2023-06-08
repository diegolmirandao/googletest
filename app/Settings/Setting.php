<?php

namespace App\Settings;

class Setting {
    /** @var string */
    public $type;
    /** @var mixed[]|null */
    public $options;
    /** @var int|string */
    public $value;

    public function __construct(array $settingValue) {
        $this->type = $settingValue['type'];
        $this->options = $settingValue['options'];
        $this->value = $settingValue['value'];
    }

    public static function fromArray(array $settingValue) {
        return new Setting($settingValue);
    }
}