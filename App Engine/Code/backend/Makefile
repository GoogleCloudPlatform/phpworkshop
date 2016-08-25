BASEDIR = $(shell pwd)

build:
	docker build -t mysql-phpworkshop "$(BASEDIR)/."  

clean:
	-docker stop -t 0 phpworkshop
	-docker rm phpworkshop

run: build
	docker run --name=phpworkshop -d -p 3306:3306 \
	-e STARTUP_SQL="schema.sql" mysql-phpworkshop 
	



