SHELL := /bin/bash
TEST =

tests:
	@symfony php bin/phpunit

test:
	@symfony php bin/phpunit ./tests/${TEST}Test.php

setDbTest:
	@symfony console doctrine:database:drop --force --env=test || true
	@symfony console doctrine:database:create --env=test
	@symfony console doctrine:migrations:migrate -n --env=test

fixtures: setDbTest
	@symfony console doctrine:fixtures:load --env=test


.PHONY: tests