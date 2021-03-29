# PHP-Smart-Image-Resizer

Function uses GD only, which is extensively found in almost every PHP installation. It resize images preserving aspect ratio and background transparency also catches some tricky image issues and returns what is wrong as string. Also if the image is a photo taken with a mobile phone or professional camera, it usually faces 90 degrees to the left by default. When this issue detected image will automatically be rotated to correct position. It is easy to use, robust and fast. Enjoy.

## Description
```php
smart_image_resizer ( string $src_image , string $dst_image , string $size , $quality = 100 ) true : string
```

<br/>

## Parameters
- **src_image :** Source image resource.
- **dst_image :** Destination image resource.
- **size :** Destination width or height depending on greater size of source image
- **quality :** Quality is optional, and ranges from 0 (worst quality, smaller file) to 100 (best quality, biggest file)

<br/>

## Return Values
Returns true on success or string on failure.

<br/>

## Examples

<br/>

#### Example #1 Simple example

```php
smart_image_resizer('images/apple.jpg', 'images/resized_apple.jpg', 500);
```

Output : `true`

![Example-1](https://raw.githubusercontent.com/erman999/PHP-Smart-Image-Resizer/master/examples/example1.jpg)

<br/>

#### Example #2 Long size adjustment

Not all images are square. Sometimes width is greater than height and sometimes height is greater than width. However, we define only one size parameter. This is because function always preserves aspect ratio. The function takes long size of source image scales it according to given parameter value.

```php
smart_image_resizer('images/melons.jpg', 'images/resized_melons.jpg', 500);
```

Output : `true`

![Example-2](https://raw.githubusercontent.com/erman999/PHP-Smart-Image-Resizer/master/examples/example2.jpg)

<br/>

#### Example #3 Quality

You can change quality of destination image. Let's say we want to resize and reduce quality of new image to 75%. Usually 75% is very good most of the time. Compare file sizes with previous example. File size is reduced almost 90% without losing quality.

```php
smart_image_resizer('images/melons.jpg', 'images/resized_melons.jpg', 500, 75);
```

Output : `true`

![Example-3](https://raw.githubusercontent.com/erman999/PHP-Smart-Image-Resizer/master/examples/example3.jpg)

<br/>

#### Example #4 Transparent background

When an image resized it usually lose transparency and all transparent pixels turn to black. This function preserves transparency as well but only for PNG images so far.

```php
smart_image_resizer('images/fruits.jpg', 'images/resized_fruits.jpg', 500, 100);
```

Output : `true`

![Example-4](https://raw.githubusercontent.com/erman999/PHP-Smart-Image-Resizer/master/examples/example4.jpg)

<br/>

## Errors

Function returns true if everything is alright. When an error occurs it return a string value to tell what is wrong. See examples below.

```php
smart_image_resizer('fruits', 'fruits2.jpg', 500, 100);

smart_image_resizer('fruits.jpg', 'fruits2', 500, 100);

smart_image_resizer('fruits.jpg', 'fruits2.png', 500, 100);
```

Output : `Source file extension and target file extension doesn't match or doesn't exist!`

<br/>

```php
smart_image_resizer('fruits.jpg', 'fruits2.jpg', 500, 100);
```

> This error occurs when image type (e.g PNG) saved with wrong extension (e.g JPG)

Output : `Image MIME type 'image/png' and image extension 'jpg' doesn't match!`

<br/>

```php
smart_image_resizer('fruits.tga', 'fruits2.jpg', 500, 100);
```

Output : `Unsupported image type!`

<br/>
