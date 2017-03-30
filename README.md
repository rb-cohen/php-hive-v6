# php-hive-v6
Hive home heating and smart devices PHP SDK

## Install
`$ composer require rb-cohen/php-hive-v6:dev-master`

## List devices

### Using the CLI script
`$ php bin/devices.php --username test@test.com --password 12345`

### Using the SDK
```php
$authentication = new Credentials($username, $password);
$client = new Client($authentication);

$devices = new Devices($client);
$list = $devices->all();
```

## Control smart plug
### Using the CLI script
`$ php bin/smartPlug.php --username test@test.com --password 12345 --id <id> --on`

### Using the SDK
```php
$authentication = new Credentials($username, $password);
$client = new Client($authentication);

$plug = new SmartPlug($id, $client);
$plug->on()
     ->apply();
```

## Control colour bulb
### Using the CLI script
`$ php bin/bulb.php --username test@test.com --password 12345 --id <id> --brightness 50 --colour rgb(255, 221, 211) --on`

### Using the SDK
```php
$authentication = new Credentials($username, $password);
$client = new Client($authentication);

$bulb = new BulbColour($id, $client);
$bulb->on()
     ->setBrightness(50)
     ->setColour('#ff0000')
     ->apply();
```