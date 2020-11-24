<?php

namespace Laramore\Fields;

use Illuminate\Support\Facades\Schema;

return [

    /*
    |--------------------------------------------------------------------------
    | Name templates for the fields generation
    |--------------------------------------------------------------------------
    |
    | This option defines the template used to generate the name and the
    | attribute name, if existant, of a field.
    |
    */

    'templates' => [
        'name' => '_{name}',
        'attname' => '_{attname}',
        'method_owner' => '-{methodname}FieldValue',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default fields
    |--------------------------------------------------------------------------
    |
    | This option defines the default fields.
    |
    */

    'configurations' => [
        Reversed\BelongsToMany::class => [
            'type' => 'reversed_relation',
            'proxy' => [
                'configurations' => [
                    'retrieve' => [],
                    'attach' => [],
                    'detach' => [],
                    'sync' => [],
                    'update' => [],
                    'delete' => [],
                    'toggle' => [],
                    'sync_without_detaching' => [],
                    'update_existing_pivot' => [],
                ],
            ],
        ],
        Binary::class => [
            'type' => 'binary',
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                ],
            ],
        ],
        Boolean::class => [
            'type' => 'boolean',
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'is' => [
                        'needs_value' => true,
                    ],
                    'is_not' => [
                        'needs_value' => true,
                    ],
                ],
            ],
        ],
        Char::class => [
            'type' => 'char',
            'max_length' => Schema::getFacadeRoot()::$defaultStringLength,
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'resize' => [],
                ],
            ],
        ],
        DateTime::class => [
            'type' => 'date_time',
            'format' => 'Y-m-d H:i:s',
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                ],
            ],
        ],
        Decimal::class => [
            'type' => 'decimal',
            'total_digits' => 8,
            'decimal_digits' => 2,
            'types' =>  [
                'big' => 'big_decimal',
                'small' => 'small_decimal',
                'unsigned' => 'unsigned_decimal',
                'big_unsigned' => 'big_unsigned_decimal',
                'small_unsigned' => 'small_unsigned_decimal',
            ],
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                ],
            ],
        ],
        Email::class => [
            'type' => 'email',
            'max_length' => Schema::getFacadeRoot()::$defaultStringLength,
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'fix' => [],
                ],
            ],
            'patterns' => [
                'username' => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*/iD',
                'domain' => '/^(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD',
                'email' => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD',
                'separator' => '@',
                'flags' => null,
            ],
        ],
        Enum::class => [
            'type' => 'enum',
            'elements' => [
                'proxy' => [
                    'class' => \Laramore\Proxies\EnumProxy::class,
                    'configurations' => [
                        'is' => [
                            'templates' => [
                                'name' => '-{methodname}-^{elementname}',
                            ],
                            'needs_value' => true,
                        ]
                    ],
                ],
            ],
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'get_elements' => [
                        'templates' => [
                            'name' => 'get-^{identifier}Elements',
                        ],
                    ],
                    'get_elements_value' => [
                        'templates' => [
                            'name' => 'get+^{identifier}',
                        ],
                    ],
                    'is' => [
                        'needs_value' => true,
                    ],
                    'is_not' => [
                        'needs_value' => true,
                    ],
                ],
            ],
        ],
        Reversed\HasMany::class => [
            'type' => 'reversed_relation',
            'proxy' => [
                'configurations' => [
                    'retrieve' => [],
                    'attach' => [],
                    'detach' => [],
                    'sync' => [],
                    'update' => [],
                    'delete' => [],
                    'toggle' => [],
                    'sync_without_detaching' => [],
                    'update_existing_pivot' => [],
                ],
            ],
        ],
        Reversed\HasOne::class => [
            'type' => 'reversed_relation',
            'proxy' => [
                'configurations' => [
                    'retrieve' => [],
                    'attach' => [],
                    'detach' => [],
                    'sync' => [],
                    'update' => [],
                    'delete' => [],
                    'toggle' => [],
                    'sync_without_detaching' => [],
                    'update_existing_pivot' => [],
                ],
            ],
        ],
        Increment::class => [
            'type' => 'increment',
            'step' => 1,
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'increment' => [],
                    'decrement' => [],
                ],
            ],
        ],
        Integer::class => [
            'type' => 'integer',
            'types' =>  [
                'big' => 'big_integer',
                'small' => 'small_integer',
                'unsigned' => 'unsigned_integer',
                'big_unsigned' => 'big_unsigned_integer',
                'small_unsigned' => 'small_unsigned_integer',
            ],
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                ],
            ],
        ],
        Json::class => [
            'type' => 'json',
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                ],
            ],
        ],
        ManyToMany::class => [
            'type' => 'relation',
            'pivot_namespace' => 'App\\Pivots',
            'fields' => [
                'reversed' => Reversed\BelongsToMany::class,
            ],
            'templates' => [
                'reversed' => '+{modelname}',
                'pivot' => 'pivot',
                'reversed_pivot' => 'pivot',
                'self_reversed' => 'reversed_+{name}',
                'self_reversed_pivot' => 'reversed_+{modelname}',
            ],
            'proxy' => [
                'configurations' => [
                    'retrieve' => [],
                    'attach' => [],
                    'update' => [],
                    'delete' => [],
                ],
            ],
        ],
        ManyToOne::class => [
            'type' => 'relation',
            'fields' => [
                'id' => Integer::class,
                'reversed' => Reversed\HasMany::class,
            ],
            'templates' => [
                'id' => '${name}_${identifier}',
                'reversed' => '+{modelname}',
                'self_reversed' => 'reversed_+{name}',
            ],
            'proxy' => [
                'configurations' => [
                    'retrieve' => [],
                    'attach' => [],
                    'detach' => [],
                    'sync' => [],
                    'update' => [],
                    'delete' => [],
                    'toggle' => [],
                    'sync_without_detaching' => [],
                    'update_existing_pivot' => [],
                ],
            ],
        ],
        OneToOne::class => [
            'type' => 'relation',
            'fields' => [
                'id' => UniqueId::class,
                'reversed' => Reversed\HasOne::class,
            ],
            'templates' => [
                'id' => '${name}_${identifier}',
                'reversed' => '${modelname}',
                'self_reversed' => 'reversed_+{name}',
            ],
            'proxy' => [
                'configurations' => [
                    'retrieve' => [],
                    'attach' => [],
                    'detach' => [],
                    'sync' => [],
                    'update' => [],
                    'delete' => [],
                    'toggle' => [],
                    'sync_without_detaching' => [],
                    'update_existing_pivot' => [],
                ],
            ],
        ],
        Password::class => [
            'type' => 'password',
            'max_length' => 60, // Length required for hashs.
            'min_length' => 8, // Min length of any password.
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'resize' => [],
                    'hash' => [],
                    'is_correct' => [
                        'templates' => [
                            'name' => 'is$^{identifier}Correct',
                        ],
                        'needs_value' => true,
                    ],
                ],
            ],
            'patterns' => [
                'min_max_part' => '(?=\S{$min,$max})',
                'one_lowercase_part' => '(?=\S*[a-z])',
                'one_uppercase_part' => '(?=\S*[A-Z])',
                'one_number_part' => '(?=\S*[\d])',
                'one_special_part' => '(?=\S*[\W])',
            ]
        ],
        PrimaryId::class => [
            'type' => 'primary_id',
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                ],
            ],
        ],
        UniqueId::class => [
            'type' => 'integer',
            'types' =>  [
                'big' => 'big_integer',
                'small' => 'small_integer',
                'unsigned' => 'unsigned_integer',
                'big_unsigned' => 'big_unsigned_integer',
                'small_unsigned' => 'small_unsigned_integer',
            ],
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                ],
            ],
        ],
        Text::class => [
            'type' => 'text',
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                ],
            ],
        ],
        Timestamp::class => [
            'type' => 'timestamp',
            'format' => 'timestamp',
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                ],
            ],
        ],
        Uri::class => [
            'type' => 'uri',
            'max_length' => Schema::getFacadeRoot()::$defaultStringLength,
            'proxy' => [
                'configurations' => [
                    'dry' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'hydrate' => [
                        'static' => true,
                        'allow_multi' => false,
                    ],
                    'fix' => [],
                ],
            ],
            'patterns' => [
                'identifier' => '/^\S+$/',
                'protocol' => '/^\S+:\/{0,2}$/',
                'uri' => '/^\S+:\/{0,2}\S+$/',
                'flags' => null,
            ]
        ],
    ],

];
