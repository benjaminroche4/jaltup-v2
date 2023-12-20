phpcs:
	@echo "\033[0;32mRunning PHP CS\033[0m..."
	./vendor/bin/phpcs

phpstan:
	@echo "\033[0;32mRunning PHP STAN\033[0m..."
	./vendor/bin/phpstan

phpmd:
	@echo "\033[0;32mRunning PHP MD\033[0m..."
	./vendor/bin/phpmd src text .phpmd.xml.dist
