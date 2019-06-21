# Verificare Stare TVA

[![Latest Version on Packagist](https://img.shields.io/packagist/v/thebugsoftware/stare-tva.svg?style=flat-square)](https://packagist.org/packages/thebugsoftware/stare-tva)
[![Build Status](https://img.shields.io/travis/thebugsoftware/stare-tva/master.svg?style=flat-square)](https://travis-ci.org/thebugsoftware/stare-tva)
[![Quality Score](https://img.shields.io/scrutinizer/g/thebugsoftware/stare-tva.svg?style=flat-square)](https://scrutinizer-ci.com/g/thebugsoftware/stare-tva)
[![Total Downloads](https://img.shields.io/packagist/dt/thebugsoftware/stare-tva.svg?style=flat-square)](https://packagist.org/packages/thebugsoftware/stare-tva)
[![coverage](https://codecov.io/gh/thebugsoftware/stare-tva/branch/master/graph/badge.svg?style=flat-square)](https://codecov.io/gh/thebugsoftware/stare-tva)
[![License](https://img.shields.io/packagist/l/thebugsoftware/stare-tva.svg?style=flat-square)](https://github.com/thebugsoftware/stare-tva/blob/master/LICENSE.md)

A simple PHP Library for checking the VAT status for Romanian companies.

## Installation

You can install the package via composer:

```bash
composer require thebugsoftware/stare-tva
```

## Usage

Requesting data for one company:
``` php
use TheBugSoftware\StareTva\StareTva;

try {
    $response = (new StareTva)->for(31423108)->get();
    $response = json_decode($response, true);
    // Do something with the results...
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

Requesting data for multiple companies:
``` php
use TheBugSoftware\StareTva\StareTva;

try {
    $response = (new StareTva)
        ->for(30214391)
        ->for(31423108)
        ->for(6093130)
        ->get();

    $response = json_decode($response, true);
    // Do something with the results...
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

Please keep in mind that the API has a limit of 500 companies per request and no more than one request per minute for which we got you covered, don't worry.

The `for()` method accepts a second parameter `date` **(format: Y-m-d)** which by defeault will be set to the current date.

Example with date passed:
``` php
(new StareTva)->for(30214391, '2019-02-05')->get();
```

Example response:
``` json
{
    "success": true,
    "items": [
        {
            "cui": 30214391,
            "name": "CLINICA VASCULARA VENART SRL",
            "address": "JUD. CLUJ, MUN. CLUJ-NAPOCA, STR. DESCARTES RENÉ, NR.27",
            "status": {
                "deactivation_date": "",
                "reactivation_date": "",
                "publish_date": "",
                "erasure_date": ""
            },
            "vat": {
                "active": false,
                "message": "nu figureaza in registre",
                "start_date": "",
                "end_date": "",
                "tax_date": ""
            },
            "vat_on_receipt": {
                "active": false,
                "message": "",
                "start_date": "",
                "end_date": "",
                "published_at": "",
                "updated_at": ""
            },
            "vat_split": {
                "active" :false,
                "start_date": "",
                "end_date": ""
            },
            "vat_stats_at": "2019-02-05"
        }
    ]
}
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email robert.chiribuc@thebug.ro instead of using the issue tracker.

## Credits

- [Robert-Cristian Chiribuc](https://github.com/chiribuc)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
