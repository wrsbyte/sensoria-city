dev-bootcamp:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml down --remove-orphans
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml up --build

dev-bootcamp-shell:
	docker-compose -p sensoria-city-bootcamp -f projects/bootcamp/setup/docker-compose.yml run --rm composer sh
