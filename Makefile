up:
	docker-compose up -d

build:
	docker-compose build

down:
	docker-compose down --remove-orphans

down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

api-clear:
	docker run --rm -v ${PWD}/api:/app -w /app alpine sh -c 'rm -rf var/*'

currency-compare:
	docker-compose run --rm backend composer app app:exchange:compare