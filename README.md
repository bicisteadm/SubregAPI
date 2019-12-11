
# SubregAPI

PHP Knihovna pro jednoduchou implementaci SOAP API od [Subreg.cz](https://subreg.cz/manual/)


Instalace
---------

    composer require bicisteadm/subregapi


Použití
-----------

Tam kde chceme s knihovnou pracovat, si jí zavoláme pomocí:

```php
use bicisteadm\SubregAPI\SubregAPI;
```

Inicializujeme třídu, která přijímá parametry pro přihlášení a aktivaci/deaktivaci testovacího prostředí a to v tomto pořadí: Username, Password, Test environment (true/false):

```php
$client = new SubregAPI("username", "password", true);
```

První dva parametry jsou povinné, třetí necháme prázdný pro false.

Nyní můžeme volat jednotlivé API funkce pomocí:

```php
$params = [
    "domain" => "freshtest01.cz",
    "template" => "freshtest"
];
$data = $client->call("Add_DNS_Zone", $params);
```

První parametr je povinný a obsahuje název API funkce. Druhý parametr jsou doplňková data. Pokud je nepotřebujeme, nemusíme druhý parametr uvádět. 

Seznam všech funkcí je k dispozici [zde](https://subreg.cz/manual/).

Enjoy it!
