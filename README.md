# CodeIgniter 4 Framework

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds the distributable version of the framework.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the development repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

# INFORMASI!!!!!!

## Penting untuk Dipahami:

Aplikasi ini disediakan untuk digunakan secara pribadi, pendidikan, atau keperluan non-komersial lainnya. Kami ingin menegaskan bahwa aplikasi ini tidak dapat digunakan untuk tujuan jual beli dalam bentuk apapun. Penggunaan aplikasi ini untuk memperoleh keuntungan finansial atau untuk diperdagangkan dalam bentuk apapun, baik itu sebagai produk maupun layanan yang dipasarkan kepada pihak ketiga, adalah pelanggaran terhadap ketentuan penggunaan.

Dengan menggunakan aplikasi ini, Anda menyetujui bahwa semua data dan informasi yang ada dalam aplikasi ini telah disediakan untuk tujuan demonstrasi atau percakapan umum. Semua konten yang ada dalam aplikasi ini bukanlah data asli atau data yang dipersiapkan untuk penggunaan komersial. Semua fitur atau fungsi yang ada pada aplikasi ini disediakan hanya untuk tujuan demonstrasi atau uji coba.

Adapun segala bentuk distribusi atau penjualan aplikasi ini, baik secara langsung ataupun melalui perantara, akan dianggap sebagai pelanggaran terhadap hak cipta dan perjanjian lisensi. Kami menghimbau agar Anda tidak terlibat dalam tindakan yang dapat merugikan pihak penyedia aplikasi atau merusak tujuan dan kredibilitas dari aplikasi ini.

Penting untuk dicatat bahwa aplikasi ini dilindungi oleh hak cipta dan hak kekayaan intelektual lainnya, yang memberikan hak eksklusif kepada pengembang. Oleh karena itu, segala bentuk komersialisasi yang dilakukan dengan aplikasi ini tanpa izin yang sah akan berakibat pada tindakan hukum yang dapat menimbulkan kerugian bagi pihak yang melanggar.

Dengan memahami hal ini, kami berharap Anda dapat mematuhi pedoman yang telah ditetapkan dan tidak menggunakan aplikasi ini untuk tujuan yang bertentangan dengan ketentuan yang berlaku.

Terima kasih atas perhatian dan kerjasama Anda!
