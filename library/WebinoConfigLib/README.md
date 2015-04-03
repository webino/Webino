# WebinoConfigLib - Webino™ Configuration Library

PHP`s array configuration generator aka Configurator library for Zend Frameowrk 2.

Used to generate array configurations with ease.


## QuickUse

At first, create your new config feature:

    <?php
    
    use WebinoConfigLib\Feature\AbstractFeature;
    
    class MyFeature extends AbstractFeature
    {
        public function __construct($argOne, $argTwo)
        {
            $this->mergeArray([
                'some_settings' => [
                    'anything' => ['foo' => $argOne, 'bar' => $argTwo],
                ],
            ]);
        }
    }
    
then creating configuration like this:
    
    return (new Config([
    
        new MyFeature('OPTION_ONE', 'OPTION_TWO'),
    
    ]))->toArray();
    
produces an array:

    [
    
        'some_settings' => [
            'anything' => ['foo' => 'OPTION_ONE', 'bar' => 'OPTION_TWO'],
        ],
    
    ];


## Architecture

Configurators are used to generate array configurations for large PHP applications. With them you can generate
array configurations the OOP way. Everything is config and config can contain features. Feature is fragment
of the pluggable configuration.

- Config
    - Feature
        - Feature
        - Feature
        - ...
            - ...
    - ...

Configuration features can be cascaded deeply if required, but plugged horizontally. That means we can add or remove
the feature from a config easily:

    new Config([
            
        new ExampleFeatureOne,
        new ExampleFeatureTwo('DEFAULT_OPTION'),
        
    ]);
    
adding another feature and changing option:

    new Config([
        
        new ExampleFeatureOne,
        new ExampleFeatureTwo('MY_OPTION'),
        new ExampleFeatureThree,
        
    ]);
    
So we can produce very complex configuration on a couple of lines.


## HowTo

Some extraordinary usage.

### Add array settings

It is possible to add just array settings too:

    new Config([
        
        ['example_settings' => ['foo' -> 'bar']],
        
    ]);

TODO...


### Requirements

- PHP 5.6
- TODO...

## TODO

- TODO...

## Addendum

This library is a part of the Webino™ platform for web applications.
