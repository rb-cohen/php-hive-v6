# php-hive-v6
Hive home heating and smart devices PHP SDK

## Install
`$ composer require rb-cohen/bg-hive-v6:dev-master`

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