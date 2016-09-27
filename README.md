# countries-handler

please run composer install

please update parameters.yml for Db settings

and do the symfony shenaningans:
	bin/console doctrine:database:create
	bin/console doctrine:schema:create 

please do bin/console server:run

bin/console database:populate dev will populate dev database with data from restcountries

/countries-list will return all countries
/country-iso2/{iso2} will return the country with that iso2
/countries-lang/{lang} will return all countries with that language

