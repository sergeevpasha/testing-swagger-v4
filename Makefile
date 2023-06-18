.PHONY: up
up:
	@docker-compose up -d

.PHONY: down
down:
	@docker-compose down

.PHONY: install
install:
	docker exec laravel-test-app_php composer install

.PHONY: bash
bash:
	@docker exec -it laravel-test-app_php bash
