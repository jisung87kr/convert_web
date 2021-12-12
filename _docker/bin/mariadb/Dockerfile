FROM mariadb
RUN apt-get update && apt-get install -y \
    vim \
    && touch "/var/lib/mysql/error.log" \
    && chown "mysql:mysql" "/var/lib/mysql/error.log" \