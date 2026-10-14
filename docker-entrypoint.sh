#!/bin/bash
a2dismod mpm_event 2>/dev/null || true
a2dismod mpm_worker 2>/dev/null || true
a2enmod mpm_prefork
chown www-data:www-data /data
if [ "$CLEAR_DATA" = "true" ]; then
    : > "$DATA_FILE"
    chown www-data:www-data "$DATA_FILE"
fi
exec apache2-foreground
