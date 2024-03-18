 # Annature PHP SDK

> [!NOTE]
> This SDK is still a work in progress. Whilst functional for the [implemented resources](#resources), it is built against the Annature [documentation](https://documentation.annature.com.au) for optimistic scenarios.

[Annature](https://annature.com.au) is an Australian-based eSignature and client verification provider.

Use of this SDK requires an account with Annature, as well as an API ID and Key.

My immediate use-case for this API was creation of envelopes to be sent to signatories, so those resources have been built first. 

The package leverages [Saloon](https://docs.saloon.dev) for it's HTTP layer.

<a name="resources"></a>
## Resources

| Resource | Status |
| -------- | ------ |
| Accounts | Implemented |
| Documents | Implemented |
| Endpoints | Not implemented |
| Envelopes | Implemented |
| Fields | [Field object](https://documentation.annature.com.au/#/fields/object) only |
| Groups | Not implemented |
| Organisations | Not implemented |
| Recipients | [Recipient object](https://documentation.annature.com.au/#/recipients/object) only |
| Templates | Not implemented |

<a name="installation"></a>
## Installation

```bash
composer require dyrynda/annature-php
```

<a name="usage"></a>
## Usage

```php
use Dyrynda\Annature\Annature;
use Dyrynda\Annature\Data\Envelopes\CreateEnvelopeData;

$annature = new Annature(
    id: 'your-annature-id',
    key: 'your-annature-key'
);

$envelope = $annature->envelopes()->create(
    new CreateEnvelopeData(...)
);
```

<a name="laravel"></a>
## Laravel

If you are using [Laravel](https://laravel.com), you may use the [laravel-annature](https://github.com/michaeldyrynda/laravel-annature) package, which uses this SDK as a dependency, to get started quickly.
