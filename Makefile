bootcamp:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml down --remove-orphans
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml up --build

bootcamp-composer-shell:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm composer sh

bootcamp-node-install:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm node sh -c "npm install && npm run build"

bootcamp-node-dev:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm node sh -c "npm install && npm run dev"
