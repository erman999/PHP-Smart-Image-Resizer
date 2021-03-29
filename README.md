# PHP-Smart-Image-Resizer

This function resizes image preserving aspect ratio and background transparency also catches some tricky image issues and returns what is problem.
The function uses GD library only, which is extensively found in almost every PHP installation.

## Description
```php
filename_prefixer ( string $src_image , string $dst_image , string $size , $quality = 100 ) true : string
```

## Parameters
- **src_image :** Source image resource.
- **dst_image :** Destination image resource.
- **size :** Destination width or height depending on greater size of source image
- **quality :** Quality is optional, and ranges from 0 (worst quality, smaller file) to 100 (best quality, biggest file)

## Return Values
Returns true on success or string on failure.


## Examples

### Example #1 Simple example

Check sizes 2827x2827 reduced to 500x500 also filesize is reduced.

```php
smart_image_resizer('images/apple.jpg', 'images/resized_apple.jpg', 500);
```

The above example output : `true`

![Example-1](https://raw.githubusercontent.com/erman999/PHP-Smart-Image-Resizer/master/examples/example1.jpg)

<br/>


### Example #2 Long size adjustment

Not all images are square. Sometimes width is greater than height and sometimes height is greater than width. However, we define only one size parameter. This is because function always preserves aspect ratio. The function takes long size of source image scales it according to given parameter value.

```php
smart_image_resizer('images/melons.jpg', 'images/resized_melons.jpg', 500);
```

The above example output : `true`

![Example-2](https://raw.githubusercontent.com/erman999/PHP-Smart-Image-Resizer/master/examples/example2.jpg)
