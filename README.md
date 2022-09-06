# Collection
A simple and concise implementation of strictly typed arrays in PHP. No extra code, just type-checked arrays.

## Usage
First you need to create your own collection class which extends the `GenericCollection` and sets its type:
```php
use Pogulailo\Collection\GenericCollection;

class CustomerCollection extends GenericCollection
{
    public function __construct(...$values)
    {
        parent::__construct(Customer::class, $values);
    }
}
```

That's all, then you can enjoy all the advantages of strictly typed arrays:
```php
function getCustomers(): CustomerCollection
{
    $customers = new CustomerCollection();
    
    $customers->append(new Customer());
    $customers->append(new Customer());
    $customers->append(new Customer());
    
    return $customers;
}

$customers = getCustomers();

foreach ($customers as $customer) {
    // Do what you need to do
}
```

You can choose not to create your own collection class, but then you will need to do additional type checking:
```php
use Pogulailo\Collection\GenericCollection;

function getCustomers(): GenericCollection
{
    $customers = new GenericCollection(Customer::class);
    
    $customers->append(new Customer());
    $customers->append(new Customer());
    $customers->append(new Customer());
    
    return $customers;
}

$customers = getCustomers();

// In this case, you need to check the collection type first
if ($customers->getType() !== Customer::class) {
    throw new Exception('I need customers, more customers...')
}

foreach ($customers as $customer) {
    // Do what you need to do
}
```