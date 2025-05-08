dev-bootcamp:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml down --remove-orphans
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml up --build

dev-bootcamp-composer-shell:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm composer sh

dev-bootcamp-node-install:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm node sh -c "npm install && npm run build"

dev-bootcamp-node-dev:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm -P node sh -c "npm install && npm run dev"

_prod-bootcamp:
	docker compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml down --remove-orphans
	docker compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml up -d --build

prod-bootcamp: _prod-bootcamp dev-bootcamp-node-dev

prod-bootcamp-php-shell:
	docker compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm php sh

prod-bootcamp-composer-shell:
	docker compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm composer sh

prod-bootcamp-node-install:
	docker compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm node sh -c "npm install && npm run build"

prod-bootcamp-logs:
	docker compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml logs -f --tail=100
