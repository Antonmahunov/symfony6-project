##################
# Variables
##################

DOCKER_COMPOSE = docker-compose -f ./docker/docker-compose.yml
DOCKER_COMPOSE_PHP_FPM_EXEC = ${DOCKER_COMPOSE} exec -u www-data php-fpm

##################
# Docker compose
##################
dc_up:
	${DOCKER_COMPOSE} up -d --remove-orphans

dc_build:
	${DOCKER_COMPOSE} build

dc_start:
	${DOCKER_COMPOSE} start

dc_stop:
	${DOCKER_COMPOSE} stop

dc_ps:
	${DOCKER_COMPOSE} ps

dc_logs:
	${DOCKER_COMPOSE} logs -f

dc_down:
	${DOCKER_COMPOSE} down -v --rmi=all --remove-orphans

##################
# App
##################

app_bash:
	${DOCKER_COMPOSE} exec -u www-data php-fpm sh


##################
# Database
##################

db_migrate:
	${DOCKER_COMPOSE} exec -u www-data php-fpm bin/console doctrine:migrations:migrate --no-interaction
db_diff:
	${DOCKER_COMPOSE} exec -u www-data php-fpm bin/console doctrine:migrations:diff --no-interaction