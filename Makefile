#!/bin/sh
build:
	docker build -t todayintel/automation.todayintel.com:latest --progress=plain -f=docker/Dockerfile .
build-fresh:
	docker build -t todayintel/automation.todayintel.com:latest --no-cache --progress=plain -f=docker/Dockerfile .
publish:
	docker push todayintel/automation.todayintel.com:latest
dev:
	docker-compose up -d
down:
	docker-compose down
