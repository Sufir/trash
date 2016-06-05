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

Вывод случайной записи из файла, с импортом в БД:

    ``` bash
    php app.php test:random dbuser dbpassword
    ```
	
Информацию о параметрах можно посмотреть при помощи команды:
	
	``` bash
    php app.php test:random -h
    ```