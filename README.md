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

#### Simple Usage
```php
smart_image_resizer('images/apple.jpg', 'images/resized_apple.jpg', 1000);
```
The above example output : `true`
