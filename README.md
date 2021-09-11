# PHP Imgur API

## _A efficient way to Imgur API_

[![oFahel](https://i.imgur.com/hSyuS32.png)](https://github.com/ofahel/)

## ⚡ Features

- Asynchronous upload process.
- Upload images via Binary file, Base64 or URL.
- Upload video up to 200mb.
- Convert uploaded video to GIF.

## 🎉 Installation/Usage

Download the imgur.php and put it on your project folder.


Basic example
```php
<?php
include("imgur.php");

//Instantiate the library passing your Client-ID
$Imgur = new IMGURClass('your_client_id_here');

//Upload a URL
$upload = $Imgur->upload('https://i.imgur.com/hSyuS32.png');

// ----- Get upload infos ----- //

//Direct link
$upload_link = $upload->link;

//File MIME
$upload_mime = $upload->type;

//Image size
$upload_size = array(
  "width" => $upload->width,
  "height" => $upload->height
);

//Dont forget to store the Deletation Hash
$deletation_hash = $upload->deletehash;

//Delete image
$Imgur->delete($deletation_hash);

?>
```

## 📄 Class methods

| Method    | Description                            | Parameters                                                        |
|-----------|----------------------------------------|------------                                                       |
| delete    | Delete a uploaded image/video          | Deletation Hash                                                   |
| upload    | Upload a image/video                 | Data(Binary file, Base64 or URL), Async(boolean), Options(Array)  |


## Development

Want to contribute? Great!
You are welcome 🥳

## License

GNU General Public License
