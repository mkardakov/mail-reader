# PHP Mail Reader Component

The Mail reader reads your email inbox and allow user to iterate over letters collection

Supported email protocols:
* [IMAP](http://php.net/manual/en/book.imap.php)

## Examples:

```php
require_once __DIR__ . '/vendor/autoload.php';

// Setup necessary connection params
$config = new \Mails\Imap\Config();
$config->setHost('imap.gmail.com')
    ->setPort(993)
    ->setSsl(true)
    ->setUser('user@gmail.com')
    ->setPass('password');
    
// instantiate mailer service
$mailer = (new \Mails\MailKit())->create($config);

// Create filter for inbox letters
$criteria = new \Mails\Search\SearchCriteria();
$criteria->setFrom('online@hotmail.com')->setBody('Hi, ');
// Create sort rule
// Sort Params must be valid constants from imap extension
//http://php.net/manual/ru/function.imap-sort.php#refsect1-function.imap-sort-parameters
 $sort = new \Mails\Sort\Sorter();
 $sort->setDirection(\Mails\Sort\Sorter::ASC)->setSortParam(SORTARRIVAL);
// Get \Generator
$emails = $mailer->getInbox($criteria, $sort);
foreach ($emails as $mail) {
    echo $letter->getHeaders()->getSubject();
    echo $letter->getBody()->getHTML();
}
```