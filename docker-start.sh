#!/bin/sh
set -eu

ATTEMPT=1
MAX_ATTEMPTS=5

while ! php /var/www/html/php/reset-banco.php; do
    if [ "$ATTEMPT" -ge "$MAX_ATTEMPTS" ]; then
        echo "[startup] Database reset failed after $MAX_ATTEMPTS attempts. Apache will not start." >&2
        exit 1
    fi

    echo "[startup] Database reset failed. Retrying in 3 seconds ($ATTEMPT/$MAX_ATTEMPTS)..." >&2
    ATTEMPT=$((ATTEMPT + 1))
    sleep 3
done

echo "[startup] Demo database is ready. Starting Apache."
exec apache2-foreground
