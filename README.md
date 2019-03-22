# Bobidziennik
Skrypt dziennika szkolnego napisany w PHP.

## Wymagania
* PHP 7.2.15
* MySQL 5.7.25

# Baza danych
Przykładowa konfiguracja znajduje się w pliku **db.example.php**. Konfiguracja musi znaleźć się w pliku db.php według przykładu.


# Budowanie manualne (niezalecanie)
Wymagania do budowania:
* Node (8.10+) & npm (3.5.2+)
* Composer 1.8.4
```bash
cd bobidziennik
# composer
composer install
#node
npm i --save
npm i --save-dev
npm run build
```
