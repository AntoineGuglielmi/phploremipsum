# phploremispum
phploremipsum is a simple lorem text generator.
## Install
```
composer require antoineg/phploremipsum
```
## How to use it:
```php
$lorem = new agli\Lorem();

echo $lorem->words();
// Will output
// Autem culpa velit! Nam ad veritatis veniam. Error culpa deleniti quod, optio esse cupiditate amet.
```
  
The `words()` method can take 3 parameters:  
- The number of words you want to be generated (15 by default)  
- The HTML tag you eventualy want to surround your lorem text with
- The class(es) attribute you eventualy want to add to your wrapper
```php
echo $lorem->words(20);
echo $lorem->words(20,'p','a_class another_class');
```
  
Want your lorem text begin by "Lorem ipsum dolor sit amet" ?
Do the same with the `lorem()` method:
```php
echo $lorem->lorem();
// Will output
// Lorem ipsum dolor sit amet at. Inventore facilis amet adipisci soluta ea? Nisi nulla mollitia.
echo $lorem->lorem(20);
echo $lorem->lorem(20,'p','a_class another_class');
```
  
You can simply use it inside your HTML:
```html
<h1><?= $lorem->words(5) ?></h1>
<p><?= $lorem->words(25) ?></p>
```
