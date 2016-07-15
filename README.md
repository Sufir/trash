# Majesty test

## Установка

1. Развернуть проект:

    ``` bash
    $ git clone -b majesty https://github.com/Sufir/trash.git [project directory]
    ```

2. Установить зависимости:

    ``` bash
    $ composer install
    ```

3. Profit!

## Использование

``` bash
$ php app.php -s=/full/path/to/source.html > test.txt
```

``` bash
$ php app.php -s=http://php.net/ > test.txt
```

## Использование

* "скелет" приложения ~30-40 мин.
* "гуглил", обращался к доке php и сторониим инструментам вроде regex101.com суммарно приблизительно около часа
    * в т.ч. быстро посмотрел на несколько парсеров Html, например https://github.com/sunra/php-simple-html-dom-parser https://github.com/sunra/php-simple-html-dom-parser
* подбирал вариант простого но приемлимого варианта парсинга ~120 мин.
    * пробовал несколько подходов разбиения регулярками, str_word_count, explode и их комбинациями
    * регулярку для поиска картинок и сылок взял как есть, по первой же ссылке из гугла
* реп и readme ~20 мин.