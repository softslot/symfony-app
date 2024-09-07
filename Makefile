init-project: docker-down-clear docker-pull docker-build docker-up composer-install

docker-down-clear:
	docker compose down -v --remove-orphans

docker-pull:
	docker compose pull

docker-build:
	docker compose build

docker-up:
	docker compose up -d

composer-install:
	docker compose run --rm php-cli composer install

wait-db:
	until docker compose exec -T postgres pg_isready --timeout=0 --dbname=app; do sleep 1 ; done