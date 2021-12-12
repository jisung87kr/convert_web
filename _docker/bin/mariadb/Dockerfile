FROM mariadb:10.5.9-focal
RUN apt-get update && apt-get install -y \
    vim \
    && touch "/var/lib/mysql/error.log" \
    && chown "mysql:mysql" "/var/lib/mysql/error.log" \