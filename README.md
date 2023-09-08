> Написать консольную команду получения курса валют (EUR, USD, KGS) за текущую неделю.
> Текущей неделей считается интервал от предыдущего понедельника до сегодняшнего дня.
> 
> Запрашивать сайт ЦБ
> https://www.cbr.ru/scripts/XML_daily.asp?date_req=15/06/2023
> 
> Результаты запросов объединить в массив (ключ - дата в формате Y-m-d) и вывести в консоль.


### Build project
`docker compose up -d --build`

### Up project
`docker compose up -d`

### Commands
`docker-compose exec app php minicli help`

`docker-compose exec app php minicli cbr`