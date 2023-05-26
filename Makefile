init:
	docker-compose up -d
	@echo "Running migrations"
	@echo "------------------------"
	@docker exec laravel php artisan migrate
down:
	@docker-compose down -v	
migrate:
	@echo "Running migrations"
	@echo "------------------------"
	@docker exec laravel php artisan migrate
rollback:
	@echo "Rollback migrations"
	@echo "------------------------"
	@docker exec laravel php artisan migrate:rollback
.PHONY: clean test code-sniff init
