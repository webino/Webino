# WebinoLogLib - Webino™ Logging Boilerplate

This library is created on top of a Zend Framework 2 Logger and makes
logging clean and DRY.


## QuickUse

To write a message to a log write following

    <?php
    
    use WebinoLogLib\Factory;
    
    $log = (new Factory)->create();
    
    $log->log(SomeLogMessage::class, [$argOne, $argTwo]);
    

then create your log message class:

    namespace SomeNamespace\Log\Message;

    use WebinoLogLib\Message\DebugMessage;

    class SomeLogMessage extends DebugMessage
    {
        public function getMessage(...$args)
        {
            return 'Some log message text with parameters {0} and {1} ...';
        }
    }


## Severities

- **Emergency** - The system is unusable.
- **Alert** - Immediate action is required.
- **Critical** - Critical conditions.
- **Error** - Errors that do not require immediate attention but should be monitored.
- **Warning** - Unusual or undesirable occurrences that are not errors.
- **Notice** - Normal but significant events.
- **Info** - Interesting events.
- **Debug** - Detailed information for debugging purposes.

## Available abstract messages

Inherit your log message classes from following, provided under this library namespace:

- *WebinoLogLib\Message*
    - *EmergencyMessage*
    - *AlertMessage*
    - *CriticalMessage*
    - *ErrorMessage*
    - *WarnMessage*
    - *NoticeMessage*
    - *InfoMessage*
    - *DebugMessage*

## HowTo

Some advanced usage.

### String logging

- `$log->log($log::DEBUG, 'Some debug message with parameters %s and %s ...', $argOne, $argTwo);`

### Closure logging

    $log->log($log::DEBUG, function () {
        return 'Some debug message with parameters %s and %s ...';
    }, $argOne, $argTwo);

### Message object logging

- `$log->log(new SomeLogMessage, $argOne, $argTwo);`

### Classic API

**Emergency**

- `$log->emerg(string|callable $message, ...$args);`

**Alert**

- `$log->alert(string|callable $message, ...$args);`

**Critical**

- `$log->crit(string|callable $message, ...$args);`

**Error**

- `$log->err(string|callable $message, ...$args);`

**Warning**

- `$log->warn(string|callable $message, ...$args);`

**Notice**

- `$log->notice(string|callable $message, ...$args);`

**Info**

- `$log->info(string|callable $message, ...$args);`

**Debug**

- `$log->debug(string|callable $message, ...$args);`


## Addendum

This library is a part of the Webino™ platform for web applications.
