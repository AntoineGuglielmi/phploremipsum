# phploremispum
phploremipsum is a simple lorem text generator.
## How to use it:
```php
$lorem = new agli\Lorem();

echo $lorem->words();
// Autem culpa velit! Nam ad veritatis veniam. Error culpa deleniti quod, optio esse cupiditate amet.

// The words() method case take 3 parameters:  
    // The number of words you want to be generated (15 by default)  
    // The HTML tag you eventualy want to surround your lorem text with
    // The class(es) attribute you eventualy add to your wrapper
echo $lorem->words(20);
echo $lorem->words(20,'p','a_class another_class');
```
