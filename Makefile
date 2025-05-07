dev-bootcamp:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml down --remove-orphans
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml up --build

dev-bootcamp-composer-shell:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm composer sh

dev-bootcamp-node-install:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm node sh -c "npm install && npm run build"

dev-bootcamp-node-dev:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm node sh -c "npm install && npm run dev"
